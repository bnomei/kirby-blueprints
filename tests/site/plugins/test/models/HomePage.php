<?php

use Bnomei\Blueprints\Attributes\ExtendsField;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesMappedToKirbyFields;
use Bnomei\Blueprints\Schema\FieldTypes;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class HomePage extends Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;

    #[
        Label([
            'en' => 'Introduction',
            'de' => 'Einleitung',
        ]),
        Type(FieldTypes::TEXT),
    ]
    public Field $introduction;

    #[
        Label('Extended'),
        ExtendsField('fields/extme'),
    ]
    public Field $extended;
}
