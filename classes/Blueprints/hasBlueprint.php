<?php

namespace Bnomei\Blueprints;

use Kirby\Content\Field;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionMethod;
use ReflectionUnionType;

trait hasBlueprint
{
    public static function registerBlueprintExtension()
    {
        $blueprint = BlueprintCache::get(static::class);
        if ($blueprint) {
            return $blueprint;
        }

        $fields = [];
        $rc = new ReflectionClass(self::class);
        foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // only Fields
            $returnType = $method->getReturnType();
            if ($returnType instanceof ReflectionUnionType === true ||
                $returnType?->getName() !== Field::class
            ) {
                continue;
            }

            // only with Attributes
            $fields[$method->getName()] = [];
            foreach ($method->getAttributes() as $attribute) {
                if (! Str::startsWith($attribute->getName(), 'Bnomei\Blueprints\Attributes')) {
                    continue;
                }
                $instance = $attribute->newInstance();
                $fields[$method->getName()] = array_merge(
                    $fields[$method->getName()],
                    json_decode(json_encode($instance), true)
                );
            }

            // sort field properties and remove empty ones
            ksort($fields[$method->getName()]);
            if (empty($fields[$method->getName()])) {
                unset($fields[$method->getName()]);
            }
        }

        $blueprint = [
            'fields' => $fields, // TODO: recursive! merge them with the class based blueprint
        ];

        $pagesSlashModel = 'pages/'.strtolower(str_replace('Page', '', $rc->getShortName()));
        $pm = [$pagesSlashModel => $blueprint];

        // some might not be cacheable like when they have dynamic fields
        if (! isset(self::$cacheBlueprint) || self::$cacheBlueprint === true) {
            BlueprintCache::set(static::class, $pm);
        }

        return $pm;
    }

    public static function registerPageModelExtension()
    {
        $rc = new ReflectionClass(self::class);

        return [
            strtolower(str_replace('Page', '', $rc->getShortName())) => static::class,
        ];
    }

    public static function registerUserModelExtension()
    {
        $rc = new ReflectionClass(self::class);

        return [
            strtolower(str_replace('User', '', $rc->getShortName())) => static::class,
        ];
    }
}
