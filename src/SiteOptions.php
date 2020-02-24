<?php
/**
 * Created by PhpStorm.
 * User: Hsy
 * Date: 26/Nov/2019
 * Time: 08:03 AM
 */

namespace Hsy\Options;

use Hsy\Options\Models\Option;

class SiteOptions
{
    static $siteOptions = null;

    public function __construct()
    {
        $this->getAllSiteOptions();
    }

    public function getAllSiteOptions()
    {

        $model=config('options.optionsModel');

        if (self::$siteOptions)
            return self::$siteOptions;

        $options = self::getConfigSiteOptionsFlat();

        $storedOptions = $model::whereIn('key', array_keys($options))
            ->get(['key as name', 'value'])
            ->keyBy('name');

        foreach ($options as $option) {
            $options[$option['key']]['value'] = isset($storedOptions[$option['key']])
                ? $storedOptions[$option['key']]['value']
                : null;
        }
        return self::$siteOptions = $options;
    }

    private static function getConfigSiteOptionsFlat()
    {
        $siteOptions = config('options.siteOptions');
        $options = [];
        foreach ($siteOptions as $optionsGroup) {
            foreach ($optionsGroup['fields'] as $option) {
                $options[$option['key']] = $option;
            }
        }

        return $options;
    }

    public function getSiteOption($key, $default = "")
    {
        return isset(self::$siteOptions[$key]) ? self::$siteOptions[$key]['value'] : $default;

    }
}

