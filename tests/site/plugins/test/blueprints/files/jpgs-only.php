<?php

use Bnomei\Blueprints\Schema\File;
use Bnomei\Blueprints\Schema\FileAccept;

return File::make('jpgs-only')
    ->accept(FileAccept::make()
        ->extension(['jpg', 'jpeg'])
        ->maxSize(1024 * 8000) // 8MB
    )
    ->toArray();
