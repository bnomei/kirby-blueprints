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
 * @method self extension(null|string|array $extension = null)
 * @method self mime(null|string|array $mime = null)
 * @method self maxHeight(null|int $maxheight = null)
 * @method self maxSize(null|int $maxsize = null)
 * @method self maxWidth(null|int $maxwidth = null)
 * @method self minHeight(null|int $minheight = null)
 * @method self minSize(null|int $minsize = null)
 * @method self minWidth(null|int $minwidth = null)
 * @method self orientation(null|string $orientation = null)
 * @method self type(null|string|array $type = null)
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
    ) {}

    public static function make(
        string|array|null $extension = null,
        string|array|null $mime = null,
        ?int $maxheight = null,
        ?int $maxsize = null,
        ?int $maxwidth = null,
        ?int $minheight = null,
        ?int $minsize = null,
        ?int $minwidth = null,
        ?string $orientation = null, // landscape/square/portrait
        string|array|null $type = null,
        array $properties = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
