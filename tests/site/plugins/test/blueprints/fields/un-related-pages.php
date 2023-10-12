<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldTypes;

return Field::make(
    type: FieldTypes::PAGES,
    label: 'Un-Related Pages',
    properties: [
        'required' => true,
    ],
    width: '1/2'
)->toArray();
