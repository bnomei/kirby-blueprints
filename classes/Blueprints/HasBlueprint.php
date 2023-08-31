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
}
