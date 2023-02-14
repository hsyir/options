<?php


namespace Hsy\Options;


use Hsy\Options\Exceptions\FieldNotExists;
use Hsy\Options\Exceptions\GroupKeyNotDefined;
use Hsy\Options\Facades\Options;

class GroupedOptions
{
    private $config = [];

    private $groupName = "";

    private $groupData = [];


    public function __construct($groupName)
    {
        $this->groupName = $groupName;

        $this->buildGroupDataArray();

    }

    public function get($key, $default = null)
    {
        return $this->groupData[$key] ?? $default;
    }

    public function set($key, $value)
    {
        
        $this->groupData[$key] = $value;

        Options::set($this->databaseGroupKey(), json_encode($this->groupData));

    }

    private function buildGroupDataArray()
    {

        $data = $this->getDatabaseGroupData();

        $this->groupData = $data;

    }



    private function databaseGroupKey()
    {
        return "grouped-" . $this->groupName;
    }

    private function getDatabaseGroupData()
    {
        $jsonData = Options::get($this->databaseGroupKey());
        return $jsonData ? (array)json_decode($jsonData) : [];
    }

}
