<?php
/**
 * Created by PhpStorm.
 * User: Hsy
 * Date: 21/Dec/2019
 * Time: 05:16 PM
 */

namespace Hsy\Options\Controllers;

use App\Http\Controllers\Controller;
use Hsy\Categories\Models\Category;
use Hsy\Options\Models\Option;
use Illuminate\Http\Request;

class SiteOptionsController extends Controller
{
    public function index()
    {
        $siteOptions = config('options.siteOptions');
        $options = \Options::getAllSiteOptions();
        return view('siteOptions::index', compact('siteOptions', 'options'));
    }


    public function store(Request $request)
    {
        $options = $this->flatSiteOptions();

        foreach ($options as $key => $option) {
            if ($request->has($key))
                $this->storeOption($key, $request->$key);
        }

        return self::redirectBackWithSuccess("ثبت شد");

    }

    private function flatSiteOptions()
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

    private function storeOption($key, $value)
    {
        $model=config('options.optionsModel');
        $model::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}