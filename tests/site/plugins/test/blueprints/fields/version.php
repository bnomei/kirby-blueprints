<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldTypes;

return fn () => Field::make(FieldTypes::INFO)
    ->text('Kirby v'.kirby()->version())
    ->toArray();
