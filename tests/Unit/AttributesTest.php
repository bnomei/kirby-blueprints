<?php

use Bnomei\Blueprints\Attributes\Buttons;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\MaxLength;
use Bnomei\Blueprints\Attributes\Spellcheck;

dataset('pageModels', [

]);

test('Textarea has Attributes', function () {
    $pageModel = page('product-test');
    $rm = new ReflectionMethod($pageModel::class, 'description');
    expect(
        array_map(fn ($a) => $a->getName(), $rm->getAttributes())
    )->toEqual([
        Label::class,
        Label::class,
        Buttons::class,
        MaxLength::class,
        Spellcheck::class,
    ]);
});

test('Blueprint of ProductPage has description Textarea field', function () {
    $blueprint = ProductPage::registerBlueprintExtension();
    expect($blueprint)->toEqual([
        'pages/product' => [
            'fields' => [
                'description' => [
                    'buttons' => [
                        'bold',
                        'italic',
                        '|',
                        'link',
                    ],
                    'label' => [
                        'en' => 'Description',
                        'de' => 'Beschreibung',
                    ],
                    'maxlength' => 3000,
                    'spellcheck' => true,
                    'type' => 'textarea',
                ],
            ],
        ],
    ]);
});
