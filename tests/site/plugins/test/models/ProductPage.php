<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\CustomType;
use Bnomei\Blueprints\Attributes\Property;
use Bnomei\Blueprints\Schema\Column;
use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldProperties;
use Bnomei\Blueprints\Schema\Fields\Url;
use Bnomei\Blueprints\Schema\FieldTypes;
use Bnomei\Blueprints\Schema\Icon;
use Bnomei\Blueprints\Schema\Page;
use Bnomei\Blueprints\Schema\Tab;

class ProductPage extends \Kirby\Cms\Page
{
    // public static bool $cacheBlueprint = false;
    use Bnomei\Blueprints\HasBlueprint;
    use HasDescriptionField;

    #[
        CustomType('qrcode'),
        Property('Custom key', 'custom data'),
    ]
    public function qrcode(): Kirby\Content\Field
    {
        return parent::__call(__METHOD__);
    }

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

    #[
        Blueprint
    ]
    public static function thisIsACustomBlueprint(): array
    {
        return Page::make(
            // options: [],
            tabs: [
                Tab::make(
                    label: 'Shop',
                    icon: Icon::CART,
                    columns: [
                        Column::make()
                            ->width(1 / 3),
                        Column::make(
                            width: 2 / 3,
                            fields: [
                                // generic
                                'intro' => Field::make(
                                    type: FieldTypes::TEXTAREA,
                                    label: 'Introduction',
                                    // for custom props use a method with attributes or...
                                    properties: [
                                        FieldProperties::MAXLENGTH->value => 3000,
                                        FieldProperties::SPELLCHECK->value => false,
                                        FieldProperties::BUTTONS->value => false,
                                    ],
                                )
                                // ->property(FieldProperties::MAXLENGTH->value, 3000)
                                // ->property(FieldProperties::SPELLCHECK->value, false)
                                // ->property(FieldProperties::BUTTONS->value, false)
                                ,
                                /*
                                 * THIS WOULD MEAN CREATING A LOT OF CLASSES
                                // explicit field type
                                'website' => Url::make(
                                    label: 'Website',
                                ),
                                */
                                // from methods with attributes
                                'qrcode' => true,
                                'description' => true,
                            ]
                        ),
                    ],
                ),
                Tab::make()
                    ->label('Settings')
                    ->icon(Icon::SETTINGS),
            ],
        )->toArray();
    }
}
