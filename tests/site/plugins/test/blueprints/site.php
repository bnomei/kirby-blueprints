<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\Site;

return Site::make('Site (PHP)')
    ->fields([
        'info' => Field::make('info')
            ->label('Blueprint source:')
            ->property('text', 'from PHP: '.__FILE__),
    ])->toArray();
