<?php

namespace Alone\LaravelQueueReplaceable;

trait QueueReplaceable
{

    protected function createPayload($job,$queue,$data = '')
    {
        return parent::createPayload($this->getReplaceableJob($job),$queue,$data);
    }

    protected function createPayloadArray($job,$queue,$data = '')
    {
        return $this->createPayloadArrayReplaceable($job,$queue,$data);
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

    public function createPayloadArrayReplaceable($job,$queue,$data = '')
    {
        $payload = parent::createPayloadArray($job,$queue,$data);
        if($replaceableId = $this->getJobReplaceableId($job,$data,$queue))
        {
            data_set($payload,'uuid',$replaceableId);
        }
        return $payload;
    }

    public function getReplaceableJob($job)
    {
        $replaceableJob = $job;
        if(is_object($job))
        {
            $replaceableJob = clone $job;
            if(method_exists($replaceableJob,'delay'))
            {
                $replaceableJob->delay(null);
            }
        }
        return $replaceableJob;
    }

}