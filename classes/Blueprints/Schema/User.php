<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self tabs(Tab[] $tabs)
 * @method self sections(Section[] $sections)
 * @method self columns(Column[] $columns)
 * @method self fields(Field[] $fields)
 * @method self name(string $name)
 * @method self title(string $title)
 * @method self description(string $description)
 * @method self home(string $home)
 * @method self image(UserImage $image)
 */
class User
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $name,
        public string $title, // TODO: should be an string OR array of languages
        public ?string $description = null, // TODO: should be an string OR array of languages
        public ?string $home = null,
        public mixed $image = null,
        public mixed $permissions = null,
        public array $tabs = [],
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {}

    /**
     * @param  UserImage  $image
     * @param  UserPermissions  $permissions
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $name,
        string $title,
        ?string $description = null,
        ?string $home = null,
        mixed $image = null,
        mixed $permissions = null,
        array $tabs = [],
        array $columns = [],
        array $sections = [],
        array $fields = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }

    public function permissions(
        bool|array $access = true,
        bool|array $files = true,
        bool|array $pages = true,
        bool|array $site = true,
        bool|array $user = true,
        bool|array $users = true,
        array $properties = []
    ): self {
        $this->permissions = UserPermissions::make(...func_get_args());  // @phpstan-ignore-line;

        return $this;
    }
}
