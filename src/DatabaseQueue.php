<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Queue\DatabaseQueue as BaseDatabaseQueue;

class DatabaseQueue extends BaseDatabaseQueue
{

    use QueueReplaceable;

    /**
     * Push an array of jobs onto the queue.
     *
     * @param  array   $jobs
     * @param  mixed   $data
     * @param  string  $queue
     * @return mixed
     */
    public function bulk($jobs, $data = '', $queue = null)
    {
        $payloads = collect((array)$jobs)->map(function($job) use($data)
        {
            return $this->createPayload($job,$data);
        })->all();
        $this->database->table($this->table)
            ->where('queue',$this->getQueue($queue))
            ->whereIn('payload',$payloads)
            ->delete();
        return parent::bulk($jobs,$data,$queue);
    }

    /**
     * Push a raw payload to the database with a given delay.
     *
     * @param  string|null  $queue
     * @param  string  $payload
     * @param  \DateTime|int  $delay
     * @param  int  $attempts
     * @return mixed
     */
    protected function pushToDatabase($queue, $payload, $delay = 0, $attempts = 0)
    {
        $this->database->table($this->table)
            ->where('queue',$this->getQueue($queue))
            ->where('payload',$payload)
            ->delete();
        return parent::pushToDatabase($queue,$payload,$delay,$attempts);
    }

}
