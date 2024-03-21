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
class Page
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $title, // TODO: should be an string OR array of languages
        public ?string $num = null,
        public mixed $status = null,
        public mixed $icon = null,
        public mixed $image = null,
        public mixed $options = null,
        public mixed $navigation = null,
        public array $tabs = [],
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  PageStatus  $status
     * @param  PageImage  $image
     * @param  PageOptions  $options
     * @param  PageNavigation  $navigation
     * @param  Icon|string  $icon
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $title,
        ?string $num = null,
        mixed $status = null,
        mixed $icon = null,
        mixed $image = null,
        mixed $options = null,
        mixed $navigation = null,
        array $tabs = [],
        array $columns = [],
        array $sections = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
