<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * // FIELD
 *
 * @method self fields(Field[] $fields)
 *                                      // FILES
 * @method self columns(Column[] $columns)
 * @method self empty(string|array $empty)
 * @method self flip(bool $flip)
 * @method self headline(string|array $headline)
 * @method self help(string|array $help)
 * @method self image(array $image)
 * @method self info(string|array $info)
 * @method self id(string $id)
 * @method self label(string|array $label)
 * @method self layout(string $layout)
 * @method self limit(int $limit)
 * @method self max(int $max)
 * @method self min(int $min)
 * @method self page(int $page)
 * @method self parent(string $parent)
 * @method self search(bool $search)
 * @method self size(string $size)
 * @method self sortBy(string $sortBy)
 * @method self sortable(bool $sortable)
 * @method self template(string $template)
 * @method self text(string $text)
 *                                 // INFO
 * @method self theme(string $text)
 *                                  // PAGES
 * @method self create(bool|array $create)
 * @method self status(string $status = 'all')
 * @method self templates(array $templates)
 *                                          // STATS
 * @method self reports(string|array $reports)
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
        public ?string $id = null,
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
    ) {}

    public static function make(
        string|SectionTypes $type,
        array $fields = [],
        array $columns = [],
        mixed $empty = null,
        ?bool $flip = null,
        mixed $headline = null,
        mixed $help = null,
        array $image = [],
        mixed $info = null,
        ?string $id = null,
        mixed $label = null,
        ?string $layout = 'list',
        ?int $limit = null,
        ?int $max = null,
        ?int $min = null,
        ?int $page = null,
        ?string $parent = null,
        ?bool $search = null,
        ?string $size = null,
        ?string $sortBy = null,
        ?bool $sortable = null,
        ?string $template = null,
        ?string $text = null,
        ?string $theme = null,
        mixed $create = null,
        ?string $status = null,
        array $templates = [],
        mixed $reports = null,
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
