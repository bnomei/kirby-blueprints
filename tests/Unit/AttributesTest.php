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

test('has a Blueprint of ProductPage with description Textarea field', function () {
    $blueprint = ProductPage::registerBlueprintExtension();
    expect($blueprint['pages/product']['sections']['main']['fields']['description'])->toEqual([
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
    ]);
});

test('has Custom Type and Property', function () {
    $blueprint = ProductPage::registerBlueprintExtension();
    expect($blueprint['pages/product']['sections']['main']['fields']['qrcode'])->toEqual(
        [
            'type' => 'qrcode',
            'customkey' => 'custom data',
        ]
    );
});

test('has merged Blueprint from class method', function () {
	$blueprint = ProductPage::registerBlueprintExtension();
	expect($blueprint['pages/product']['sections']['files'])->toEqual(
		[
			'type' => 'files',
			'label' => 'All Files',
		]
	);
});
