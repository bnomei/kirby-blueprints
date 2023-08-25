<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\IsArrayable;

class Tab
{
    use IsArrayable;

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
        public string|array $label = '',
        public ?Icon $icon = null,
        public array $columns = [],
        //		public array $section = [],
        //		public array $fields = [],
    ) {
    }

    public function label(string|array $label): Tab
    {
        $this->label = $label;

        return $this;
    }

    public function icon(?Icon $icon): Tab
    {
        $this->icon = $icon;

        return $this;
    }

    public function columns(array $columns): Tab
    {
        $this->columns = $columns;

        return $this;
    }
}
