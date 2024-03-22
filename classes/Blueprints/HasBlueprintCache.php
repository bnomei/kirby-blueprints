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
        };

        return $type.'/'.$blueprint->name();
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
            if (isset(static::$blueprintCacheResolve)) {
                foreach ($blueprint->toArray()['tabs'] as $tabKey => $tab) {
                    foreach ($tab['columns'] as $columnKey => $column) {
                        foreach ($column['sections'] as $sectionKey => $section) {
                            $section = $blueprint->section($sectionKey);
                            $data['tabs'][$tabKey]['columns'][$columnKey]['sections'][$sectionKey]['fields'] = $section->toArray()['fields'];
                        }
                    }
                }
            }
            BlueprintCache::set($key, $data);
        }
    }
}
