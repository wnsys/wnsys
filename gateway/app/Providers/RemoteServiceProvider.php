<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NInterface\BlogInterface;
use Rpc\HttpClient;
use Rpc\Rpc;
use Rpc\SocketSyncClient;

class RemoteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogInterface::class,function (){
            $rpc = new Rpc(BlogInterface::class,new SocketSyncClient());
            return $rpc;
        });
    }
}
