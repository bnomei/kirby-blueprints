<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\CustomType;
use Bnomei\Blueprints\Attributes\Property;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class ProductPage extends Page
{
    // public static bool $cacheBlueprint = false;
    use Bnomei\Blueprints\hasBlueprint;
    use \hasDescriptionField;

    #[
        CustomType('qrcode'),
        Property('Custom key', 'custom data'),
    ]
    public function qrcode(): Field
    {
        return parent::__call(__METHOD__);
    }

	#[
		Blueprint
	]
	public static function blueprintFromMyCustomMethod(): array
	{
		return [
			'sections' => [
				'files' => [
					'type' => 'files',
					'label' => 'All Files',
				],
			],
		];
	}
}
