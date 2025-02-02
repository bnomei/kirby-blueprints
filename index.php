<?php

use Bnomei\Blueprints\Blueprint;
use Bnomei\Blueprints\BlueprintCache;
use Bnomei\BlueprintsLicense;
use Bnomei\Ink;
use Kirby\Content\Field;
use Kirby\Data\Yaml;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

@include_once __DIR__.'/vendor/autoload.php';

Kirby::plugin(
    name: 'bnomei/blueprints',
    license: fn ($plugin) => new BlueprintsLicense($plugin, BlueprintsLicense::NAME),
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
        'commands' => [
            'blueprints:yml2php' => [
                'description' => 'Converts YAML blueprints to PHP files',
                'args' => [
                    'dir' => [
                        'prefix' => 'd',
                        'longPrefix' => 'dir',
                        'description' => 'Dir to convert default is site/blueprints',
                        'default' => 'site/blueprints',
                    ],
                    'recursive' => [
                        'prefix' => 'r',
                        'longPrefix' => 'recursive',
                        'description' => 'Recursive',
                        'default' => true,
                        'noValue' => true,
                    ],
                ],
                'command' => function ($cli) {
                    $count = 0;
                    $dir = $cli->arg('dir');
                    if (empty($dir)) {
                        $dir = $cli->kirby()->roots()->blueprints();
                    } elseif (! Str::contains($dir, $cli->kirby()->roots()->index())) {
                        $dir = $cli->kirby()->roots()->blueprints().'/'.ltrim($dir, '/');
                    }
                    $recursive = $cli->arg('recursive');
                    if (empty($recursive)) {
                        $recursive = true;
                    }
                    foreach (Dir::index($dir, $recursive) as $file) {
                        $file = $dir.'/'.$file;
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'yml') {
                            $outFile = str_replace('.yml', '.php', $file);
                            if (! F::exists($outFile)) {
                                $cli->out('🐘'.$outFile);
                                F::write($outFile, "<?php\n\nreturn ".str_replace(
                                    ['array (', ')'],
                                    ['[', ']'],
                                    var_export(Yaml::read($file), true)
                                ).";\n");
                                $count++;
                            }
                        }
                    }
                    $cli->success("Converted {$count} YML Blueprints to PHP files");
                },
            ],
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
