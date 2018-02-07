<?php

class HttpServer
{
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    public function __construct() {
        $app = require_once __DIR__.'/../bootstrap/app.php';
        $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

        $http = new swoole_http_server("0.0.0.0", 9501); //侦听所有地址来的请求
        $http->set([
            'document_root' => __DIR__,
            // like pm.start_servers in php-fpm, but there's no option like pm.max_children
            'worker_num' => 4,

            // max number of coroutines handled by a worker in the same time
            'max_coro_num' => 3000,

            // set it to false when debug, otherwise true
            'daemonize' => true,

            // like pm.max_requests in php-fpm
            'max_request' => 1000,
            'pid_file' => app()->basePath()."/bootstrap/laravel-fly-9501.pid",
            'log_file' => app()->storagePath().'/logs/swoole.log',
            
        ]);
        $http->on('request', function ($request, $response) use($kernel) {
            $this->setGlobal($request);
            $l_request = \Illuminate\Http\Request::capture();
            $l_response = $kernel->handle($l_request);
            foreach ($l_response->headers->allPreserveCase() as $name => $values) {
                foreach ($values as $value) {
                    $response->header($name, $value);
                }
            }

            foreach ($l_response->headers->getCookies() as $cookie) {
                $response->cookie($cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(), $cookie->getPath(), $cookie->getDomain(), $cookie->isSecure(), $cookie->isHttpOnly());
            }

            $response->status($l_response->getStatusCode());
            // gzip use nginx
            // $response->gzip(1);
            ob_start();
            $l_response->send();
            $kernel->terminate($l_request, $l_response);
            ob_get_clean();
            $response->end($l_response->getContent());
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
        $_SERVER["DOCUMENT_ROOT"] = __DIR__;//项目绝对路径，上传文件用
        $_SERVER['argv'] = [];//防警告
    }
}
