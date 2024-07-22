<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method self draft(string|array $draft)
 * @method self unlisted(string|array $unlisted)
 * @method self listed(string|array $listed)
 */
class PageStatus
{
    use HasFluentSetter;

    public function __construct(
        public string|array $draft,
        public string|array $unlisted,
        public string|array $listed,
    ) {}

    public static function make(
        string|array $draft,
        string|array $unlisted,
        string|array $listed,
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
