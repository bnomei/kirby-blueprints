<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self tabs(Tab[] $tabs)
 * @method self sections(Section[] $sections)
 * @method self columns(Column[] $columns)
 * @method self fields(Field[] $fields)
 * @method self title(string $title)
 * @method self num(string $num)
 * @method self icon(string|Icon $icon)
 */
class Page
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public mixed $title,
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
    ) {}

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
        mixed $title,
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
    ): self {
        return new self(...func_get_args());
    }

    public function status(
        string|array $draft,
        string|array $unlisted,
        string|array $listed,
    ): self {
        $this->status = PageStatus::make(...func_get_args());  // @phpstan-ignore-line;

        return $this;
    }

    public function image(
        ?string $back = null,
        ?string $color = null,
        ?string $icon = null,
        ?string $query = null,
    ): self {
        $this->image = PageImage::make(...func_get_args());  // @phpstan-ignore-line;

        return $this;
    }

    public function options(
        bool|array $changeSlug = true,
        bool|array $changeStatus = true,
        bool|array $changeTemplate = true,
        bool|array $changeTitle = true,
        bool|array $create = true,
        bool|array $delete = true,
        bool|array $duplicate = true,
        bool|string $preview = true,
        bool|array $read = true,
        bool|array $sort = true,
        bool|array $update = true,
        array $properties = [],
    ): self {
        $this->options = PageOptions::make(...func_get_args());  // @phpstan-ignore-line

        return $this;
    }

    public function navigation(
        string|array $status = 'all',
        string|array $template = 'all',
        string $sortBy = 'title asc',
    ): self {
        $this->navigation = PageNavigation::make(...func_get_args());  // @phpstan-ignore-line

        return $this;
    }
}
