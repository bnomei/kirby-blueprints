<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self tabs(Tab[] $tabs)
 * @method self sections(Section[] $sections)
 * @method self columns(Column[] $columns)
 * @method self fields(Field[] $fields)
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
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
