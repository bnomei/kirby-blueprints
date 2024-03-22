<?php

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin('bnomei/blueprints', [
    'options' => [
        'cache' => true,
        'expire' => 60, // in seconds, null = use opcache duration, 0 to disable
        'preload' => ['pages', 'files', 'users'],
    ],
    'hooks' => [
        'system.loadPlugins:after' => function () {
            // the kirby cache is not available yet when the plugin
            // is caching the blueprint so remember the cache dir
            // and use it on next request
            \Bnomei\Blueprints\BlueprintCache::rememberCacheDir();
            \Bnomei\Blueprints\Blueprint::loadPluginsAfter();
        },
    ],
]);
