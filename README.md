# Laravel Queue Driver For Delayed jobs Can be replaced


## Installing

```sh
$ composer require "al-one/laravel-queue-replaceable" -vvv
```


## Usage

```php
# config/app.php
<?php

return [
    'providers' => [
        Alone\LaravelQueueReplaceable\ServiceProvider::class,
    ],
];
```

```php
# config/queue.php
<?php

return [
    'default' => env('QUEUE_DRIVER','replaceable_database'),
    'connections' => [
        'replaceable_database' => [
            'driver'      => 'replaceable_database',
            'connection'  => 'mysql', // database connection
            'queue'       => 'default',
            'retry_after' => 90,
        ],
        'replaceable_redis' => [
            'driver'      => 'replaceable_redis',
            'connection'  => 'default', // redis connection
            'queue'       => 'default',
            'retry_after' => 90,
        ],
    ],
];
```

```php
<?php

ProcessPodcast::dispatch($podcast)
    ->onConnection('replaceable_database')
    ->delay(now()->addMinutes(10));
```


## License

MIT