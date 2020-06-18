<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Support;
use Illuminate\Queue\QueueManager;

class ServiceProvider extends Support\ServiceProvider
{

    public function boot()
    {
        $this->app->resolving(QueueManager::class,function($manager)
        {
            foreach(['Database','Redis','File'] as $connector)
            {
                $this->{"register{$connector}Connector"}($manager);
            }
        });
    }

    protected function registerDatabaseConnector(QueueManager $manager)
    {
        $manager->addConnector('replaceable_database',function()
        {
            return new Connectors\DatabaseConnector($this->app['db']);
        });
    }

    protected function registerRedisConnector(QueueManager $manager)
    {
        $manager->addConnector('replaceable_redis',function()
        {
            return new Connectors\RedisConnector($this->app['redis']);
        });
    }

    protected function registerFileConnector(QueueManager $manager)
    {
        if(class_exists('\Alone\LaravelQueueFile\FileQueue'))
        {
            $manager->addConnector('replaceable_file',function()
            {
                return new Connectors\FileConnector;
            });
        }
    }

}
