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
 * @method static User user(string $name, string $title, string $description = null, string $home = null, mixed $image = null, mixed $permissions = null, array $tabs = [], array $columns = [], array $sections = [], array $fields = [])
 * @method static Field field($type = null, string|null $id = null, string|array|null $label = null, array $properties = [], string|float|null $width = null, string|null $extends = null)
 * @method static Section section(string|SectionTypes $type, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Section info(string|SectionTypes $type = SectionTypes::INFO, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Section stats(string|SectionTypes $type = SectionTypes::STATS, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Section pages(string|SectionTypes $type = SectionTypes::PAGES, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Section files(string|SectionTypes $type = SectionTypes::FILES, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Section fields(string|SectionTypes $type = SectionTypes::FIELDS, array $fields = [], array $columns = [], mixed $empty = null, bool $flip = null, mixed $headline = null, mixed $help = null, array $image = [], mixed $info = null, ?string $id = null, mixed $label = null, ?string $layout = 'list', int $limit = null, int $max = null, int $min = null, int $page = null, string $parent = null, bool $search = null, string $size = null, string $sortBy = null, bool $sortable = null, string $template = null, string $text = null, string $theme = null, mixed $create = null, string $status = null, array $templates = [], mixed $reports = null)
 * @method static Column column(string|float $width = null, bool $sticky = false, ?string $id = null, array $sections = [], array $fields = [])
 * @method static Tab tab(array|string $label, Icon $icon = null, ?string $id = null, array $columns = [], array $sections = [], array $fields = [])
 */
class Ink
{
    const ALPHA = 'alpha';
    const ACCEPT = 'accept';

    const AFTER = 'after';

    const API = 'api';

    const AUTOCOMPLETE = 'autocomplete';

    const AUTOFOCUS = 'autofocus';

    const BEFORE = 'before';

    const BLUEPRINT = 'blueprint';

    const BUTTONS = 'buttons';

    const CALENDAR = 'calendar';

    const COLOR = 'color';

    const COLUMNS = 'columns';

    const CONVERTER = 'converter';

    const COUNTER = 'counter';

    const DEFAULT = 'default';

    const DISABLED = 'disabled';

    const DISPLAY = 'display';

    const EMPTY = 'empty';

    const EXTENDS = 'extends';

    const FIELDSETS = 'fieldsets';

    const FIELDS = 'fields';

    const FILES = 'files';

    const FONT = 'font';

    const FORMAT = 'format';

    const GROW = 'grow';

    const HELP = 'help';

    const ICON = 'icon';

    const IMAGE = 'image';

    const INFO = 'info';

    const INLINE = 'inline';

    const LABEL = 'label';

    const LAYOUT = 'layout';

    const LAYOUTS = 'layouts';

    const LINK = 'link';

    const MARKS = 'marks';

    const MAX = 'max';

    const MAXLENGTH = 'maxlength';

    const MIN = 'min';
    const MODE = 'mode';

    const MULTIPLE = 'multiple';

    const NODES = 'nodes';

    const NUMBERED = 'numbered';

    const OPTIONS = 'options';

    const PATH = 'path';

    const PATTERN = 'pattern';

    const PLACEHOLDER = 'placeholder';

    const PREPEND = 'prepend';

    const PROPERTY = 'property';

    const QUERY = 'query';

    const RANGE = 'range';

    const REQUIRED = 'required';

    const RESET = 'reset';

    const SEARCH = 'search';

    const SEPARATOR = 'separator';

    const SIZE = 'size';

    const SORTBY = 'sortby';

    const SORTABLE = 'sortable';

    const SPELLCHECK = 'spellcheck';

    const STATS = 'stats';

    const STEP = 'step';

    const STORE = 'store';

    const SUBPAGES = 'subpages';

    const SYNC = 'sync';

    const TEXT = 'text';

    const THEME = 'theme';

    const TIME = 'time';

    const TIMENOTATION = 'timenotation';

    const TOOLTIP = 'tooltip';

    const TRANSLATE = 'translate';

    const TYPE = 'type';

    const UPLOADS = 'uploads';

    const WHEN = 'when';

    const WIDTH = 'width';

    const WIZARD = 'wizard';

    const BLOCKS = 'blocks';

    const FILE = 'file';

    const PAGE = 'page';

    const PAGES = 'pages';

    const TEXTAREA = 'textarea';

    const CHECKBOXES = 'checkboxes';

    const DATE = 'date';

    const EMAIL = 'email';

    const GAP = 'gap';

    const HEADLINE = 'headline';

    const HIDDEN = 'hidden';

    const LINE = 'line';

    const LIST = 'list';

    const MULTISELECT = 'multiselect';

    const NUMBER = 'number';

    const OBJECT = 'object';

    const RADIO = 'radio';

    const SELECT = 'select';

    const SLUG = 'slug';

    const STRUCTURE = 'structure';

    const TAGS = 'tags';

    const TEL = 'tel';

    const TOGGLE = 'toggle';

    const TOGGLES = 'toggles';

    const URL = 'url';

    const USERS = 'users';

    const WRITER = 'writer';

    public static function __callStatic(string $name, array $arguments): mixed
    {
        // TODO: replace with \Bnomei\Blueprints\Schema\SectionTypes::cases()
        if (in_array($name, ['info', 'files', 'pages', 'fields', 'stats'])) {
            $arguments['type'] = $name;
            $name = 'section';
        }
        $class = 'Bnomei\\Blueprints\\Schema\\'.ucfirst($name);
        if (class_exists($class)) {
            return $class::make(...$arguments);
        }

        return null;
    }
}
