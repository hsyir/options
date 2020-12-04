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

        $this->config = $this->getGroupConfig();
        if (!$this->config)
            throw new GroupKeyNotDefined("Config 'options.groups.$groupName' not defined or not configured!");

        $this->buildGroupDataArray();

    }

    public function get($key, $default = null)
    {
        return $this->groupData[$key] ?? $default;
    }

    public function set($key, $value)
    {
        if (!$this->isFieldExists($key))
            throw new FieldNotExists("OptionsGroup: Field '{$this->groupName}.{$key}' not exists!");

        $this->groupData[$key] = $value;

        Options::set($this->databaseGroupKey(), json_encode($this->groupData));

    }

    private function buildGroupDataArray()
    {
        $group = [];
        $fields = $this->config["fields"] ?? [];
        $data = $this->getDatabaseGroupData();
        foreach ($fields as $field) {
            $key = $field["key"];
            if (isset($data[$key]))
                $group[$key] = $data[$key];
        }

        $this->groupData = $group;

    }


    /**
     * @param $groupName
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private function getGroupConfig()
    {
        return config("options.groups." . $this->groupName);
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

    private function isFieldExists($key)
    {
        foreach ($this->config["fields"] ?? [] as $field) {
            if ($field["key"] == $key) return true;
        }
        return false;
    }

}
