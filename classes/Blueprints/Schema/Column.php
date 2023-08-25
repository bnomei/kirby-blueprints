<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\isArrayable;

class Column
{
    use isArrayable;

    /**
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string|float $width = null,
        //		array $sections = [],
        array $fields = [],
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public function __construct(
        public string|float|null $width = null,
        //		public array $section = [],
        public array $fields = [],
    ) {
    }
}
