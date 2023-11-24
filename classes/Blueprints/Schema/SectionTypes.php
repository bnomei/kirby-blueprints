<?php

namespace Bnomei\Blueprints\Schema;

enum SectionTypes: string
{
    case FIELDS = 'fields';
    case FILES = 'files';
    case INFO = 'info';
    case PAGES = 'pages';
    case STATS = 'stats';

}
