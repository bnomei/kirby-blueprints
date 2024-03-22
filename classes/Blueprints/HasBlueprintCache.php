<?php

namespace Bnomei\Blueprints;

use Kirby\Cms\FileBlueprint;
use Kirby\Cms\PageBlueprint;
use Kirby\Cms\UserBlueprint;

trait HasBlueprintCache
{
    protected static bool $blueprintCache = false;

    public function blueprintCacheKey(): string
    {
        $blueprint = $this->blueprint();
        $type = match ($blueprint::class) {
            PageBlueprint::class => 'pages',
            FileBlueprint::class => 'files',
            UserBlueprint::class => 'users',
        }.'/';

        return $type.str_replace($type, '', $blueprint->name());
    }

    public function __destruct()
    {
        /** @var \Kirby\Cms\ModelWithContent $this */
        $key = $this->blueprintCacheKey();
        if (static::$blueprintCache) {
            return;
        }
        static::$blueprintCache = true;

        if (BlueprintCache::exists($key) === false) {
            $blueprint = $this->blueprint();
            $data = $blueprint->toArray();
            $copy = $data;
            if (isset(static::$blueprintCacheResolve)) {
                foreach ($copy['tabs'] as $tabKey => $tab) {
                    foreach ($tab['columns'] as $columnKey => $column) {
                        foreach ($column['sections'] as $sectionKey => $section) {
                            $section = $blueprint->section($sectionKey);
                            $path = $data['tabs'][$tabKey]['columns'][$columnKey]['sections'][$sectionKey];
                            if (array_key_exists('fields', $path)) {
                                $path['fields'] = $section->toArray()['fields'];
                            }
                        }
                    }
                }
            }
            BlueprintCache::set($key, $data);
        }
    }
}
