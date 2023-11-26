<?php

namespace Bnomei\Blueprints\Schema;

enum FieldProperties: string
{
    case BUTTONS = 'buttons';
    case MAXLENGTH = 'maxlength';
    case SPELLCHECK = 'spellcheck';

    // TODO: add more
}
