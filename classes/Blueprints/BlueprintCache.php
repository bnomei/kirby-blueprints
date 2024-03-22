<?php

namespace Bnomei\Blueprints;

use Kirby\Data\Json;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;

class BlueprintCache
{
    public static function rememberCacheDir(): void
    {
        $key = self::getKey();
        if (kirby()->session()->get($key)) {
            return;
        }

        $dir = kirby()->cache('bnomei.blueprints')->root();
        if (! Dir::exists($dir)) {
            Dir::make($dir);
        }
        kirby()->session()->set($key, $dir);
    }

    public static function cacheDir(): ?string
    {
        $key = self::getKey();

        return kirby()->session()->get($key);
    }

    protected static function cacheFile(string $key): ?string
    {
        $hash = hash('xxh3', $key);
        $hash = substr($hash, 0, 2).'/'.substr($hash, 2);

        return static::cacheDir() ?
            static::cacheDir().'/'.$hash.'.cache'
            : null;
    }

    public static function exists(string $key, $expire = null): bool
    {
        $file = static::cacheFile($key);
        if (! $file) {
            return false;
        }
        if ($expire === null) {
            $expire = option('bnomei.blueprints.expire'); // in seconds
        }
        if (! $expire || $expire <= 0) {
            return false;
        }
        $m = F::modified($file) + $expire >= time();
        if (F::exists($file) && $m) {
            return true;
        }
        if (F::exists($file) && ! $m) {
            F::remove($file);
        }

        return false;
    }

    public static function get(string $key, $default = null, $expire = null): ?array
    {
        $file = static::cacheFile($key);
        if ($file && static::exists($key, $expire)) {
            return Json::read($file);
        }

        return $default;
    }

    public static function set(string $key, array $data): bool
    {
        $file = static::cacheFile($key);

        return $file ? Json::write($file, $data) : false;
    }

    public static function getKey(): string
    {
        return 'bnomei.blueprints.cache.dir';
    }

    public static function preloadCachedBlueprints(): void
    {
        $kirby = kirby();
        $preload = $kirby->option('bnomei.blueprints.preload');
        if ($preload === false) {
            return;
        }

        $preloaded = [];
        foreach ($preload as $type) {
            $blueprints = $kirby->blueprints($type);
            foreach ($blueprints as $name) {
                $key = $type.'/'.$name;
                $blueprint = static::get($key);
                if ($blueprint === null) {
                    continue;
                }
                $preloaded[$key] = $blueprint;
            }
        }
        $kirby->extend([
            'blueprints' => $preloaded,
        ]);
    }
}
