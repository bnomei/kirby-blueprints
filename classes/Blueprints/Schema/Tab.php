<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method icon(Icon|null $icon): self
 * @method label(array|string $label): self
 * @method sections(Section[] $sections): self
 * @method columns(Column[] $columns): self
 * @method fields(Field[] $fields): self
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
        Icon $icon = null,
        array $columns = [],
        array $sections = [],
        array $fields = []
    ): static {
        return new static(...func_get_args());
    }
}
