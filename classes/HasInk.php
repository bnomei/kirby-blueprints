<?php

namespace Bnomei;

use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesMappedToKirbyFields;

trait HasInk
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;
}
