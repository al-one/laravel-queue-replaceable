<?php

namespace Alone\LaravelQueueReplaceable\Connectors;

use Alone\LaravelQueueReplaceable\FileQueue;
use Alone\LaravelQueueFile\FileConnector as BaseConnector;

class FileConnector extends BaseConnector
{

    /**
     * Establish a queue connection.
     *
     * @param  array  $config
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        return new FileQueue(
            $config['path'] ?? null,
            $config['queue'] ?? 'default'
        );
    }

}
