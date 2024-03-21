<?php

// load the fields stored as traits
autoloader(__DIR__)->classes();

$a = autoloader(__DIR__)->toArray([
    'options' => [
        'test' => 'Test',
    ],
    'blueprints' => [
        'fields/test' => [
            'type' => 'info',
            'text' => 'Test',
        ],
    ],
]);
//ray($a)->blue();

// load everything else with the autoloader
Kirby::plugin('test/plugin', $a);
