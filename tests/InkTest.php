<?php

use Bnomei\Blueprints\Schema\Icon;
use Bnomei\Blueprints\Schema\SectionTypes;
use Bnomei\Ink;

it('can create a field', function () {
    $f = Ink::field(Ink::TEXT)
        ->label('My Text');

    expect($f->toArray())->toBe([
        'label' => 'My Text',
        'type' => 'text',
    ]);
});

it('can set a custom property', function () {
    $f = Ink::field(Ink::COLOR)
        ->property('custom', 'hello');

    expect($f->toArray())
        ->toHaveKey('custom', 'hello');
});

it('can set multiple custom properties', function () {
    $f = Ink::field(Ink::COLOR)
        ->properties([
            'hello' => 'world',
            'meta' => true,
        ]);

    expect($f->toArray())
        ->toHaveKey('hello', 'world')
        ->toHaveKey('meta', true);
});

it('sections generate an id from label if none is given', function () {
    $s = Ink::section(Ink::FIELDS, [
        Ink::field(Ink::INFO)
            ->label('My Info'),
    ]);

    expect($s->toArray())->toBe([
        'fields' => [
            'myInfo' => [
                'label' => 'My Info',
                'type' => 'info',
            ],
        ],
        'type' => 'fields',
    ]);
});

it('can be set to extend another field', function () {
    $f = Ink::field()
        ->extends('fields/myfield');

    expect($f->toArray())->toBe([
        'extends' => 'fields/myfield',
    ]);
});

it('can set the id to an field which will be used by sections', function () {
    $s = Ink::section(Ink::FIELDS, [
        Ink::field(Ink::INFO)
            ->label('My Info')
            ->id('mega'),
    ]);

    expect($s->toArray())->toBe([
        'fields' => [
            'mega' => [
                'id' => 'mega',
                'label' => 'My Info',
                'type' => 'info',
            ],
        ],
        'type' => 'fields',
    ]);
});

it('can create sections via the shortcut', function () {
    expect(SectionTypes::cases())
        ->toHaveCount(5);

    foreach (SectionTypes::cases() as $t) {
        $s = Ink::{$t->value}();
        expect($s->toArray())->toHaveKey('type', $t->value);
    }
});

it('can create single instances via the shortcuts', function () {

    foreach (['site', 'page', 'file'] as $t) {
        $s = Ink::{$t}('title');
        expect($s->toArray())->toHaveKey('title', 'title');
    }
    foreach (['field', 'section'] as $t) {
        $s = Ink::{$t}('type');
        expect($s->toArray())->toHaveKey('type', 'type');
    }
    foreach (['column'] as $t) {
        $s = Ink::{$t}('1/3');
        expect($s->toArray())->toHaveKey('width', '1/3');
    }
    foreach (['tab'] as $t) {
        $s = Ink::{$t}('label');
        $s->id('id');
        expect($s->toArray())->toHaveKey('id', 'id');
    }
    foreach (['user'] as $t) {
        $s = Ink::{$t}('name', 'title');
        expect($s->toArray())->toHaveKey('name', 'name');
    }
});

it('can create a page', function () {
    $p = Ink::page('title', tabs: [
        Ink::tab('seo'),
    ])
        ->icon(Icon::GLOBE);

    expect($p->toArray()['icon'])->toBe('globe')
        ->and($p->toArray()['tabs']['seo'])->toBeArray();

    $p = Ink::page('title')
        ->navigation(sortBy: 'title desc')
        ->icon('globe')
        ->options(
            changeStatus: true,
            changeTemplate: false,
        );

    expect($p->toArray()['icon'])->toBe('globe')
        ->and($p->toArray()['navigation']['sortBy'])->toBe('title desc')
        ->and($p->toArray()['options']['changeTemplate'])->toBeFalse();
});

it('can make a file', function () {
    $f = Ink::file('jpgs')
        ->accept(extension: 'jpg');

    expect($f->toArray()['accept']['extension'])->toBe('jpg');
});

it('can make a user', function () {
    // TODO: why do kirby blueprints for user need name & title to be valid?
    $u = Ink::user('editor', 'title')
        ->permissions(users: false);

    $u = $u->toArray();
    expect($u['name'])->toBe('editor')
        ->and($u['permissions']['users'])->toBeFalse();
});

it('can make a site', function () {
    $s = Ink::site('My site')
        ->options(changeTitle: false)
        ->columns([
            Ink::column(id: 'center', fields: [
                Ink::field('text', label: 'text'),
            ]),
        ]);

    $s = $s->toArray();

    expect($s['options']['changeTitle'])->toBeFalse()
        ->and($s['columns']['center']['fields']['text'])->toHaveKey('type', 'text');
});
