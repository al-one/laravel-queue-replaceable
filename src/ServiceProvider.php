<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function register()
    {
        Queue::extend('replaceable_database',function()
        {
            return new Connectors\DatabaseConnector($this->app['db']);
        });
        Queue::extend('replaceable_redis',function()
        {
            return new Connectors\RedisConnector($this->app['redis']);
        });
    }

}
