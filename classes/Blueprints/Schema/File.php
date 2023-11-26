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
    ) {
    }

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
    ): static {
        return new static(...func_get_args());
    }
}
