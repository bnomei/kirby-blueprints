<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method width(float|string|null $width): self
 * @method sections(Section[] $sections): self
 * @method fields(Field[] $fields): self
 */
class Column
{
    use HasFluentSetter;
    use IsArrayable;

    /**
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public function __construct(
        public string|float|null $width = null,
        public bool $sticky = false,
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string|float $width = null,
        bool $sticky = false,
        array $sections = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
