<?php

use Bnomei\Blueprints\Attributes\Buttons;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\MaxLength;
use Bnomei\Blueprints\Attributes\Spellcheck;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\Blueprint;
use Bnomei\Blueprints\BlueprintCache;

test('HomePage has field from attributes', function () {
    $blueprint = HomePage::blueprintFromAttributes();
    expect($blueprint['pages/home']['fields']['introduction'])
        ->toEqual([
            'label' => [
                'en' => 'Introduction',
                'de' => 'Einleitung',
            ],
            'type' => 'text',
        ]);

    $page = page('home');

    expect($page->introduction()->value())->toBe('Hello Blueprint!')
        ->and($page->blueprint()->field('introduction')['type'])->toBe('text')
        ->and($page->blueprint()->field('introduction')['label']['de'])->toBe('Einleitung');
});

test('Textarea has Attributes', function () {
    $pageModel = page('product');
    $rm = new ReflectionProperty($pageModel::class, 'description');
    expect(
        array_map(fn ($a) => $a->getName(), $rm->getAttributes())
    )->toEqual([
        Type::class,
        Label::class,
        Buttons::class,
        MaxLength::class,
        Spellcheck::class,
    ]);
});

test('has a Blueprint of ProductPage with description Textarea field', function () {
    $blueprint = ProductPage::blueprintFromAttributes();
    expect($blueprint['pages/product']['tabs']['shop']['columns']['92ad5ced93dbb1f298bb9a655ae5e7d7']['fields']['description'])->toEqual([
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

it('can cache and read blueprints', function () {
    BlueprintCache::flush();
    $key = 'pages/product';
    expect(BlueprintCache::exists($key))->toBeFalse();

    $blueprint = ProductPage::blueprintFromAttributes();
    expect(BlueprintCache::set($key, $blueprint))->toBeTrue()
        ->and($blueprint)->toBeArray()
        ->and(BlueprintCache::get($key))->toEqual($blueprint);

    // passing of time will make the cache expire
    touch(BlueprintCache::cacheFile($key), time() - 61);
    clearstatcache();
    expect(BlueprintCache::exists($key, 60))->toBeFalse();
});

test('has Custom Type and Property', function () {
    $blueprint = ProductPage::blueprintFromAttributes();
    expect($blueprint['pages/product']['tabs']['shop']['columns']['92ad5ced93dbb1f298bb9a655ae5e7d7']['fields']['qrcode'])->toEqual(
        [
            'type' => 'qrcode',
            'customkey' => 'custom data',
        ]
    );
});

it('has helpers to get do stuff when kirby has loaded the plugins', function () {
    $key = BlueprintCache::getKey();
    kirby()->session()->remove($key);
    expect(kirby()->session()->get($key))->toBeNull();
    BlueprintCache::rememberCacheDir();
    expect(kirby()->session()->get($key))->not()->toBeNull();

    Blueprint::loadPluginsAfter();

    expect(BlueprintCache::cacheDir())->not()->toBeNull();
    $count = BlueprintCache::preloadCachedBlueprints();
    expect($count)->toBeGreaterThan(0);
});

it('can Ink a section', function () {
    $fields = \Bnomei\Ink::fields(fields: [

    ]);

    expect($fields->toArray())->toBeArray();

    $invalid = \Bnomei\Ink::bogus();
    expect($invalid)->toBeNull();
});

it('can have deferred blueprints which load on ready()', function () {
    $blueprint = DynamoPage::blueprintFromAttributes();
    expect($blueprint)->toBeNull();

    Blueprint::loadPluginsAfter();
    expect(\Kirby\Cms\Blueprint::$loaded)->toHaveKey('pages/dynamo');
});

it('can be exported as yaml', function () {
    $blueprint = new Blueprint(HomePage::class);

    expect($blueprint->toYaml())->toBeString();
});
