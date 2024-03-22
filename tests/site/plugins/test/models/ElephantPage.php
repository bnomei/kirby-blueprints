<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\HasInk;
use Bnomei\Ink;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class ElephantPage extends Page
{
    use HasInk;

    #[
        Label('Left Ear'),
        Type(Ink::TEXT),
    ]
    public Field $leftEar;

    #[
        Label('Right Ear'),
        Type(Ink::TAGS),
    ]
    public Field $rightEar;

    #[
        Blueprint(cache: 500)
    ]
    public static function elephantsBlueprint(): array
    {
        return Ink::page(
            title: 'Elephant',
            columns: [
                Ink::column(2 / 3)->fields([
                    'leftEar',
                    Ink::field(Ink::BLOCKS)
                        ->label('Trunk')
                        ->property(Ink::EMPTY, '🐘'),
                    'rightEar',
                ]),
                Ink::column(1 / 3)->sections([
                    Ink::fields()->fields([
                        Ink::field(Ink::TEXT)
                            ->label('User')
                            ->property(Ink::PLACEHOLDER, '{{ user.nameOrEmail }} ({{ user.role.name }})'),
                    ]),
                    Ink::info()
                        ->label('Kirby Version')
                        ->theme(Ink::INFO)
                        ->text('{{ kirby.version }}'),
                    Ink::files()
                        ->label('Files'),
                ]),
            ],
        )->toArray();
    }
}
