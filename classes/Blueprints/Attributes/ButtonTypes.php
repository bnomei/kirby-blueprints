<?php

namespace Bnomei\Blueprints\Attributes;

enum ButtonTypes: string
{
    case BOLD = 'bold';
    case ITALIC = 'italic';
    case SEPARATOR = '|';
    case LINK = 'link';
}
