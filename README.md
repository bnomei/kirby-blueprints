# Kirby Blueprints 

![Release](https://flat.badgen.net/packagist/v/bnomei/kirby-blueprints?color=ae81ff)
![Downloads](https://flat.badgen.net/packagist/dt/bnomei/kirby-blueprints?color=272822)
[![Build Status](https://flat.badgen.net/travis/bnomei/kirby-blueprints)](https://travis-ci.com/bnomei/kirby-blueprints)
[![Coverage Status](https://flat.badgen.net/coveralls/c/github/bnomei/kirby-blueprints)](https://coveralls.io/github/bnomei/kirby-blueprints)
[![Maintainability](https://flat.badgen.net/codeclimate/maintainability/bnomei/kirby-blueprints)](https://codeclimate.com/github/bnomei/kirby-blueprints)
[![Twitter](https://flat.badgen.net/badge/twitter/bnomei?color=66d9ef)](https://twitter.com/bnomei)

PHP Class-based Blueprints for Kirby CMS for better type safety and code completion.

## Install

Using composer:

```bash
composer require bnomei/kirby-blueprints
```

## Commercial Usage

> <br>
> <b>Support open source!</b><br><br>
> This plugin is free but if you use it in a commercial project please consider to sponsor me or make a donation.<br>
> If my work helped you to make some cash it seems fair to me that I might get a little reward as well, right?<br><br>
> Be kind. Share a little. Thanks.<br><br>
> &dash; Bruno<br>
> &nbsp;

| M | O | N | E | Y |
|---|----|---|---|---|
| [Github sponsor](https://github.com/sponsors/bnomei) | [Patreon](https://patreon.com/bnomei) | [Buy Me a Coffee](https://buymeacoff.ee/bnomei) | [Paypal dontation](https://www.paypal.me/bnomei/15) | [Hire me](mailto:b@bnomei.com?subject=Kirby) |

## Blueprint definitions from Files

### How to make Kirby aware of a blueprint definition

Kirby can currently only load blueprints from YAML files if they are stored in the `site/blueprints` folder. To use PHP you will need to load them in a custom plugin with something called *extension*. Give my [suggestion an up-vote](https://kirby.nolt.io/572) if you want to see this changed in the future and be able to use PHP blueprints without a custom plugin.

The following examples show how to create various blueprints. What is not show here is how to register them in the `index.php` of your custom plugin via an extension. See the [official docs](https://getkirby.com/docs/reference/plugins/extensions/blueprints) on how to do that or try my [autoloader helper](https://github.com/bnomei/autoloader-for-kirby). 

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

### Creating blueprints with YAML in a custom plugin

This is the way you are currently using to define a blueprint in Kirby via a plugin extension.

**site/plugins/example/blueprints/fields/description.yml**
```yaml
label: Description
type: textarea
```

### Creating blueprints with PHP in a custom plugin

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

In addition to the *array*-definition his plugin introduces two new ways to define blueprints. The *fluent*- and the *named parameter*-definition.

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

### Available Make Helpers

Depending on what blueprint you want to create you can use one of the following helpers.

- `Field::make()`
- `Section::make()`
- `Column::make()`
- `Tab::make()`
- `Page::make()`
- `File::make()` (coming soon)
- `Site::make()` (coming soon)

### Dynamic Blueprints

Since the blueprint definitions get parsed during Kirby's initial setup you can NOT access the kirby instance or any other helpers without causing issues. If you need dynamic behaviour in your blueprints consider reading up on the [system.loadPlugins:after hook](https://getkirby.com/docs/reference/plugins/hooks/system-loadplugins-after).

## Blueprint definitions from PageModels

In Kirby you can define a class matching the name of your template plus the suffix `Page` to create a [PageModel](https://getkirby.com/docs/reference/plugins/extensions/page-models). In this example we are putting them into the `site/plugins/example/models` folder so that the *autoloader helper* can find them. You could also put them into the `site/models` folder given you adjust the filename a bit. But having said that I would still recommend to use a plugin extension to register them.

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

Do not be confused by the `use` statements. Your IDE will most likely add them when you use the attributes to ensure the PHP code knows where to find the definitions for them.

You will need to add two traits to your PageModel. One for making it aware that we want the public properties with attributes registered as blueprint fields (`HasBlueprintFromAttributes`) and one for making those properties return the Kirby Field object (`HasPublicPropertiesMappedToKirbyFields`).

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
introduction:
    label:
        en: Introduction
        de: Einleitung
    type: text
```

### Benefits of using Fields defined in a PageModel using PHP Attributes

You could avoid typos and get auto-completion if you use my [Schema for Kirbys YAML Blueprints](https://github.com/bnomei/kirby3-schema) but the main reason for using PHP attributes is that you will get code completion and type safety within your PHP code (the PageModel, Controllers, Templates, ...). 

You could alternatively use another plugin to [create type-hints](https://github.com/lukaskleinschmidt/kirby-file-types) based on your regular Kirby setup but that would mean you need to update them on every code change.

With this plugin you can define your fields in the PageModel and instantly use them in your templates with code completion and additional insights into the field definition. Hovering the property name will, in most IDEs, show you the attributes you did set.

**site/templates/article.php**
```php
<?php

// no code completion. your IDE does NOT know
// that `introduction()` method is a Field.
var_dump($page->introduction()->value());

// but with this plugin your IDE will know
// that the public property `introduction` is a Field
// and you can use code completion.
var_dump($page->introduction->value());
```

> NOTE: This in not perfect. In an ideal case the IDE would know that you wanted a Textarea-Field and only offer you methods that are available for that type of field. But that is something we can not do with Kirby right now. Still it's better than nothing. :-)

### How to re-use blueprint definitions

There are two ways to re-use blueprint definitions. 

- One is to mimic the `extends` keyword from the YAML blueprints but use it as the `ExtendsField` attribute in PHP PageModels. You can extend from both YAML and PHP blueprints.
- The other would be to create a PHP trait with the field defintion you want to re-use and apply the Trait to multiple classes.

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
    
    use HasDescriptionField;
}
```

## Blueprint definitions for Pages from a PageModel

> WIP

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/bnomei/kirby-blueprints/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
