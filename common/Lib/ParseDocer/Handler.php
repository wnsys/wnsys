<?php
/**
 * Handler.php for Docparser.
 * @author 阿新 <opdss@qq.com>
 * @date 2017/9/18 15:48
 * @copyright istimer.com
 */
namespace Common\Lib\ParseDocer;
class Handler
{
    public static function fm_param($string)
    {
        $string = trim($string);
        $arr = preg_split('#\ +#', $string, 3);
        if (($len = count($arr)) == 2) {
            return '(' . $arr[0] . ')' . $arr[1];
        } elseif ($len == 3) {
            return '(' . $arr[0] . ')' . $arr[1] . ': ' . $arr[2];
        }
        return $string;
    }
    public static function fm_return($string)
    {
        $string = trim($string);
        $arr = preg_split('#\ +#', $string, 2);
        if (($len = count($arr)) == 2) {
            return $arr[0] . ': ' . $arr[1];
        }
        return $string;
    }
    public static function fm_date($string)
    {
        $time = strtotime(trim($string));
        if ($time) {
            return date('Y-m-d H:i:s', $time);
        }
        return $string;
    }
    public static function fm_author($string)
    {
        $string = trim($string);
        return preg_replace('#(.*?)\ +<(.*?)\>#', '<a href="mailto:$2">$1</a>', $string);
    }
    public static function fm_wnRequestMapping($string){
        $arr = preg_split('#\ +#', $string);
        foreach ($arr as $r){
            $kv = explode("=",$r);
            $rs[$kv[0]] = $kv[1];
        }
        return $rs;
    }
}