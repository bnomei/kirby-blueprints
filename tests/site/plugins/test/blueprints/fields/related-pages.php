<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldTypes;

return Field::make(FieldTypes::PAGES)
    ->label('Related Pages')
    ->required(true)
    ->width('1/2')
    ->toArray();
