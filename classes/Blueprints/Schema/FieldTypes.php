<?php

namespace Bnomei\Blueprints\Schema;

enum FieldTypes: string
{
    case BLOCKS = 'blocks';
    case CHECKBOXES = 'checkboxes';
    case DATE = 'date';
    case EMAIL = 'email';
    case FILES = 'files';
    case GAP = 'gap';
    case HEADLINE = 'headline';
    case HIDDEN = 'hidden';
    case INFO = 'info';
    case LAYOUT = 'layout';
    case LINE = 'line';
    case LIST = 'list';
    case MULTISELECT = 'multiselect';
    case NUMBER = 'number';
    case OBJECT = 'object';
    case PAGES = 'pages';
    case RADIO = 'radio';
    case RANGE = 'range';
    case SELECT = 'select';
    case SLUG = 'slug';
    case STRUCTURE = 'structure';
    case TAGS = 'tags';
    case TEL = 'tel';
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case TIME = 'time';
    case TOGGLE = 'toggle';
    case TOGGLES = 'toggles';
    case URL = 'url';
    case USERS = 'users';
    case WRITER = 'writer';
}
