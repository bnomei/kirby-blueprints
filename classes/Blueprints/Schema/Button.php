<?php

namespace Bnomei\Blueprints\Schema;

enum Button: string
{
    case BOLD = 'bold';
    case ITALIC = 'italic';
    case SEPARATOR = '|';
    case LINK = 'link';
}
