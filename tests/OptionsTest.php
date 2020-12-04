<?php

namespace Hsy\Options\Tests;


use Hsy\Options\Facades\Options;
use Illuminate\Support\Facades\Config;

class OptionsTest extends TestCase
{

    public function testSetAndGetOptions()
    {
        Options::set("key","value");
        $this->assertEquals("value",Options::get("key"));

    }

    public function testDefaultValue()
    {
        $optionValue = Options::get("notExisted","default");
        $this->assertEquals("default",$optionValue);

        Options::set("key","value");
        $optionValue = Options::get("key","default");
        $this->assertEquals("value",$optionValue);

    }
}