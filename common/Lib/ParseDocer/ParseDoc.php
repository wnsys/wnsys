<?php
/**
 * Docparser.php for Docparser.
 * @author 阿新 <opdss@qq.com>
 * @date 2017/9/18 12:06
 * @copyright istimer.com
 */
namespace Common\Lib\ParseDocer;
class ParseDoc
{
    private $name;
    /**
     * 原始注释
     * @var string
     */
    private $string;
    /**
     * 简短注释(获取的第一行)
     * @var string
     */
    private $shortDesc = '';
    /**
     * 详细注释(获取的所有)
     * @var string
     */
    private $longDesc = '';
    /*
     * 带@名称的注释
     * @var array
     */
    private $params = array();
    /**
     * 对参数处理的handler
     * @var array
     */
    private static $globalHandler = array();
    /**
     * Docparser constructor.
     * @param $string
     */
    private function __construct($string)
    {
        $this->string = $string;
        static::setGlobalHandler('param',function($param){
            return \Common\Lib\ParseDocer\Handler::fm_param($param);
        } );
        static::setGlobalHandler('return',function($param){
            return \Common\Lib\ParseDocer\Handler::fm_return($param);
        } );
        static::setGlobalHandler('date', function($param){
            return \Common\Lib\ParseDocer\Handler::fm_date($param);
        } );
        static::setGlobalHandler('author',function($param){
            return \Common\Lib\ParseDocer\Handler::fm_author($param);
        });
        static::setGlobalHandler('wnRequestMapping',function($param){
            return \Common\Lib\ParseDocer\Handler::fm_wnRequestMapping($param);
        });
        $this->parse();
    }
    /**
     * 工厂方法
     * @param $docStr 注释说明
     * @return Docparser
     */
    public static function factory($docStr)
    {
        $ins = new self($docStr);
        return $ins;
    }
    /**
     * 解析
     */
    private function parse()
    {
        if (empty($this->string)) {
            return false;
        }
        if (preg_match('#^/\*\*(.*)\*/#s', $this->string, $comment) === false) {
            return false;
        }
        $comment = trim($comment[1]);
        if (preg_match_all('#^\s*\*(.*)#m', $comment, $lines) === false) {
            return false;
        }
        $this->parseLines($lines[1]);
    }
    /**
     * 将取得的行数组注释开始逐行解析
     *
     * @param array $lines
     * @return bool
     */
    private function parseLines(array $lines)
    {
        if (empty($lines)) {
            return false;
        }
        $desc = array();
        foreach ($lines as $line) {
            $parsedLine = $this->parseLine($line); //对每一行解析
            if ($parsedLine !== false && empty($this->shortDesc)) {
                $this->shortDesc = $parsedLine;
            } elseif ($parsedLine !== false) {
                $desc[] = $parsedLine;
            }
        }
        $this->longDesc = implode(PHP_EOL, $desc);
    }
    /**
     * 对每一行注释进行详细分析
     *
     * @param $line
     * @return bool|string
     */
    private function parseLine($line)
    {
        $line = trim($line);
        if (empty($line)) return false; //Empty line
        if (strpos($line, '@') === 0) {
            $param = substr($line, 1, strpos($line, ' ') - 1); //Get the parameter name
            $value = substr($line, strlen($param) + 2); //Get the value
            if ($this->setParam($param, $value)) {
                return false;
            }
        }
        return $line;
    }
    /**
     * 设置参数说明
     *
     * @param $param
     * @param $value
     * @return bool
     */
    private function setParam($param, $value)
    {
        //对参数进行设置的handler 处理
        $callable = isset(self::$globalHandler[$param]) ? self::$globalHandler[$param] : null;
        $value = $callable ? $callable($value) : $value;
        if (!isset($this->params[$param])) {
            $this->params[$param] = $value;
        } else {
            if (is_array($this->params[$param])) {
                array_push($this->params[$param], $value);
            } else {
                $this->params[$param] = array($this->params[$param], $value);
            }
        }
        return true;
    }
    /**
     * 设置handler
     *
     * @param string $name @参数名称
     * @param callable $callable 回调处理函数
     * @return bool
     */
    public static function setGlobalHandler($name, callable $callable)
    {
        if (is_callable($callable)) {
            self::$globalHandler[$name] = $callable;
            return true;
        }
        return false;
    }
    /**
     * 移除handler
     *
     * @param $name @参数名称
     * @return bool
     */
    public static function unsetGlobalHandler($name)
    {
        if (isset(self::$globalHandler[$name])) {
            unset(self::$globalHandler[$name]);
        }
        return true;
    }
    public function __toString()
    {
        return $this->string;
    }
    public function getString()
    {
        return $this->string;
    }
    /**
     * 获取短注释
     *
     * @return string
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }
    /**
     * 获取长注释
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->longDesc;
    }
    /**
     * 获取参数注释
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    /**
     * 获取参数注释
     *
     * @param $name
     * @return string|bool
     */
    public function getParam($name)
    {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }
}