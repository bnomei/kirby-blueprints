<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\isArrayable;

class Tab
{
    use isArrayable;

    /**
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $label = '',
        Icon $icon = null,
        array $columns = [],
        //		array $sections = [],
        //		array $fields = [],
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     * @return Page
     */
    public function __construct(
        public string $label = '',
        public ?Icon $icon = null,
        public array $columns = [],
        //		public array $section = [],
        //		public array $fields = [],
    ) {
    }
}
