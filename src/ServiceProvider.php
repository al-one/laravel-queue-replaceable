<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Support;

class ServiceProvider extends Support\ServiceProvider
{

    public function boot()
    {
        /** @var \Illuminate\Queue\QueueManager $queue */
        $queue = $this->app['queue'];
        $queue->addConnector('replaceable_database',function()
        {
            return new Connectors\DatabaseConnector($this->app['db']);
        });
        $queue->addConnector('replaceable_redis',function()
        {
            return new Connectors\RedisConnector($this->app['redis']);
        });
        $queue->addConnector('replaceable_file',function()
        {
            return new Connectors\FileConnector;
        });
    }

}
