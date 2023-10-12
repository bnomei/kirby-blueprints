<?php

use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesWithAttributes;
use Bnomei\Blueprints\Schema\FieldTypes;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class ErrorPage extends Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesWithAttributes;

    #[
        Label('Loaded'),
        Type(FieldTypes::TEXT),
    ]
    public Field $fromblue;
}
