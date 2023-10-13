<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\Attributes\CustomType;
use Bnomei\Blueprints\Attributes\Placeholder;
use Bnomei\Blueprints\Attributes\Property;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesMappedToKirbyFields;
use Bnomei\Blueprints\Schema\Column;
use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldProperties;
use Bnomei\Blueprints\Schema\Fields\Url;
use Bnomei\Blueprints\Schema\FieldTypes;
use Bnomei\Blueprints\Schema\Icon;
use Bnomei\Blueprints\Schema\Page;
use Bnomei\Blueprints\Schema\PageImage;
use Bnomei\Blueprints\Schema\PageNavigation;
use Bnomei\Blueprints\Schema\PageOptions;
use Bnomei\Blueprints\Schema\PageStatus;
use Bnomei\Blueprints\Schema\Tab;

class ProductPage extends \Kirby\Cms\Page
{
    use HasBlueprintFromAttributes;
    use HasDescriptionField;
    use HasPublicPropertiesMappedToKirbyFields;

    #[
        CustomType('qrcode'),
        Property('Custom key', 'custom data'),
    ]
    public Kirby\Content\Field $qrcode;

    #[
        Type(FieldTypes::EMAIL),
        Placeholder('Email Field from Property')
    ]
    public Kirby\Content\Field $email;

    #[
        Blueprint
    ]
    public static function nameOfThisMethodDoesNotMatterOnlyTheAttribute(): array
    {
        // IMPORTANT: do NOT use kirby() or site() or page() or option() here since
        // this method is called before the kirby instance is available.
        // if you need such behaviour register the blueprint in the plugins:after hook.

        return Page::make(
            title: 'Product',
            status: PageStatus::make(
                draft: 'Beer',
                unlisted: 'Wine',
                listed: 'Whiskey',
            ),
            icon: Icon::PIN,
            image: PageImage::make(
                back: 'black',
                icon: '📝',
                query: 'page.cover.toFile()'
            ),
            options: PageOptions::make()
                ->preview('{{ page.url }}#product'),
            navigation: PageNavigation::make()
                ->sortBy('date desc'),
            tabs: [
                Tab::make(
                    label: 'Shop',
                    icon: Icon::CART,
                    columns: [
                        Column::make()
                            ->width(1 / 3)
                            ->fields([
                                'price' => [
                                    'type' => 'number',
                                    'label' => 'Price',
                                ],
                                'email' => true, // from PHP
                            ]),
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
                Tab::make(label: 'Badger')
                    ->icon(Icon::BADGE),
            ],
        )->toArray();
    }
}
