<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method self back(string $back)
 * @method self color(string $color)
 * @method self icon(string $icon)
 * @method self query(string $query)
 */
class PageImage
{
    use HasFluentSetter;

    public function __construct(
        public ?string $back = null,
        public ?string $color = null,
        public ?string $icon = null,
        public ?string $query = null,
    ) {
    }

    public static function make(
        ?string $back = null,
        ?string $color = null,
        ?string $icon = null,
        ?string $query = null,
    ): static {
        return new static(...func_get_args());
    }
}
