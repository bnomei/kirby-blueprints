<?php

namespace Bnomei\Blueprints;

use Kirby\Content\Field;
use Kirby\Data\Yaml;
use Kirby\Filesystem\F;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionMethod;
use ReflectionUnionType;

trait HasBlueprint
{
    // https://stackoverflow.com/a/45534505
    public static function arrayRemoveByValuesRecursive(array $haystack, array $values)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = static::arrayRemoveByValuesRecursive($haystack[$key], $values);
            }

            if (in_array($haystack[$key], $values, true)) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }

    public static function registerBlueprintExtension()
    {
        $blueprint = BlueprintCache::get(static::class);
        if ($blueprint) {
            return $blueprint;
        }

        $fields = self::getBlueprintFieldsFromReflection();

        // merge with blueprint from yaml file or class
        $blueprint = array_merge_recursive(
            self::getBlueprintFromYamlFile(),
            self::getBlueprintFromClass(),
        );
        if (! empty($blueprint)) {
            // find fields and map them from the attributes that match `{key}: true`
            array_walk_recursive($blueprint, function (&$value, $key) use ($fields) {
                if (in_array($key, array_keys($fields)) && $value === true) {
                    $value = $fields[$key]; // this will overwrite since value is used by reference!
                }
            });
        } else {
            // define most basic blueprint
            $blueprint = [
                'fields' => $fields,
            ];
        }

        $rc = new ReflectionClass(self::class);
        $typeSlashModel = $rc->getShortName();
        if (Str::endsWith($rc->getShortName(), 'Page')) {
            $typeSlashModel = 'pages/'.strtolower(str_replace('Page', '', $rc->getShortName()));
        } elseif (Str::endsWith($rc->getShortName(), 'User')) {
            $typeSlashModel = 'users/'.strtolower(str_replace('User', '', $rc->getShortName()));
        }
        $b = [
            $typeSlashModel => $blueprint,
        ];

        // empty() would catch 0 and false which is not what we want
        $b = static::arrayRemoveByValuesRecursive($b, [null, '', []]);

        // some might not be cacheable like when they are class based and have dynamic fields
        if (! isset(self::$cacheBlueprint) || self::$cacheBlueprint === true) {
            BlueprintCache::set(static::class, $b);
        }

        return $b;
    }

    public static function getBlueprintFieldsFromReflection(): array
    {
        $fields = [];
        $rc = new ReflectionClass(self::class);

        // METHODS
        foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $key = $method->getName();
            // only Fields
            $returnType = $method->getReturnType();
            if ($returnType instanceof ReflectionUnionType === true ||
                $returnType?->getName() !== Field::class
            ) {
                continue;
            }

            // only with Attributes
            $fields[$key] = [];
            foreach ($method->getAttributes() as $attribute) {
                if (! Str::startsWith($attribute->getName(), 'Bnomei\Blueprints\Attributes')) {
                    continue;
                }
                $instance = $attribute->newInstance();
                $fields[$key] = array_merge(
                    $fields[$key],
                    $instance->toArray()
                );
            }

            // sort field properties and discard empty ones
            ksort($fields[$key]);
            if (empty($fields[$key])) {
                unset($fields[$key]);
            }
        }

        // PROPERTIES
        // find properties with blueprint attribute using reflection
        foreach ($rc->getProperties(ReflectionMethod::IS_PUBLIC) as $property) {
            $key = $property->getName();

            // only Fields
            $returnType = $property->getType();
            if ($returnType instanceof ReflectionUnionType === true ||
                $returnType?->getName() !== Field::class
            ) {
                continue;
            }

            // only with Attributes
            $fields[$key] = [];
            foreach ($property->getAttributes() as $attribute) {
                if (! Str::startsWith($attribute->getName(), 'Bnomei\Blueprints\Attributes')) {
                    continue;
                }
                $instance = $attribute->newInstance();
                $fields[$key] = array_merge(
                    $fields[$key],
                    $instance->toArray()
                );
            }

            // sort field properties and discard empty ones
            ksort($fields[$key]);
            if (empty($fields[$key])) {
                unset($fields[$key]);
            }
        }

        return $fields;
    }

    public static function getBlueprintFromYamlFile(): array
    {
        $rc = new ReflectionClass(self::class);
        $yamlFile = str_replace('.php', '.yml', $rc->getFileName());
        if (F::exists($yamlFile)) {
            return Yaml::read($yamlFile);
        }

        return [];
    }

    public static function getBlueprintFromClass(): array
    {
        $blueprint = [];

        // find method(s) with blueprint attribute using reflection
        $rc = new ReflectionClass(self::class);
        foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes() as $attribute) {
                if ($attribute->getName() === 'Bnomei\Blueprints\Attributes\Blueprint') {
                    // merge from methods that return blueprint array
                    $blueprint = array_merge_recursive(
                        $blueprint,
                        self::{$method->getShortName()}()
                    );
                }
            }
        }

        return $blueprint;
    }

    public function __construct(array $props)
    {
        parent::__construct($props);

        if (option('bnomei.blueprints.fieldsFromProperties')) {
            // register all blueprint props to their fields
            $rc = new ReflectionClass(self::class);
            foreach ($rc->getProperties(\ReflectionProperty::IS_PUBLIC) as $rp) {
                foreach ($rp->getAttributes() as $attribute) {
                    if (Str::startsWith($attribute->getName(), 'Bnomei\Blueprints\Attributes')) {
                        $name = $rp->getName();
                        $this->{$name} = $this->{$name}(); // set the field
                        break; // registered
                    }
                }
            }
        }
    }
}
