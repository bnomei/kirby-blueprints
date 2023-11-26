<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\Schema\Fields\TextField;
use Bnomei\Blueprints\Schema\FieldTypes;
use Bnomei\Blueprints\Schema\SectionTypes;
use Bnomei\HasInk;
use Bnomei\Ink;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class DynamoPage extends Page
{
    use HasInk;

    #[
        Label('Loaded'),
        Type(FieldTypes::TEXT),
    ]
    public Field $fromblue;

    #[
        Blueprint
    ]
    public static function nameOfThisMethodDoesNotMatterOnlyTheAttribute(): array
    {
        // IMPORTANT: be carefull when using kirby() or site() or page() or option() here
        // since the THIS method is called before the kirby instance is fully available.
        // if you need such behaviour register the blueprint in the plugins:after hook.

        $kirby = kirby();
        $site = $kirby->site();
        $user = $kirby->user();

        // $kirby->blueprints() ==> empty
        // $site->blueprints() ==> unreliable due to being filled at this stage, will occasionally break the panel

        $x = Ink::page(
            title: 'Dynamo',
            columns: [
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
                            ->property('placeholder', option('bnomei.blueprints.test')) // does not work
                            ->property('help', 'expected: Test'),
                        TextField::make()
                            ->label('Value from Plugin Options')
                            ->placeholder(option('debug') ? 'true' : 'false'),
                        TextField::make()
                            ->placeholder('hello')
                            ->label('Value from Plugin Options'),
                    ]),
                    Ink::section(SectionTypes::FILES)
                        ->label('Files')
                        ->id('filesyoyo'),
                ]),
            ],

        )->toArray();

        ray($x)->red();

        return $x;
    }
}
