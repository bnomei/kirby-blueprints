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
class Page
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $title,
        public ?string $num = null,
        public array $status = [], // TODO: draft, unlisted, listed [label, text]
        public ?string $icon = null,
        public array $image = [], // TODO: back, icon, query[bool]
        public array $options = [], // TODO: https://getkirby.com/docs/reference/panel/blueprints/page#options
        public array $navigation = [], // TODO: status, template, sortBy
        public array $tabs = [],
        public array $columns = [],
        public array $section = [],
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
        string $num = null,
        array $status = [],
        string $icon = null,
        array $image = [],
        array $options = [],
        array $navigation = [],
        array $tabs = [],
        array $columns = [],
        array $section = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
