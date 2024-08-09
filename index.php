<?php

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin('bnomei/blueprints', [
    'options' => [
        'cache' => true,
        // 'expire' => 60, // default is HARD-CODED in BlueprintCache.php
        'preload' => ['pages', 'files', 'users'],
    ],
    'hooks' => [
        'system.loadPlugins:after' => function () {
            // the kirby cache is not available yet when the plugin
            // is caching the blueprint so remember the cache dir
            // and use it on next request
            \Bnomei\Blueprints\BlueprintCache::rememberCacheDir();
            \Bnomei\Blueprints\Blueprint::loadPluginsAfter();
            \Bnomei\Blueprints\BlueprintCache::preloadCachedBlueprints();
        },
    ],
]);
