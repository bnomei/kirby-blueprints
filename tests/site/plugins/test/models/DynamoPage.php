<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\Schema\FieldTypes;
use Bnomei\Blueprints\Schema\SectionTypes;
use Bnomei\HasInk;
use Bnomei\Ink;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class DynamoPage extends Page
{
    use HasInk;
    // use \Bnomei\Blueprints\HasBlueprintCache;
    // use \Bnomei\Blueprints\HasBlueprintCacheResolve;

    #[
        Label('Loaded'),
        Type(FieldTypes::TEXT),
    ]
    public Field $fromblue;

    #[
        // Blueprint(cache: 100, defer: true)
        Blueprint(defer: true, cache: 0)
        // Blueprint(cache: 0)
    ]
    public static function nameOfThisMethodDoesNotMatterOnlyTheAttribute(): array
    {
        $kirby = kirby();
        $site = $kirby->site();
        $user = $kirby->user();

        $tab1 = Ink::tab('content')
            ->columns([
                Ink::column('1/2')->fields([
                    Ink::field('text', label: 'Kirby Version')
                        ->property('placeholder', $kirby->version()),
                    Ink::field('text', label: 'Site Title')
                        ->property('placeholder', $site->title()),
                    Ink::field('text', 'Blueprints')
                        ->property('placeholder', implode(', ', array_column($kirby->blueprints(), 'name'))),
                ]),
                Ink::column('1/2')->sections([
                    Ink::section(SectionTypes::FIELDS, id: 'hello')->fields([
                        Ink::field('text', label: 'User')
                            ->property('placeholder', $user?->email().' ('.$user?->role().')'),
                        Ink::field('text', label: 'Value from Plugin Options')
                            ->id('d')
                            ->property('placeholder', $kirby->option('test.plugin.test'))
                            ->property('help', 'expected: Test'),
                    ]),
                    Ink::section(SectionTypes::FILES)
                        ->label('Files')
                        ->id('filesyoyo'),
                ]),
            ]);

        $tabs = [
            $tab1,
        ];

        for ($t = 1; $t < 20; $t++) {
            $fields = [];
            $sections = [];
            for ($f = 1; $f < 40; $f++) {
                $fields[] = Ink::field('text', label: 'Field '.$t.$f);
            }
            for ($s = 1; $s < 10; $s++) {
                $sections[] = Ink::section(SectionTypes::FILES)->label('Files '.$t.$s);
            }
            $tabs[] = Ink::tab('tab'.$t)
                ->columns([
                    Ink::column('1/2')->fields($fields),
                    Ink::column('1/2')->sections($sections),
                ]);
        }

        return Ink::page(
            title: 'Dynamo',
            tabs: $tabs,
        )->toArray();
    }
}
