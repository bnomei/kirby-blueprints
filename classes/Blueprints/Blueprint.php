<?php

namespace Bnomei\Blueprints;

use Kirby\Content\Field;
use Kirby\Data\Yaml;
use Kirby\Filesystem\F;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionMethod;
use ReflectionUnionType;

class Blueprint
{
    protected static array $loadPluginsAfter = [];

    public function __construct(private readonly string $modelClass, private ?bool $defer = null, private ?int $cache = null)
    {
        $isCacheable = null;
        $rc = new ReflectionClass($modelClass);
        foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes() as $attribute) {
                if ($attribute->getName() === 'Bnomei\Blueprints\Attributes\Blueprint') {
                    $isCacheable = $attribute->newInstance()->cache;
                    $this->defer = $attribute->newInstance()->defer;
                    break;
                }
            }
            if ($isCacheable) {
                break;
            }
        }
        $this->cache ??= $isCacheable;
    }

    public function __toString(): string
    {
        return Yaml::encode($this->toArray());
    }

    public function blueprintCacheKeyFromModel(): string
    {
        $ref = new ReflectionClass($this->modelClass);

        if ($ref->isSubclassOf(\Kirby\Cms\Page::class)) {
            return 'pages/'.strtolower(substr($this->modelClass, 0, -4));
        } elseif ($ref->isSubclassOf(\Kirby\Cms\File::class)) {
            return 'files/'.strtolower(substr($this->modelClass, 0, -4));
        } elseif ($ref->isSubclassOf(\Kirby\Cms\User::class)) {
            return 'users/'.strtolower(substr($this->modelClass, 0, -4));
        }

        return $this->modelClass;
    }

    public function toArray(): array
    {
        $key = $this->blueprintCacheKeyFromModel();
        $blueprint = BlueprintCache::get($key, null, $this->cache);
        if ($blueprint) {
            return [$key => $blueprint];
        }

        $blueprint = self::getBlueprintUsingReflection($this->modelClass);
        // get first value of array, the key of array matched the $key
        $blueprint = reset($blueprint);

        // some might not be cacheable like when they are class based and have dynamic fields
        // only set here now if they will not be written on __destruct by trait
        if ($this->cache && ! method_exists($this->modelClass, 'blueprintCacheKey')) {
            BlueprintCache::set($key, $blueprint);
        }

        return [$key => $blueprint];
    }

    public static function getBlueprintFieldsFromReflection(string $class): array
    {
        $fields = [];
        $rc = new ReflectionClass($class);

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

            // sort field properties
            ksort($fields[$key]);
        }

        // empty() would catch 0 and false which is not what we want
        return Blueprint::arrayRemoveByValuesRecursive($fields, [null, '', []]);
    }

    public static function getBlueprintFromYamlFile(string $class): array
    {
        $rc = new ReflectionClass($class);
        $yamlFile = str_replace('.php', '.yml', $rc->getFileName());
        if (F::exists($yamlFile)) {
            return Yaml::read($yamlFile);
        }

        return [];
    }

    public static function getBlueprintFromClass(string $class): array
    {
        $blueprint = [];

        // find method(s) with blueprint attribute using reflection
        $rc = new ReflectionClass($class);
        foreach ($rc->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            foreach ($method->getAttributes() as $attribute) {
                if ($attribute->getName() === 'Bnomei\Blueprints\Attributes\Blueprint') {
                    // merge from methods that return blueprint array
                    $blueprint = array_merge_recursive(
                        $blueprint,
                        $class::{$method->getShortName()}()
                    );
                }
            }
        }

        return $blueprint;
    }

    public static function getBlueprintUsingReflection(string $class): array
    {
        $fields = self::getBlueprintFieldsFromReflection($class);

        // merge with blueprint from yaml file or class
        $blueprint = array_merge_recursive(
            self::getBlueprintFromYamlFile($class),
            self::getBlueprintFromClass($class),
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

        $rc = new ReflectionClass($class);
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
        return Blueprint::arrayRemoveByValuesRecursive($b, [null, '', []]);
    }

    // https://stackoverflow.com/a/45534505
    public static function arrayRemoveByValuesRecursive(array $haystack, array $values)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = Blueprint::arrayRemoveByValuesRecursive($haystack[$key], $values);
            }

            if (in_array($haystack[$key], $values, true)) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }

    public static function arraySetKeysFromColumns(array $data): array
    {
        foreach ($data as $key => $value) {
            if (in_array($key, ['fields', 'sections', 'columns', 'tabs']) && is_array($value) && count($value)) {
                $updated = [];
                // if item has column id or label than use that as a key
                foreach ($value as $id => $item) {
                    if (is_numeric($id) === false) {
                        $updated[$id] = $item; // keep

                        continue; // do not overwrite those set manually in arrays
                    }
                    if (is_string($item)) {
                        $updated[$item] = true; // resolve attribute based definition
                    } elseif (is_array($item) && isset($item['id'])) {
                        $updated[Str::camel($item['id'])] = $item;
                    } elseif (is_array($item) && isset($item['label'])) {
                        $updated[Str::camel($item['label'])] = $item;
                    } else {
                        $hash = md5(json_encode($item)); // needs to stay the same for kirby between requests
                        $updated[$hash] = $item;
                    }
                }

                $value = $updated;
            }

            if (is_array($value)) {
                $data[$key] = static::arraySetKeysFromColumns($value);
            }
        }

        return $data;
    }

    public static function addBlueprintToLoadAfter(Blueprint $blueprint): void
    {
        if (! isset(static::$loadPluginsAfter)) {
            static::$loadPluginsAfter = [];
        }
        static::$loadPluginsAfter[] = $blueprint;
    }

    public static function loadPluginsAfter()
    {
        $blueprints = [];
        foreach (static::$loadPluginsAfter as $blueprint) {
            $blueprints = array_merge($blueprints, $blueprint->toArray());
        }
        kirby()->extend([
            'blueprints' => $blueprints,
        ]);
    }

    public function isLoadAfter(): bool
    {
        return $this->defer === true;
    }
}
