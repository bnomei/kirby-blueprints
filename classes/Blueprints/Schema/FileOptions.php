<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method self changeName(bool|array $changeName = true)
 * @method self replace(bool|array $replace = true)
 * @method self delete(bool|array $delete = true)
 * @method self read(bool|array $read = true)
 * @method self update(bool|array $update = true)
 */
class FileOptions implements \JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(

        public bool|array $changeName = true,
        public bool|array $replace = true,
        public bool|array $delete = true,
        public bool|array $read = true,
        public bool|array $update = true,
        public array $properties = [],
    ) {
    }

    public static function make(
        bool|array $changeName = true,
        bool|array $replace = true,
        bool|array $delete = true,
        bool|array $read = true,
        bool|array $update = true,
        array $properties = [],
    ): static {
        return new static(...func_get_args());
    }
}
