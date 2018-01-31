<?php
require __DIR__.'/../bootstrap/autoload.php';

class HttpServer
{
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    private $application;
    public function __construct() {
        $app = require_once __DIR__.'/../bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
        $http = new swoole_http_server("0.0.0.0", 9501); //侦听所有地址来的请求
        $http->on('request', function ($request, $response) use($kernel) {
            $this->setGlobal($request);
            $l_request = Illuminate\Http\Request::capture();
            $l_response = $kernel->handle($l_request);
            ob_start();
            $l_response->send();
            $kernel->terminate($l_request, $l_response);
            $result = ob_get_clean();
            $response->end($result);
        });
        $http->start();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
    }
    /**
     * convert swoole request info to php global vars
     *
     * only for Mode One or Greedy
     *
     * @param \swoole_http_request $request
     * @see https://github.com/matyhtf/framework/blob/master/libs/Swoole/Request.php setGlobal()
     */
    protected function setGlobal($request)
    {
        $_GET = $request->get ?? [];
        $_POST = $request->post ?? [];
        $_FILES = $request->files ?? [];
        $_COOKIE = $request->cookie ?? [];

        $_SERVER = array();
        foreach ($request->server as $key => $value) {
            $_SERVER[strtoupper($key)] = $value;
        }

        $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);

        foreach ($request->header as $key => $value) {
            $_key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
            $_SERVER[$_key] = $value;
        }
        $_SERVER["REMOTE_ADDR"] = $_SERVER["HTTP_HOST"] = env("HTTP_HOST");

    }
}
HttpServer::getInstance();