<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method changeSlug(bool|array $changeSlug = true): self
 * @method changeStatus(bool|array $changeStatus = true): self
 * @method changeTemplate(bool|array $changeTemplate = true): self
 * @method changeTitle(bool|array $changeTitle = true): self
 * @method create(bool|array $create = true): self
 * @method delete(bool|array $delete = true): self
 * @method duplicate(bool|array $duplicate = true): self
 * @method preview(bool|string $preview = true): self
 * @method read(bool|array $read = true): self
 * @method sort(bool|array $sort = true): self
 * @method update(bool|array $update = true): self
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
    ): static {
        return new static(...func_get_args());
    }
}
