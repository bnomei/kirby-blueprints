<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method draft(string|array $draft): self
 * @method unlisted(string|array $unlisted): self
 * @method listed(string|array $listed): self
 */
class PageStatus
{
    use HasFluentSetter;

    public function __construct(
        public string|array $draft,
        public string|array $unlisted,
        public string|array $listed,
    ) {
    }

    public static function make(
        string|array $draft,
        string|array $unlisted,
        string|array $listed,
    ): static {
        return new static(...func_get_args());
    }
}
