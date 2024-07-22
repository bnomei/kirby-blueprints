<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method self changeSlug(bool|array $changeSlug = true)
 * @method self changeStatus(bool|array $changeStatus = true)
 * @method self changeTemplate(bool|array $changeTemplate = true)
 * @method self changeTitle(bool|array $changeTitle = true)
 * @method self create(bool|array $create = true)
 * @method self delete(bool|array $delete = true)
 * @method self duplicate(bool|array $duplicate = true)
 * @method self preview(bool|string $preview = true)
 * @method self read(bool|array $read = true)
 * @method self sort(bool|array $sort = true)
 * @method self update(bool|array $update = true)
 */
class PageOptions implements \JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(
        public bool|array $changeSlug = true,
        public bool|array $changeStatus = true,
        public bool|array $changeTemplate = true,
        public bool|array $changeTitle = true,
        public bool|array $create = true,
        public bool|array $delete = true,
        public bool|array $duplicate = true,
        public bool|string $preview = true,
        public bool|array $read = true,
        public bool|array $sort = true,
        public bool|array $update = true,
        public array $properties = [],
    ) {
    }

    public static function make(
        bool|array $changeSlug = true,
        bool|array $changeStatus = true,
        bool|array $changeTemplate = true,
        bool|array $changeTitle = true,
        bool|array $create = true,
        bool|array $delete = true,
        bool|array $duplicate = true,
        bool|string $preview = true,
        bool|array $read = true,
        bool|array $sort = true,
        bool|array $update = true,
        array $properties = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
