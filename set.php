<?php

namespace Deployer;

// webserver user
set('http_user', 'www-data');

// remote permissions
set('writable_mode', 'chmod');
set('writable_chmod_recursive', false);
set('writable_chmod_mode', '2770');

// local host is always needed
host('local')->set('deploy_path', getcwd());

// read typo3 database connection from bin/typo3cms > AdditionalConfiguration.php > .env
set('driver_typo3cms', true);

// set writable dirs
set('writable_dirs', function () {
    return [
        get('web_path') . 'typo3conf',
        get('web_path') . 'typo3temp',
        get('web_path') . 'typo3temp/assets',
        get('web_path') . 'typo3temp/assets/images',
        get('web_path') . 'typo3temp/assets/_processed_',
        get('web_path') . 'uploads',
        get('web_path') . 'fileadmin',
        get('web_path') . '../var',
        get('web_path') . '../var/log',
        get('web_path') . '../var/transient',
        get('web_path') . 'fileadmin/_processed_',
    ];
});

// set shared dirs
set('shared_dirs', function () {
    return [
        'public/fileadmin',
        'public/uploads',
        'public/typo3temp/assets',
        'var/log',
        'var/transient',
        'var/goaccess',
    ];
});

// set log files dir
set('log_files', 'var/log/*.log');

// use curl instead of wget
set('fetch_method', 'curl');

// keep permissions from source system
set('media_rsync_flags', '-rz --perms');

// disable composer version check
set('composer_channel_autoupdate', false);

// configure default rsync settings
set('rsync', [
    'exclude' => [],
    'exclude-file' => false,
    'include' => [
        'composer.json',
        'composer.lock',
        'config',
        'packages',
        'public/.htaccess',
        'public/typo3conf/LocalConfiguration.php',
        'public/typo3conf/AdditionalConfiguration.php',
        'vendor'
    ],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'rz',
    'options' => ['delete'],
    'timeout' => 300,
]);

// configure rsync paths
set('rsync_src', __DIR__);
set('rsync_dest', '{{release_path}}');
