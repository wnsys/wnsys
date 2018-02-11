<?php
namespace App\Server;
class HttpServer
{
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    public function __construct($options) {
        $kernel = app()->make(\Illuminate\Contracts\Http\Kernel::class);
        $http = new \swoole_http_server( $options["host"], $options["port"]); //侦听所有地址来的请求
        $http->set($options);
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

    public static function getInstance($options) {
        if (!self::$instance) {
            self::$instance = new HttpServer($options);
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
