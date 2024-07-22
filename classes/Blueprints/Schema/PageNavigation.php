<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;

/**
 * @method self status(string|array $status)
 * @method self template(string|array $template)
 * @method self sortBy(string $sortBy)
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
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }
}
