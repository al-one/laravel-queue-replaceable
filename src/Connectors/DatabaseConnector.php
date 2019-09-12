<?php

namespace Alone\LaravelQueueReplaceable\Connectors;

use Alone\LaravelQueueReplaceable\DatabaseQueue;
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
            $this->connections->connection($config['connection'] ?? null),
            $config['table'],
            $config['queue'],
            $config['retry_after'] ?? 60
        );
    }

}
