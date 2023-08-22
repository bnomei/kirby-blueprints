<?php

namespace Bnomei\Blueprints;

use Kirby\Data\Json;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;

class BlueprintCache
{
    public static function cacheDir(bool $remember = false): ?string
    {
        $key = 'bnomei.blueprints.cache.dir';
        if ($dir = kirby()->session()->get($key)) {
            return $dir;
        }
        if ($remember) {
            $dir = kirby()->cache('bnomei.blueprints')->root();
            if (! Dir::exists($dir)) {
                Dir::make($dir);
            }
            kirby()->session()->set($key, $dir);

            return $dir;
        }

        return null;
    }

    private static function cacheFile(string $key): string
    {
        return static::cacheDir().'/'.hash('xxh3', $key).'.cache';
    }

    public static function get(string $key, $default = null): ?array
    {
        $file = static::cacheFile($key);
        $expire = 5; // seconds
        if ($opcacheConfig = opcache_get_configuration()) {
            $expire = $opcacheConfig['directives']['opcache.enable'] ?
                $opcacheConfig['directives']['opcache.revalidate_freq'] : $expire;
        }
        $m = F::modified($file) + $expire <= time();
        if (F::exists($file) && $m) {
            return Json::read($file);
        }
        if (F::exists($file) && ! $m) {
            F::remove($file);
        }

        return $default;
    }

    public static function set(string $key, array $data)
    {
        $file = static::cacheFile($key);

        return Json::write($file, $data);
    }
}
