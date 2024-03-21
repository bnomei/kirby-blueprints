<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self width(float|string|null $width)
 * @method self sections(Section[] $sections)
 * @method self id(string $id)
 * @method self fields(Field[] $fields)
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
        public ?string $id = null,
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string|float|null $width = null,
        bool $sticky = false,
        ?string $id = null,
        array $sections = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
