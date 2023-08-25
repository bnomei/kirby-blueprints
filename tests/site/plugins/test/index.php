<?php

autoloader(__DIR__)->classes();

// TODO: make autoloader load the blueprint from the model on its own
load([
    'ProductPage' => __DIR__.'/models/ProductPage.php',
]);

Kirby::plugin('test/plugin', autoloader(__DIR__)->toArray(
    // TODO: make autoloader load the blueprint from the model on its own
    [
        'blueprints' => []
            + ProductPage::registerBlueprintExtension(),
    ]
));
