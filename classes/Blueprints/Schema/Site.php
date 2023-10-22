<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method tabs(Tab[] $tabs): self
 * @method sections(Section[] $sections): self
 * @method columns(Column[] $columns): self
 * @method fields(Field[] $fields): self
 */
class Site
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $title, // TODO: should be an string OR array of languages
        public mixed $options = null,
        public array $tabs = [],
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  SiteOptions  $options
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $title,
        mixed $options = null,
        array $tabs = [],
        array $columns = [],
        array $sections = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}