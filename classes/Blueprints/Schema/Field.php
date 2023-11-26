<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;
use Bnomei\Blueprints\HasStaticMake;
use JsonSerializable;

/**
 * @method self type(FieldTypes|string $type)
 * @method self id(string|null $id)
 * @method self label(array|string|null $label)
 * @method self width(float|string|null $width)
 * @method self property(string $name, mixed $value)
 * @method self properties(array $properties)
 */
class Field implements JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;
    use HasStaticMake;

    public mixed $type = null;

    public function __construct(
        mixed $type = null,
        public ?string $id = null,
        public string|array|null $label = null,
        public array $properties = [],
        public string|float|null $width = null,
    ) {
        $this->type ??= $type; // allow override from inheriting class
    }
}
