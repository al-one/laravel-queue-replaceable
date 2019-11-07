# Laravel Queue Driver For Delayed jobs Can be replaced

> 暂时仅支持`database`、`redis`以及[`file`](https://github.com/al-one/laravel-queue-file)驱动


## Installing

```sh
$ composer require "al-one/laravel-queue-replaceable" -vvv
```


## Usage

```php
# config/queue.php
<?php

return [
    'default' => env('QUEUE_DRIVER','replaceable_database'),
    'connections' => [
        'replaceable_database' => [
            'driver'      => 'replaceable_database',
            'connection'  => 'mysql', // database connection
            'table'       => 'jobs',
            'queue'       => 'default',
            'retry_after' => 90,
        ],
        'replaceable_redis' => [
            'driver'      => 'replaceable_redis',
            'connection'  => 'default', // redis connection
            'queue'       => 'default',
            'retry_after' => 90,
        ],
        'replaceable_file' => [
            'driver' => 'replaceable_file', // composer require al-one/laravel-queue-file
            //'path'   => 'app/queue', // use storage_path() if not start with "/"
            //'queue'  => 'default',
        ],
    ],
];
```

```php
<?php

namespace App\Jobs;

class ProcessPodcast implements ShouldQueue
{

    public function getReplaceableId()
    {
        return 'replaceable-id';
    }

}
```

```php
<?php

use App\Jobs\ProcessPodcast;

ProcessPodcast::dispatch($podcast)
    ->onConnection('replaceable_database')
    ->delay(now()->addMinutes(10));
```


## License

MIT