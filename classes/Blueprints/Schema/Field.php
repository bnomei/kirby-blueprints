<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;
use JsonSerializable;

/**
 * @method label(array|string|null $label): self
 * @method width(float|string|null $width): self
 */
class Field implements JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(
        public mixed $type = null,
        public string|array|null $label = null,
        public array $properties = [],
        public string|float|null $width = null,
    ) {
    }

    public static function make(
        mixed $type = null,
        string|array $label = null,
        array $properties = [],
        string|float $width = null,
    ): static {
        return new static(...func_get_args());
    }
}
