<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Queue\RedisQueue as BaseRedisQueue;

class RedisQueue extends BaseRedisQueue
{

    /**
     * Create a payload string from the given job and data.
     *
     * @param  string  $job
     * @param  mixed   $data
     * @param  string  $queue
     * @return array
     */
    protected function createPayloadArray($job, $data = '', $queue = null)
    {
        $payload = parent::createPayloadArray($job,$data,$queue);
        $replaceableId = null;
        if(is_object($job) && method_exists($job,'getReplaceableId'))
        {
            $replaceableId = $job->getReplaceableId();
        }
        elseif(is_array($data) || is_object($data))
        {
            $replaceableId = (string)data_get($data,'replaceable');
        }
        if($replaceableId)
        {
            data_set($payload,'id',$replaceableId);
        }
        return $payload;
    }

}
