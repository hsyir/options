<?php


namespace Hsy\Options\Traits;


use Hsy\Options\Exceptions\OptionNotFoundInDatabase;
use Hsy\Options\Models\Option;

trait OptionsInDatabase
{

    private function getFromDatabase($key)
    {
        return Option::find($key);
    }

    private function existsInDatabase($key)
    {
        return Option::find($key) ? true : false;
    }

    private function updateOrInsertInDatabase($key, $value)
    {
        Option::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    private function updateDatabase($key, $value)
    {
        $option = Option::find($key);
        if (!$option)
            throw new OptionNotFoundInDatabase;

        $option->value = $value;
        $option->save();
    }

    private function removeFromDatabase($key)
    {
        $option = Option::find($key);
        if ($option)
            $option->delete();
    }
}
