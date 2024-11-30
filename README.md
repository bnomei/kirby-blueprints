# Kirby Blueprints 

![Release](https://flat.badgen.net/packagist/v/bnomei/kirby-blueprints?color=ae81ff&icon=github&label)
[![Discord](https://flat.badgen.net/badge/discord/bnomei?color=7289da&icon=discord&label)](https://discordapp.com/users/bnomei)
[![Buymecoffee](https://flat.badgen.net/badge/icon/donate?icon=buymeacoffee&color=FF813F&label)](https://www.buymeacoffee.com/bnomei)

Kirby Ink - PHP Class-based Blueprints for Kirby CMS for better type safety and code completion.

## Install

Using composer:

```bash
composer require bnomei/kirby-blueprints
```

## What's in the box?

This plugin introduces two new ways to define blueprints for Kirby.

<div>
<div style="width: 50%; float: left; padding-right: 1vw;">

### Fluent & Named Helper Classes
Define blueprints in PHP files with the *fluent definition* or *named parameter definition* instead of just the *array definition* that Kirby provides. You can use the`*::make()`-helpers to create them and avoid typos.

**site/plugins/example/blueprints/fields/description.php**
```php
return Field::make(FieldTypes::TEXTAREA)
    ->label('Description')
    ->toArray();
```
</div>
<div style="width: 50%; float: left; padding-left: 1vw;">

### PHP Attributes for PageModels
Define blueprints for pages in PageModels and use public properties with PHP attributes to define fields. You will gain auto-completion and insights on hover for the fields in your templates.

**site/plugins/example/models/ArticlePage.php**
```php 
#[
    Label([
        'en' => 'Introduction',
        'de' => 'Einleitung',
    ]),
    Type(FieldTypes::TEXT),
]
public Field $introduction;
```
</div>
</div>

## Blueprint definitions from Files

### How to make Kirby aware of a blueprint definition

Kirby can currently only load blueprints from YAML files if they are stored in the `site/blueprints` folder. It can also load them from PHP files but they need to be defined in a custom plugin with something called *extension*. Give my [suggestion an up-vote](https://kirby.nolt.io/572) if you want to see this changed in the future and be able to use PHP blueprints right from the core folders.

The examples in this Readme show how to create various blueprints. What is not show here is how to register them in the `index.php` of your custom plugin via an extension. See the [official docs](https://getkirby.com/docs/reference/plugins/extensions/blueprints) on how to do that or try my [autoloader helper](https://github.com/bnomei/autoloader-for-kirby). 

The following code shows how you would use the *autoloader helper* in your custom plugin. As it's name indicates the helper will automatically scan the folders inside your plugin and register ALL extensions it finds (like blueprints, pageModels, snippets, ... and many more). Meaning that it will also register the blueprints from the `site/plugins/example/blueprints` folder.

**site/plugins/example/index.php**
```php
<?php

// load the fields stored as traits
autoloader(__DIR__)->classes();

// load every possible extension else with the autoloader
Kirby::plugin('your/example', autoloader(__DIR__)->toArray([
    // add your additional extension definitions here. like...
    'options' => [
        'cache' => true,
    ],
]);
```

### Creating blueprints with YAML in a custom plugin (core Kirby feature)

This is the way you are currently using to define a blueprint in Kirby via a plugin extension.

**site/plugins/example/blueprints/fields/description.yml**
```yaml
label: Description
type: textarea
```

### Creating blueprints with PHP in a custom plugin 

In addition to the core *array*-definition his plugin introduces two new ways to define blueprints. The *fluent*- and the *named parameter*-definition. In the end they are both converted to the same *array*-definition that Kirby expects but you can use the `*::make()`-helpers to create them and avoid typos.

#### Programmable Blueprints in Kirby array-definition (core feature)

You can use a PHP file to define a blueprint if you registered it in the `index.php` of your plugin or used the *autoloader helper*.

**site/plugins/example/blueprints/fields/description.php**
```php
<?php

// "array definition" (same as yaml)
return [
    'label' => 'Description',
    'type' => 'textarea',
];
```

#### Fluent Definition

**site/plugins/example/blueprints/fields/description.php**
```php
<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldTypes;

// "fluent definition" from this plugin
return Field::make(FieldTypes::TEXTAREA)
    ->label('Description')
    ->toArray();
```

#### Named Parameter Definition 

**site/plugins/example/blueprints/fields/description.php**
```php
<?php

use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\FieldTypes;

// "named parameter definition" from this plugin
return Field::make(
    type: FieldTypes::TEXTAREA,
    label: 'Description'
)->toArray();
```

#### Dynamic Blueprints without PHP Attributes on Models

If you want to return a dynamic definition for a blueprint you need to wrap the return value of your PHP-based blueprint in a callback. This is because otherwise the blueprint definitions get parsed during Kirby's initial setup and you can NOT access all data in the Kirby instance (`kirby()`) or any other helpers (`site()/page()`) without causing issues. But using the closure will delay the parsing of the blueprint until the blueprint is actually needed after Kirby has loaded all plugins and is ready to render a page.

**site/plugins/example/blueprints/fields/version.php**
```php
<?php

return fn () => Field::make(FieldTypes::INFO)
    ->text('Kirby v'.kirby()->version())
    ->toArray();
```

> NOTE: For Models you can do that with the `defer` option. See further down.

### Available Make-Helpers

Depending on what blueprint you want to create you can use one of the following helpers.

- `Field::make()`
- `Section::make()`
- `Column::make()`
- `Tab::make()`
- `Page::make()`
- `File::make()`
- `User::make()`
- `Site::make()`

### Dynamic Blueprints

Since the blueprint definitions get parsed during Kirby's initial setup you can NOT access all data in the Kirby instance (`kirby()`) or any other helpers (`site()/page()`) without causing issues once in a while. If you need dynamic behaviour in your blueprints consider reading up on the [system.loadPlugins:after hook](https://getkirby.com/docs/reference/plugins/hooks/system-loadplugins-after).

Also take a look at the [official cookbook](https://getkirby.com/docs/cookbook/panel/programmable-blueprints#assigning-filtered-blueprints-to-sections) and the [examples in this plugin](https://github.com/bnomei/kirby-blueprints/tree/main/tests/site/plugins/test/models/DynamoPage.php) related to dynamic blueprints.

## Blueprint definitions from PageModels (new feature from plugin)

In Kirby you can define a class matching the name of your template plus the suffix `Page` to create a [PageModel](https://getkirby.com/docs/reference/plugins/extensions/page-models). In this example we are putting them into the `site/plugins/example/models` folder so that the *autoloader helper* can find them. You could also put them into the `site/models` folder given you adjust the filename a bit.

**site/plugins/example/models/ExamplePage.php**
```php
<?php

use Kirby\Cms\Page;

class ExamplePage extends Page
{
    // nothing here yet
}
```

### Creating field definitions with PHP Attributes in a PageModel

Do not be confused by the many `use` statements you will see in the examples below. Your IDE will most likely add them when you use the PHP attributes to ensure the PHP code knows where to find the definitions for them.

You will need to add two traits to your PageModel. 
- One for making it aware that we want the public properties with attributes registered as blueprint fields and to read the page blueprint definition (`HasBlueprintFromAttributes`) and 
- a second one for making those public properties return the Kirby field object (`HasPublicPropertiesMappedToKirbyFields`).

Without defining a YAML blueprint for the `article` template Kirby would have an empty blueprint definition. But with the attributes defined in the PageModel Kirby will know what fields we want to have in the blueprint (registered by the *autoloader helper*).

**site/plugins/example/models/ArticlePage.php**

```php
<?php

use Bnomei\Blueprints\Attributes\ExtendsField;
use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesMappedToKirbyFields;
use Bnomei\Blueprints\Schema\FieldTypes;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class ArticlePage extends Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;
    
    #[
        Label([
            'en' => 'Introduction',
            'de' => 'Einleitung',
        ]),
        Type(FieldTypes::TEXT),
    ]
    public Field $introduction;
}
```

Just to be extra clear: This would be the same as having the following YAML blueprint definition. Only that we do not need to actually create it because the attributes in the PageModel will be doing that for us.

**site/plugins/example/blueprints/pages/article.yml**
```yaml
fields:
    introduction:
        label:
            en: Introduction
            de: Einleitung
        type: text
```

Most likely you will want a more complex blueprint definition than just fields at root level. To do that you will have to create a method to return the blueprint from the PageModel. The name of the method does not matter but the attribute `Blueprint` does. The method needs to return an array with the blueprint definition. See futher down for an example.

### Available Attributes

You can find all available PHP attributes in the [classes/Blueprints/Attributes folder](https://github.com/bnomei/kirby-blueprints/tree/main/classes/Blueprints/Attributes) of this repository. They reflect the properties you would set for a given field in a YAML blueprint. For some properties I created variants since different fields use the same property name but with different meanings (like `max` in a `number` field vs. `max` in a `date` field) and I wanted to keep them unambiguous in PHP.

`Alpha, Accept, After, Api, Autocomplete, Autofocus, Before, Blueprint, Buttons, Calendar, Columns, ColumnsCount, Converter, Counter, CustomType, DefaultValue, Disabled, Display, EmptyValue, ExtendsField, Fieldsets, Fields, Files, Font, Format, GenericAttribute, Grow, Help, Icon, Image, Info, Inline, Label, Layout, LayoutSettings, Layouts, Link, Marks, Max, MaxDate, MaxRange, MaxTime, MaxLength, Min, MinDate, MinLength, MinRange, MinTime, Mode, Multiple, Nodes, Numbered, Options, Path, Pattern, Placeholder, Prepend, Property, Query, Range, Required, Reset, Search, Separator, Size, SortBy, Sortable, Spellcheck, Step, Store, Subpages, Sync, Text, Theme, Time, TimeNotation, Tooltip, Translate, Type, Uploads, When, Width, Wizard`

### Benefits of using this plugin

You could alternatively use another plugin to [create type-hints](https://github.com/lukaskleinschmidt/kirby-file-types) based on your regular Kirby setup but that would mean you need to update them on every code change. With this plugin you can define your fields in the PageModel and instantly have code-completion in your templates. Hovering the property name will, in most IDEs, show you the attributes you did set for easy reference.

You could reduce the risk of typos and get auto-completion if you use my [Schema for Kirby's YAML Blueprints](https://github.com/bnomei/kirby3-schema). But using the `*::make()`-helpers and the PHP attributes will get you code-completion and type-safety within the blueprints themselves and in the rest of your PHP code (the PageModels, controllers, templates, ...).

**site/templates/article.php**
```php
<?php

// no code completion. your IDE does NOT know
// that `introduction()` method is a Field.

var_dump($page->introduction()->value());


// with this plugin your IDE will know that
// the public property `introduction` is a Field
// and you can use code completion and see the
// set attributes on hovering the property.

var_dump($page->introduction->value()); // <-- property not method!
```

> NOTE: This in not perfect. In an ideal case the IDE would know that you wanted a field of type textarea and only offer you methods that are available for that type of field. But that is something we can not do with Kirby right now. Still it's better than nothing. :-)

### How to re-use blueprint definitions

There are two ways to re-use blueprint definitions. 

- One is to mimic the `extends` keyword from the YAML blueprints but use it as the `ExtendsField` attribute in PHP PageModels. You can extend from both YAML and PHP blueprints.
- The other would be to create a PHP trait with the field definition you want to re-use and apply the trait to multiple classes.

#### Re-use by extending from YAML/PHP-based blueprints
**site/plugins/example/blueprints/fields/special-date.yml**
```yml
label: Special Date
type: date
```

**site/plugins/example/models/MemberPage.php**
```php
<?php

// omitted the use statements for brevity's sake

class MemberPage extends Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;
    
    #[
        Label('Birthday'),
        ExtendsField('fields/special-date'),
    ]
    public Field $birthday;
}
```

#### Using Traits to re-use blueprints

**site/plugins/example/classes/HasDescription.php**
```php
<?php

// omitted the use statements for brevity's sake

trait HasDescriptionField
{
    #[
        Type(FieldTypes::TEXTAREA),
        Label([
            'de' => 'Beschreibung',
            'en' => 'Description',
        ]),
        Buttons([
            Button::BOLD,
            Button::ITALIC,
            Button::SEPARATOR,
            Button::LINK,
        ]),
        MaxLength(3000),
        Spellcheck(true),
    ]
    public Field $description;
}
```

**site/plugins/example/models/BlogpostPage.php**
```php
<?php

// omitted the use statements for brevity's sake

class BlogpostPage extends Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;
    
    use HasDescriptionField; // <-- re-use the trait
}
```

## Blueprint definitions for a page from a PageModel

You will use the `*::make()`-helpers to create a blueprint definition in a PHP blueprint files. If you want your attribute based fields from the PageModel to work you need to directly define a full page blueprint in the same PageModel. Why is it needed? Because the attribute based fields need to be injected in the blueprint definition and that can only work if you define the blueprint in the PageModel itself.

This will also give you the benefit of not having any blueprint files at all.

**site/plugins/example/models/ArticlePage.php**

```php
<?php

// use statements omitted for brevity's sake

class ProductPage extends \Kirby\Cms\Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;
    
    // this is the same trait as the example above
    use HasDescriptionField;

    #[
        CustomType('qrcode'),
        Property('Custom key', 'custom data'),
    ]
    public \Kirby\Content\Field $qrcode;

    #[
        Type(FieldTypes::EMAIL),
        Placeholder('Email Field from Property')
    ]
    public \Kirby\Content\Field $email;

    #[
        Blueprint
    ]
    public static function nameOfThisMethodDoesNotMatterOnlyTheAttribute(): array
    {
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
                                        Ink::MAXLENGTH => 3000,
                                        Ink::SPELLCHECK => false,
                                        Ink::BUTTONS => false,
                                    ],
                                )
                                // OR
                                // ->property(Ink::MAXLENGTH, 3000)
                                // ->property(Ink::SPELLCHECK, false)
                                // ->property(Ink::BUTTONS-, false)
                                // OR
                                // ->maxLength(3000)
                                // ->spellcheck(false)
                                // ->buttons(false)
                                ,
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

```

There is one special behaviour to note here. You can make the blueprint expand the fields defined by attributes in referencing them by name and setting their value to `true`. But this will only work in blueprints defined in PageModels not for those from PHP blueprint files.

```php
Column::make()
    ->width(1 / 3)
    ->fields([
        'price' => [
            'type' => 'number',
            'label' => 'Price',
        ],
        // will be expanded to the field definition from the
        // attributes set on the `public Field $email` property.
        'email' => true, 
    ]),
```

## Why is it called Ink?

Because on top of all these `*::make()`-helpers it also introduces a new `Ink::*`-helpers to create a blueprint definition from a PageModel. And because it's short and easy to remember.

```php
<?php

use ...;

class ElephantPage extends Page
{
    use HasInk;

    #[
        Label('Left Ear'),
        Type(FieldTypes::TEXT),
    ]
    public Field $leftEar;

    #[
        Label('Right Ear'),
        Type(FieldTypes::TAGS),
    ]
    public Field $rightEar;

    #[
        Blueprint
    ]
    public static function elephantsBlueprint(): array
    {
        // DANGER: do not use kirby() or site() or page() here
        // $user = kirby()->user(); // will cause issues with blueprint loading

        return Ink::page(
            title: 'Elephant',
            columns: [
                Ink::column(2 / 3)->fields([
                    'leftEar',
                    Ink::field(Ink::BLOCKS)
                        ->label('Trunk')
                        ->property(Ink::EMPTY, '🐘'),
                    'rightEar',
                ]),
                Ink::column(1 / 3)->sections([
                    Ink::fields()->fields([
                        Ink::field(Ink::TEXT)
                            ->label('User')
                            ->property(Ink::PLACEHOLDER, '{{ user.nameOrEmail }} ({{ user.role.name }})'),
                    ]),
                    Ink::info()
                        ->label('Kirby Version')
                        ->theme(Ink::INFO)
                        ->text('{{ kirby.version }}'),
                    Ink::files()
                        ->label('Files'),
                ]),
            ],
        )->toArray();
    }
}
```

## Caching and Lazy-loading of PHP based blueprints

If caching is enabled it will only compile the blueprint once and then use the cached version. The cache lasts for the duration set.

```php
#[
    // cache for 120 seconds
    Blueprint(cache: 120) 
    
    // cache with default 60 seconds
    Blueprint()
    Blueprint(cache: null) 
    
    // disable
    Blueprint(cache: 0) 
    Blueprint(cache: false) 
]
```

> The default can be set in the config.php of your plugin with the `bnomei.blueprints.expire` option. 


If `defer` is set to `true` it will compile the blueprint after the kirby instance is ready. This means you can use the `kirby()/site()/page()`-helpers in your blueprints or query the content of the site. Most of the time it makes sense to disable caching when using `defer` since the cache might interfere with the dynamic behaviour you are trying to create.

```php
#[
    // load with system.loadPlugins:after hook and no cache
    Blueprint(defer: true, cache: 0) 
]
```

## Caching for PHP and YAML based blueprints

If you are not using the attributes to define your blueprint definitions you can still enable caching using traits model. One to enable the cache and one to define if it should resolve all fields as much as possible. 

Resolving the fields means to write all meta-data in extracting them using a model instance. So if you are using the Kirby query-strings language or other dynamic values in your blueprints (like the Janitor or some SEO plugins do), you might want to skip resolving. But... if you have a very complex blueprint with many fields and you want to speed up the blueprint loading you might want to resolve them. Especially when using lots of Layouts, Columns & Blocks resolving might be a good idea.


**site/models/example.php**

```php
<?php

class ExamplePage extends \Kirby\Cms\Page {

    // can be used safely to speed up all kind of blueprints
    use \Bnomei\Blueprints\HasBlueprintCache;
    
    // not recommended for dynamic blueprints
    use \Bnomei\Blueprints\HasBlueprintCacheResolve; 

}
```

> The cache will use the duration as defined in the `bnomei.blueprints.expire` option in the config.php of your plugin.

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby-blueprints/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
