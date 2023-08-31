<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method fields(Field[] $fields): self
 */
class Section
{
    use HasFluentSetter;
    use IsArrayable;

    /**
     * @param  array<Field>  $fields
     */
    public function __construct(
        public array $fields = [],
    ) {
    }

    /**
     * @param  array<Field>  $fields
     */
    public static function make(
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
