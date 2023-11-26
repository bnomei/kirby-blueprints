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

class ElephantPage extends Page
{
    use HasInk;

    #[
        Label('Left Ear'),
        Type(FieldTypes::TEXT),
    ]
    public Field $leftEar;

    #[
        Label('Right Ear'),
        Type(FieldTypes::TAGS),
    ]
    public Field $rightEar;

    #[
        Blueprint
    ]
    public static function elephantsBlueprint(): array
    {
        $user = kirby()->user();

        return Ink::page(
            title: 'Elephant',
            columns: [
                Ink::column(2 / 3)->fields([
                    'leftEar' => true,
                    Ink::field(FieldTypes::BLOCKS)
                        ->label('Trunk')
                        ->property('empty', '🐘'),
                    'rightEar' => true,
                ]),
                Ink::column(1 / 3)->sections([
                    Ink::section(SectionTypes::FIELDS)->fields([
                        Ink::field('text', label: 'User')
                            ->property('placeholder', $user?->email().' ('.$user?->role().')'),
                    ]),
                    Ink::section(SectionTypes::INFO)
                        ->label('Kirby Version')
                        ->theme('info')
                        ->text(kirby()->version()),
                    Ink::section(SectionTypes::FILES)
                        ->label('Files'),
                ]),
            ],
        )->toArray();
    }
}
