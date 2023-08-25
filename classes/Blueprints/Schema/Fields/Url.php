<?php

namespace Bnomei\Blueprints\Schema\Fields;

use Bnomei\Blueprints\isArrayable;
use JetBrains\PhpStorm\Deprecated;

#[
    Deprecated
]
class Url
{
    use isArrayable;

    /**
     * @param  string|array<string,string>  $label
     */
    public static function make(
        string|array $label = null,
        string|float $width = null,
    ): self {
        return new self(...func_get_args());
    }

    public function __construct(
        public string $type = 'url',
        public string|array|null $label = null,
        public string|float|null $width = null,
    ) {
    }
}
