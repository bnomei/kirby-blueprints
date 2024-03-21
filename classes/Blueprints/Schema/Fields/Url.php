<?php

namespace Bnomei\Blueprints\Schema\Fields;

use Bnomei\Blueprints\IsArrayable;
use JetBrains\PhpStorm\Deprecated;

/**
 * @deprecated use Field::make('url') instead, this is just me testing stuff
 */
class Url
{
    use IsArrayable;

    /**
     * @param  string|array<string,string>  $label
     */
    public static function make(
        string|array|null $label = null,
        string|float|null $width = null,
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
