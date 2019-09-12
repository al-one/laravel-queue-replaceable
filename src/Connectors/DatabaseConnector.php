<?php

namespace Alone\LaravelQueueReplaceable\Connectors;

use Alone\LaravelQueueReplaceable\DatabaseQueue;
use Illuminate\Support\Arr;
use Illuminate\Queue\Connectors\DatabaseConnector as BaseDatabaseConnector;

class DatabaseConnector extends BaseDatabaseConnector
{

    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new DatabaseQueue(
            $this->connections->connection(Arr::get($config, 'connection')),
            $config['table'],
            $config['queue'],
            Arr::get($config, 'retry_after', 60)
        );
    }

}
