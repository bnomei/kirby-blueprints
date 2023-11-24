<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * // FIELD
 *
 * @method fields(Field[] $fields): self
 * // FILES
 * @method columns(Column[] $columns): self
 * @method empty(string|array $empty): self
 * @method flip(bool $flip): self
 * @method headline(string|array $headline): self
 * @method help(string|array $help): self
 * @method image(array $image): self
 * @method info(string|array $info): self
 * @method label(string|array $label): self
 * @method layout(string $layout): self
 * @method limit(int $limit): self
 * @method max(int $max): self
 * @method min(int $min): self
 * @method page(int $page): self
 * @method parent(string $parent): self
 * @method search(bool $search): self
 * @method size(string $size): self
 * @method sortBy(string $sortBy): self
 * @method sortable(bool $sortable): self
 * @method template(string $template): self
 * @method text(string $text): self
 * // INFO
 * @method theme(string $text): self
 * // PAGES
 * @method create(bool|array $create): self
 * @method status(string $status='all'): self
 * @method templates(array $templates): self
 * // STATS
 * @method reports(string|array $reports): self
 */
class Section
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string|SectionTypes $type,
        public array $fields = [],
        public array $columns = [],
        public mixed $empty = null,
        public ?bool $flip = null,
        public mixed $headline = null,
        public mixed $help = null,
        public array $image = [],
        public mixed $info = null,
        public mixed $label = null,
        public ?string $layout = 'list',
        public ?int $limit = null,
        public ?int $max = null,
        public ?int $min = null,
        public ?int $page = null,
        public ?string $parent = null,
        public ?bool $search = null,
        public ?string $size = null,
        public ?string $sortBy = null,
        public ?bool $sortable = null,
        public ?string $template = null,
        public ?string $text = null,
        public ?string $theme = null,
        public mixed $create = null,
        public ?string $status = null,
        public array $templates = [],
        public mixed $reports = null,
    ) {
    }

    public static function make(
        string|SectionTypes $type,
        array $fields = [],
        array $columns = [],
        mixed $empty = null,
        bool $flip = null,
        mixed $headline = null,
        mixed $help = null,
        array $image = [],
        mixed $info = null,
        mixed $label = null,
        ?string $layout = 'list',
        int $limit = null,
        int $max = null,
        int $min = null,
        int $page = null,
        string $parent = null,
        bool $search = null,
        string $size = null,
        string $sortBy = null,
        bool $sortable = null,
        string $template = null,
        string $text = null,
        string $theme = null,
        mixed $create = null,
        string $status = null,
        array $templates = [],
        mixed $reports = null,
    ): static {
        return new static(...func_get_args());
    }
}
