<?php


namespace Hsy\Options\Traits;


trait OptionsInCache
{
    private function cacheKey($key)
    {
        return "Options--" . $key;
    }

    private function getFromCache($key)
    {
        return cache()->get($this->cacheKey($key));
    }

    private function cacheExists($key)
    {
        return cache()->has($this->cacheKey($key));
    }

    private function updateCache($key, $value)
    {
        cache()->put(
            $this->cacheKey($key),
            $value,
            $this->expireTime()
        );
    }

    private function removeFromCache($key)
    {
        cache()->forget($this->cacheKey($key));
    }

    private function expireTime()
    {
        return now()->addHours(24);
    }
}
