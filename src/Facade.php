<?php
namespace Hsy\Options;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return "Options";
    }
}
