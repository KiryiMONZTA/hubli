<?php

namespace OxidSupport\Hubli\Model;

class DataConfig
{
    private const DATACONFIG_FILEPATH = __DIR__ . '/../../config/dataConfig.json';

    private static ?DataConfig $instance = null;
    private Object $config;
    
    private function __construct() { }

    public static function getInstance(): DataConfig
    {
        if (self::$instance === null) {
            self::$instance = new DataConfig();
            self::$instance->loadConfig();
        }

        return self::$instance;
    }

    public function getNameIn(string $property)
    {
        return $this->config->$property->in->name;
    }

    public function getNameOut(string $property)
    {
        return $this->config->$property->out->name;
    }

    public function getValuesIn(string $property)
    {
        if (isset($this->config->$property->in->values)) {
            return $this->config->$property->in->values;
        } else {
            return null;
        }
    }

    public function getValuesOut(string $property)
    {
        if (isset($this->config->$property->out->values)) {
            return $this->config->$property->out->values;
        } else {
            return null;
        }
    }

    private function loadConfig(): void
    {        
        $this->config = json_decode(file_get_contents($this::DATACONFIG_FILEPATH));
    }
}
