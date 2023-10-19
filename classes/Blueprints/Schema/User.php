<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method tabs(Tab[] $tabs): self
 * @method sections(Section[] $sections): self
 * @method columns(Column[] $columns): self
 * @method fields(Field[] $fields): self
 */
class User
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $title, // TODO: should be an string OR array of languages
        public ?string $description = null, // TODO: should be an string OR array of languages
        public ?string $home = null,
        public mixed $image = null,
        public mixed $permissions = null,
        public array $tabs = [],
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {
    }

    /**
     * @param  UserImage  $image
     * @param  UserPermissions  $permissions
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $title,
        string $description = null,
        string $home = null,
        mixed $image = null,
        mixed $permissions = null,
        array $tabs = [],
        array $columns = [],
        array $sections = [],
        array $fields = [],
    ): static {
        return new static(...func_get_args());
    }
}
