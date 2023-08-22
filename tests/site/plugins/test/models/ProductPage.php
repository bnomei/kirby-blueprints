<?php

use Kirby\Cms\Page;

class ProductPage extends Page
{
    // public static bool $cacheBlueprint = false;
    use Bnomei\Blueprints\hasBlueprint;
    use \hasDescriptionField;
}
