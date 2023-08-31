<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method status(string|array $status): self
 * @method template(string|array $template): self
 * @method sortBy(string $sortBy): self
 */
class PageNavigation
{
    use HasFluentSetter;

    public function __construct(
        public string|array $status = 'all',
        public string|array $template = 'all',
        public string $sortBy = 'title asc',
    ) {
    }

    public static function make(
        string|array $status = 'all',
        string|array $template = 'all',
        string $sortBy = 'title asc',
    ): static {
        return new static(...func_get_args());
    }
}
