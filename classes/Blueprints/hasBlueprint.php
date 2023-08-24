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
}
