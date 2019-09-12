<?php

namespace Alone\LaravelQueueReplaceable;

trait QueueReplaceable
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
        return $this->createPayloadArrayReplaceable($job,$data,$queue);
    }

    public function getJobReplaceableId($job,$data = '',$queue = null)
    {
        $replaceableId = null;
        if(is_object($job) && method_exists($job,'getReplaceableId'))
        {
            $replaceableId = $job->getReplaceableId();
        }
        elseif(is_array($data) || is_object($data))
        {
            $replaceableId = (string)data_get($data,'replaceable');
        }
        return $replaceableId;
    }

    public function createPayloadArrayReplaceable($job,$data = '',$queue = null)
    {
        $payload = parent::createPayloadArray($job,$data,$queue);
        if($replaceableId = $this->getJobReplaceableId($job,$data,$queue))
        {
            data_set($payload,'id',$replaceableId);
        }
        return $payload;
    }

}