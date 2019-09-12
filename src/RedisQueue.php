<?php

namespace Alone\LaravelQueueReplaceable;

use Illuminate\Queue\RedisQueue as BaseRedisQueue;

class RedisQueue extends BaseRedisQueue
{

    use QueueReplaceable;

}
