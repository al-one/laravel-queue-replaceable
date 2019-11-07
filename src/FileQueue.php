<?php

namespace Alone\LaravelQueueReplaceable;

use Alone\LaravelQueueFile\FileQueue as BaseQueue;

class FileQueue extends BaseQueue
{

    use QueueReplaceable;

    /**
     * Push a raw payload onto the queue after a delay.
     *
     * @param  \DateTimeInterface|\DateInterval|int  $delay
     * @param  string  $payload
     * @param  string|null  $queue
     * @return mixed
     */
    public function laterRaw($delay,$payload,$queue = null)
    {
        if($delay !== 0)
        {
            $this->popOrRelease($queue,$payload,false);
        }
        return parent::laterRaw($delay,$payload,$queue);
    }

}
