<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Interfaces\BlogInterface;
use Rpc\Client\HttpClient;
use Rpc\Rpc;
use Rpc\Client\SocketSyncClient;

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
            return new Rpc(BlogInterface::class,new HttpClient());
        });
    }
}
