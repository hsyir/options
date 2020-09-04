<?php
namespace Hsy\Options\Facades;

use Hsy\Options\Options as Opts;
use Illuminate\Support\Facades\Facade;

class Options extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Opts::class;
    }
}
