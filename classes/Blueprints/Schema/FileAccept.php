<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method changeName(bool|array $changeName = true): self
 * @method replace(bool|array $replace = true): self
 * @method delete(bool|array $delete = true): self
 * @method read(bool|array $read = true): self
 * @method update(bool|array $update = true): self
 * @method extension(null|string|array $extension = null): self
 * @method mime(null|string|array $mime = null): self
 * @method maxHeight(null|int $maxheight = null): self
 * @method maxSize(null|int $maxsize = null): self
 * @method maxWidth(null|int $maxwidth = null): self
 * @method minHeight(null|int $minheight = null): self
 * @method minSize(null|int $minsize = null): self
 * @method minWidth(null|int $minwidth = null): self
 * @method orientation(null|string $orientation = null): self
 * @method type(null|string|array $type = null): self
 */
class FileAccept implements \JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(
        public null|string|array $extension = null,
        public null|string|array $mime = null,
        public ?int $maxheight = null,
        public ?int $maxsize = null,
        public ?int $maxwidth = null,
        public ?int $minheight = null,
        public ?int $minsize = null,
        public ?int $minwidth = null,
        public ?string $orientation = null, // landscape/square/portrait
        public null|string|array $type = null,
        public array $properties = [],
    ) {
    }

    public static function make(
        string|array $extension = null,
        string|array $mime = null,
        int $maxheight = null,
        int $maxsize = null,
        int $maxwidth = null,
        int $minheight = null,
        int $minsize = null,
        int $minwidth = null,
        string $orientation = null, // landscape/square/portrait
        string|array $type = null,
        array $properties = [],
    ): static {
        return new static(...func_get_args());
    }
}
