<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'documentos' => [
            'driver' => 'local',
            'root' => storage_path('app/documentos'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'documentosacontis' => [
            'driver' => 'local',
            'root' => storage_path('app/documentosacontis'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'titulos' => [
            'driver' => 'local',
            'root' => storage_path('app/titulos'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'fotoperfil' => [
            'driver' => 'local',
            'root' => storage_path('app/fotoperfil'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'anexos' => [
            'driver' => 'local',
            'root' => storage_path('app/anexos'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'documentosperiodo' => [
            'driver' => 'local',
            'root' => storage_path('app/documentosperiodo'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'rut' => [
            'driver' => 'local',
            'root' => storage_path('app/rut'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'camaracomercio' => [
            'driver' => 'local',
            'root' => storage_path('app/camaracomercio'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'cedula' => [
            'driver' => 'local',
            'root' => storage_path('app/cedula'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'referencia' => [
            'driver' => 'local',
            'root' => storage_path('app/referencia'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'seguridad' => [
            'driver' => 'local',
            'root' => storage_path('app/seguridad'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'sig' => [
            'driver' => 'local',
            'root' => storage_path('app/sig'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'evaluacion' => [
            'driver' => 'local',
            'root' => storage_path('app/evaluacion'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
        

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
