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

    private static function cacheFile(string $key): ?string
    {
        return static::cacheDir() ?
            static::cacheDir().'/'.hash('xxh3', $key).'.cache'
            : null;
    }

    public static function get(string $key, $default = null): ?array
    {
        $file = static::cacheFile($key);
        if (! $file) {
            return $default;
        }
        $expire = 5; // seconds
        if ($opcacheConfig = opcache_get_configuration()) {
            $expire = $opcacheConfig['directives']['opcache.enable'] ?
                $opcacheConfig['directives']['opcache.revalidate_freq'] : $expire;
        }
        $m = F::modified($file) + $expire >= time();
        if (F::exists($file) && $m) {
            return Json::read($file);
        }
        if (F::exists($file) && ! $m) {
            F::remove($file);
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
}
