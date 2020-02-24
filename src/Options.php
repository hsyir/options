<?php
/**
 * Created by PhpStorm.
 * User: Hsy
 * Date: 26/Nov/2019
 * Time: 08:03 AM
 */

namespace Hsy\Options;

use Hsy\Options\Exceptions\CacheKeyNotFound;
use Hsy\Options\Models\Option;

class Options
{
    const CACHE_PREFIX = "options_";

    /**
     * @var  $SiteOptions SiteOptions
     */
    public $siteOptions;

    public function __construct()
    {
        $this->siteOptions = new SiteOptions();
    }

    public function exists($key)
    {
        $model=config('options.optionsModel');
        return $model::find($key) ? true : false;
    }

    public function set($key, $value)
    {
        $model=config('options.optionsModel');
        $this->flush($key);

        if ($option = $model::find($key)) {
            $option->value = $value;
            $option->save();
        } else {
            $model::create(['key' => $key, 'value' => $value]);
        }
        $this->remember($key, $value, 60 * 60 * 24 * 30);
    }

    public function get($key, $default = "", $insert_default = true, $cache_time = 60 * 60 * 24 * 30)
    {
        $model=config('options.optionsModel');
        try {
            return $this->getFromCache($key);
        } catch (CacheKeyNotFound $exception) {
        }

        if ($option = $model::find($key)) {
            $this->remember($key, $option->value, $cache_time);
            return $option->value;
        }

        if ($insert_default) {
            $model::create(['key' => $key, 'value' => $default]);
        }

        return $default;
    }

    public function flush($key)
    {
        cache()->forget(self::CACHE_PREFIX . $key);
        return $this;
    }

    private function remember($key, $value, $time)
    {
        cache()->put(self::CACHE_PREFIX . $key, $value, $time);
    }

    private function getFromCache($key)
    {
        if (cache()->has(self::CACHE_PREFIX . $key))
            return cache()->get(self::CACHE_PREFIX . $key);

        throw new CacheKeyNotFound;
    }




    public function getAllSiteOptions()
    {
        return $this->siteOptions->getAllSiteOptions();
    }

    public function getSiteOption($key, $default = "")
    {
        return $this->siteOptions->getSiteOption($key, $default);
    }
}

