<?php

namespace Bnomei\Blueprints\Schema;

use Bnomei\Blueprints\HasFluentSetter;
use Bnomei\Blueprints\IsArrayable;

/**
 * @method self tabs(Tab[] $tabs)
 * @method self sections(Section[] $sections)
 * @method self columns(Column[] $columns)
 * @method self fields(Field[] $fields)
 */
class File
{
    use HasFluentSetter;
    use IsArrayable;

    public function __construct(
        public string $title, // TODO: should be an string OR array of languages
        public mixed $image = null,
        public mixed $accept = null,
        public mixed $options = null,
        public array $tabs = [],
        public array $columns = [],
        public array $sections = [],
        public array $fields = [],
    ) {}

    /**
     * @param  FileImage  $image
     * @param  string|FileAccept  $accept
     * @param  FileOptions  $options
     * @param  array<Tab>  $tabs
     * @param  array<Column>  $columns
     * @param  array<Section>  $sections
     * @param  array<Field>  $fields
     */
    public static function make(
        string $title,
        mixed $image = null,
        mixed $accept = null,
        mixed $options = null,
        array $tabs = [],
        array $columns = [],
        array $sections = [],
        array $fields = [],
    ): self {
        return new self(...func_get_args()); // @phpstan-ignore-line
    }

    public function accept(
        string|array|null $extension = null,
        string|array|null $mime = null,
        ?int $maxheight = null,
        ?int $maxsize = null,
        ?int $maxwidth = null,
        ?int $minheight = null,
        ?int $minsize = null,
        ?int $minwidth = null,
        ?string $orientation = null, // landscape/square/portrait
        string|array|null $type = null,
        array $properties = [],
    ): self {
        $this->accept = FileAccept::make(...func_get_args());  // @phpstan-ignore-line;

        return $this;
    }

    public function image(
        ?string $back = null,
        ?string $color = null,
        ?string $icon = null,
        ?string $query = null,
    ): self {
        $this->image = FileImage::make(...func_get_args());  // @phpstan-ignore-line;

        return $this;
    }

    public function options(
        bool|array $changeName = true,
        bool|array $replace = true,
        bool|array $delete = true,
        bool|array $read = true,
        bool|array $update = true,
        array $properties = [],
    ): self {
        $this->options = FileOptions::make(...func_get_args());  // @phpstan-ignore-line

        return $this;
    }
}
