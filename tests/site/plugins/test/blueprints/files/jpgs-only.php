<?php

use Bnomei\Blueprints\Schema\File;

return File::make('jpgs-only')
    ->accept(
        extension: ['jpg', 'jpeg'],
        maxsize: 1024 * 8000 // 8MB
    )
    ->toArray();
