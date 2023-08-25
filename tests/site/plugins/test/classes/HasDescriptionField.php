<?php

use Bnomei\Blueprints\Attributes\Buttons;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\MaxLength;
use Bnomei\Blueprints\Attributes\Spellcheck;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\Schema\Button;
use Bnomei\Blueprints\Schema\FieldTypes;
use Kirby\Content\Field;

trait HasDescriptionField
{
    #[
        Type(FieldTypes::TEXTAREA),
        Label([
            'de' => 'Beschreibung',
            'en' => 'Description',
        ]),
        Buttons([
            Button::BOLD,
            Button::ITALIC,
            Button::SEPARATOR,
            Button::LINK,
        ]),
        MaxLength(3000),
        Spellcheck(true),
    ]
    public function description(): Field
    {
        return parent::__call(__METHOD__);
    }
}
