<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method back(string $back): self
 * @method color(string $color): self
 * @method icon(string $icon): self
 * @method query(string $query): self
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
        string $back = null,
        string $color = null,
        string $icon = null,
        string $query = null,
    ): static {
        return new static(...func_get_args());
    }
}
