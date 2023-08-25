<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\IsArrayable;

class Page
{
    use IsArrayable;

    /**
     * @param  Page  $page
     * @param  PageOptions  $pageoptions
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        //		?Page $page = null,
        //		?PageOptions $pageoptions = null,
        array $tabs = [],
        array $columns = [],
        //		array $sections = [],
        //		array $fields = [],
    ): self {
        return new self(...func_get_args());
    }

    /**
     * @param  Page  $page
     * @param  PageOptions  $options
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     * @return Page
     */
    public function __construct(
        //		public ?Page $page = null,
        //		public ?PageOptions $options = null,
        public array $tabs = [],
        public array $columns = [],
        //		public array $section = [],
        //		public array $fields = [],
    ) {
    }

    public function tabs(array $tabs): Page
    {
        $this->tabs = $tabs;

        return $this;
    }

    public function columns(array $columns): Page
    {
        $this->columns = $columns;

        return $this;
    }
}
