<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method self changeTitle(bool|array $changeTitle = true)
 * @method self update(bool|array $update = true)
 */
class SiteOptions implements \JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(
        public bool|array $changeTitle = true,
        public bool|array $update = true,
        public array $properties = [],
    ) {
    }

    public static function make(
        bool|array $changeTitle = true,
        bool|array $update = true,
        array $properties = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
