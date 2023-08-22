<?php

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin('bnomei/blueprints', [
    'options' => [
        'cache' => true,
    ],
    'hooks' => [
        'route:before' => function (Kirby\Http\Route $route, string $path, string $method) {
            \Bnomei\Blueprints\BlueprintCache::cacheDir(true);
        },
    ],
]);
