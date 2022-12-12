<?php

namespace TestBlue\ItemInventory;

use JsonSerializable;
use TestBlue\ItemInventory\ItemInventoryLoader;

class ItemInventory implements JsonSerializable
{
    private int $id;
    private int $amount;
    private string $storage;
    private string $brandName;
    private string $processor;
    private string $ramMemory;
    private string $storageType;
    private string $modelComputer;
    private string $dateInventory;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function load()
    {
        ItemInventoryLoader::load($this);
    }

    public function setAmout($amount)
    {
        $this->amount = $amount;
    }

    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    public function setModelComputer($modelComputer)
    {
        $this->modelComputer = $modelComputer;
    }

    public function setDateInventory($dateInventory)
    {
        $this->dateInventory = $dateInventory;
    }

    public function setProcessor($processor)
    {
        $this->processor = $processor;
    }

    public function setStorage($storage)
    {
        $this->storage = $storage;
    }

    public function setRamMemory($ramMemory)
    {
        $this->ramMemory = $ramMemory;
    }

    public function setTypeStorage($storageType)
    {
        $this->storageType = $storageType;
    }

    public function jsonSerialize() : mixed
    {
        $fields = get_object_vars($this);
        return $fields;
    }

    public function __get($field)
    {
        return $this->{$field};
    }

    public function __isset($field)
    {
        return isset($this->{$field});
    }
}