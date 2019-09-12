<?php

namespace Alone\LaravelQueueReplaceable;

trait QueueReplaceable
{

    protected function createPayload($job,$data = '',$queue = null)
    {
        return parent::createPayload($this->getReplaceableJob($job),$data,$queue);
    }

    protected function createPayloadArray($job,$data = '',$queue = null)
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