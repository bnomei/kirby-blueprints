<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method access(bool|array $access = true): self
 * @method files(bool|array $files = true): self
 * @method pages(bool|array $pages = true): self
 * @method site(bool|array $site = true): self
 * @method user(bool|array $user = true): self
 * @method users(bool|array $users = true): self
 */
class UserPermissions implements \JsonSerializable
{
    use HasFluentSetter;
    use HasProperties;

    public function __construct(
        public bool|array $access = true,
        public bool|array $files = true,
        public bool|array $pages = true,
        public bool|array $site = true,
        public bool|array $user = true,
        public bool|array $users = true,
        public array $properties = [],
    ) {
    }

    public static function make(
        bool|array $access = true,
        bool|array $files = true,
        bool|array $pages = true,
        bool|array $site = true,
        bool|array $user = true,
        bool|array $users = true,
        array $properties = [],
    ): static {
        return new static(...func_get_args());
    }
}
