<?php

namespace Bnomei\Blueprints;

use Kirby\Cache\FileCache;
use Kirby\Data\Json;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;

class BlueprintCache
{
    public static function rememberCacheDir(): void
    {
        $key = self::getKey();
        if (kirby()->session()->get($key)) { // @phpstan-ignore-line
            return;
        }

        /** @var FileCache $cache */
        $cache = kirby()->cache('bnomei.blueprints');
        $dir = $cache->root();
        if (! Dir::exists($dir)) {
            Dir::make($dir);
        }
        kirby()->session()->set($key, $dir); // @phpstan-ignore-line
    }

    public static function cacheDir(): ?string
    {
        $key = self::getKey();

        return kirby()->session()->get($key); // @phpstan-ignore-line
    }

    public static function cacheFile(string $key): ?string
    {
        return static::cacheDir() ?
            static::cacheDir().'/'.$key.'.cache'
            : null;
    }

    public static function exists(string $key, ?int $expire = null): bool
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
        $modified = F::modified($file);
        if (! is_int($modified)) {
            return false;
        }
        $m = $modified + $expire >= time();
        if (F::exists($file) && $m) {
            return true;
        }
        if (F::exists($file) && ! $m) {
            F::remove($file);
        }

        return false;
    }

    public static function get(string $key, mixed $default = null, ?int $expire = null): mixed
    {
        /*
        if ($loaded = \Kirby\Toolkit\A::get(\Kirby\Cms\Blueprint::$loaded, $key)) {
            return $loaded;
        }
        */

        $file = static::cacheFile($key);

        if ($file && static::exists($key, $expire)) {
            $data = Json::read($file);
            //\Kirby\Cms\Blueprint::$loaded[$key] = $data;

            return $data;
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

    public static function preloadCachedBlueprints(): int
    {
        $cdir = static::cacheDir();
        if (! $cdir) {
            return 0;
        }
        $blueprints = [];
        foreach (Dir::dirs($cdir, [], true) as $dir) {
            foreach (Dir::files($dir, [], true) as $file) {
                if (! \Kirby\Toolkit\Str::endsWith($file, '.cache')) {
                    continue;
                }
                $key = str_replace([static::cacheDir().'/', '.cache'], ['', ''], $file);
                if (! is_string($key)) {
                    continue;
                }
                /* this check would decrease performance
                if (\Kirby\Toolkit\A::get(\Kirby\Cms\Blueprint::$loaded, $key)) {
                    continue;
                }*/
                $blueprint = Json::read($file);
                //\Kirby\Cms\Blueprint::$loaded[$key] = $blueprint;
                $blueprints[$key] = $blueprint;
            }
        }
        /* Does not work as intended, merge directly instead
        kirby()->extend(
            ['blueprints' => $blueprints],
        );
        */
        \Kirby\Cms\Blueprint::$loaded = array_merge(\Kirby\Cms\Blueprint::$loaded, $blueprints);

        return count(\Kirby\Cms\Blueprint::$loaded);
    }

    public static function flush(): void
    {
        $cdir = static::cacheDir();
        if (! $cdir) {
            return;
        }
        if (Dir::exists($cdir)) {
            Dir::remove($cdir);
        }
        Dir::make($cdir);
    }
}
