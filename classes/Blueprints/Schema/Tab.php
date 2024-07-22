<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self icon(Icon|null $icon)
 * @method self id(string $id)
 * @method self label(array|string $label)
 * @method self sections(Section[] $sections)
 * @method self columns(Column[] $columns)
 * @method self fields(Field[] $fields)
 */
class Tab
{
    use HasFluentSetter;
    use IsArrayable;

    /**
     * @param  array<string, string>  $label
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public function __construct(
        public string|array $label = '',
        public ?Icon $icon = null,
        public ?string $id = null,
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  array<string, string>  $label
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        array|string $label,
        ?Icon $icon = null,
        ?string $id = null,
        array $columns = [],
        array $sections = [],
        array $fields = []
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
