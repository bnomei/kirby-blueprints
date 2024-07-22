<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\HasProperties;

/**
 * @method self access(bool|array $access = true)
 * @method self files(bool|array $files = true)
 * @method self pages(bool|array $pages = true)
 * @method self site(bool|array $site = true)
 * @method self user(bool|array $user = true)
 * @method self users(bool|array $users = true)
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
    ) {}

    public static function make(
        bool|array $access = true,
        bool|array $files = true,
        bool|array $pages = true,
        bool|array $site = true,
        bool|array $user = true,
        bool|array $users = true,
        array $properties = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
