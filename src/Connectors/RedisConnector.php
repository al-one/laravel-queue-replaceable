<?php

namespace Alone\LaravelQueueReplaceable\Connectors;

use Alone\LaravelQueueReplaceable\RedisQueue;
use Illuminate\Support\Arr;
use Illuminate\Queue\Connectors\RedisConnector as BaseRedisConnector;

class RedisConnector extends BaseRedisConnector
{

    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new RedisQueue(
            $this->redis, $config['queue'],
            Arr::get($config, 'connection', $this->connection),
            Arr::get($config, 'retry_after', 60)
        );
    }

}
