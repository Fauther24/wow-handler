<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),

    'connections' => [

        # World of WarCraft Client - Auth Base
        'auth' => [
            'driver'    => env('DB_CONNECTION_AUTH'),
            'host'      => env('DB_HOST_AUTH'),
            'port'      => env('DB_PORT_AUTH'),
            'database'  => env('DB_DATABASE_AUTH'),
            'username'  => env('DB_USERNAME_AUTH'),
            'password'  => env('DB_PASSWORD_AUTH'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        # World of WarCraft Client - Character Base
        'char' => [
            'driver'    => env('DB_CONNECTION_CHAR'),
            'host'      => env('DB_HOST_CHAR'),
            'port'      => env('DB_PORT_CHAR'),
            'database'  => env('DB_DATABASE_CHAR'),
            'username'  => env('DB_USERNAME_CHAR'),
            'password'  => env('DB_PASSWORD_CHAR'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

    ],

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Illuminate\Support\Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
