<?php

namespace Bnomei\Blueprints\Schema\Fields;

use Bnomei\Blueprints\HasStaticMake;
use Bnomei\Blueprints\Schema\Field;

/**
 * @method label(array|string|null $label)
 * @method placeholder(array|string|null $placeholder)
 * @method width(float|string|null $width)
 *
 * @deprecated use Field::make('text') instead, this is just me testing stuff
 */
class TextField extends Field
{
    use HasStaticMake;

    public mixed $type = 'text';
}
