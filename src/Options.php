<?php
/**
 * Created by PhpStorm.
 * User: Hsy
 * Date: 26/Nov/2019
 * Time: 08:03 AM
 */

namespace Hsy\Options;

use Hsy\Options\Exceptions\OptionNotFoundInDatabase;
use Hsy\Options\Traits\OptionsInCache;
use Hsy\Options\Traits\OptionsInDatabase;

class Options
{
    use OptionsInCache;
    use OptionsInDatabase;

    public function get($key, $default = null)
    {
        if ($this->cacheExists($key))
            return $this->getFromCache($key);

        $option = $this->getFromDatabase($key);

        return $option ? $option->value : $default;
    }

    public function set($key, $value)
    {
        $this->updateOrInsertInDatabase($key, $value);
        $this->updateCache($key, $value);
    }

    public function update($key, $value)
    {
        if (!$this->existsInDatabase($key))
            throw new OptionNotFoundInDatabase;

        $this->updateDatabase($key, $value);
        $this->updateCache($key, $value);
    }

    public function remove($key)
    {
        if ($this->existsInDatabase($key))
            $this->removeFromDatabase($key);

        $this->removeFromCache($key);

    }

    public function exists($key)
    {
        return $this->existsInDatabase($key);
    }

    public function group($key)
    {
        return new GroupedOptions($key);
    }

}

