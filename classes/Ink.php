<?php

namespace Bnomei;

use Bnomei\Blueprints\Schema\Column;
use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\File;
use Bnomei\Blueprints\Schema\Icon;
use Bnomei\Blueprints\Schema\Page;
use Bnomei\Blueprints\Schema\Section;
use Bnomei\Blueprints\Schema\SectionTypes;
use Bnomei\Blueprints\Schema\Site;
use Bnomei\Blueprints\Schema\Tab;
use Bnomei\Blueprints\Schema\User;

/**
 * @method static Site site(string $title, mixed $options = null, array $tabs = [], array $columns = [], array $sections = [], array $fields = [])
 * @method static Page page(string $title, string $num = null, mixed $status = null, mixed $icon = null, mixed $image = null, mixed $options = null, mixed $navigation = null, array $tabs = [], array $columns = [], array $sections = [], array $fields = [])
 * @method static File file(string $title, mixed $image = null, mixed $accept = null, mixed $options = null, array $tabs = [], array $columns = [], array $sections = [], array $fields = [])
 * @method static User user(string $title, string $description = null, string $home = null, mixed $image = null, mixed $permissions = null, array $tabs = [], array $columns = [], array $sections = [], array $fields = [])
 * @method static Field field($type = null, string|null $id = null, string|array|null $label = null, array $properties = [], string|float|null $width = null)
 * @method static Section section(string|SectionTypes $type, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Column column(string|float $width = null, bool $sticky = false, ?string $id = null, array $sections = [], array $fields = [])
 * @method static Tab tab(array|string $label, Icon $icon = null, ?string $id = null, array $columns = [], array $sections = [], array $fields = [])
 */
class Ink
{
    public static function __callStatic(string $name, array $arguments)
    {
        $class = 'Bnomei\\Blueprints\\Schema\\'.ucfirst($name);
        if (class_exists($class)) {
            return $class::make(...$arguments);
        }

        return null;
    }
}
