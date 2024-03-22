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
        return static::cacheDir() ?
            static::cacheDir().'/'.$key.'.cache'
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
        /*
        if ($loaded = \Kirby\Toolkit\A::get(\Kirby\Cms\Blueprint::$loaded, $key)) {
            return $loaded;
        }
        */

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

    /*
    public static function preloadCachedBlueprints(): void
    {
        foreach (Dir::dirs(static::cacheDir(), [], true) as $dir) {
            foreach (Dir::files($dir, [], true) as $file) {
                if (! \Kirby\Toolkit\Str::endsWith($file, '.cache')) {
                    continue;
                }
                $key = str_replace([static::cacheDir().'/', '.cache'], ['', ''], $file);
                $blueprint = Json::read($file);
                \Kirby\Cms\Blueprint::$loaded[$key] = $blueprint;
            }
        }
        // ray('preloaded', \Kirby\Cms\Blueprint::$loaded);

        return count(\Kirby\Cms\Blueprint::$loaded);
    }
    */
}
