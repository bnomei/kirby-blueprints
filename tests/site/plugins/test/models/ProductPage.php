<?php

use Bnomei\Blueprints\Attributes\CustomType;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class ProductPage extends Page
{
    // public static bool $cacheBlueprint = false;
    use Bnomei\Blueprints\hasBlueprint;
    use \hasDescriptionField;

    #[
        CustomType('qrcode'),
    ]
    public function qrcode(): Field
    {
        return parent::__call(__METHOD__);
    }
}
