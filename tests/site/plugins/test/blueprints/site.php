<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\Site;
use Bnomei\Ink;

return Site::make('Site (PHP)')
    ->sections([
        Ink::fields()->fields([
            'info' => Field::make('info')
                ->label('Blueprint source:')
                ->property('text', 'from PHP: '.__FILE__),
        ],
        ),
        Ink::pages()->label('Pages'),
    ])
    ->toArray();
