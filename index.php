<?php

use Bnomei\Blueprints\Blueprint;
use Bnomei\Blueprints\BlueprintCache;
use Bnomei\Ink;
use Kirby\Content\Field;
use Kirby\Toolkit\A;

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin(
    name: 'bnomei/blueprints',
    license: fn ($plugin) => new \Bnomei\BlueprintsLicense($plugin, \Bnomei\BlueprintsLicense::NAME),
    extends: [
        'options' => [
            'license' => '', // set your license from https://buy-blueprints.bnomei.com code in the config `bnomei.blueprints.license`
            'cache' => true,
            // 'expire' => 60, // default is HARD-CODED in BlueprintCache.php
        ],
        'fieldMethods' => [
            'toBlueprint' => function (Field $field): ?array {
                return $field->model()?->blueprint()->field($field->key());
            },
            'toInk' => function (Field $field): \Bnomei\Blueprints\Schema\Field {
                $blueprint = $field->model()?->blueprint()->field($field->key()) ?? [];
                $blueprintSlim = $blueprint;
                unset($blueprintSlim['type']);
                unset($blueprintSlim['label']);

                return Ink::field(A::get($blueprint, 'type'))
                    ->label(A::get($blueprint, 'label'))
                    ->id($field->key())
                    ->properties($blueprintSlim);

            },
        ],
        'hooks' => [
            'system.loadPlugins:after' => function () {
                // the kirby cache is not available yet when the plugin
                // is caching the blueprint so remember the cache dir
                // and use it on next request
                BlueprintCache::rememberCacheDir();
                Blueprint::loadPluginsAfter();
                BlueprintCache::preloadCachedBlueprints();
            },
        ],
    ]);
