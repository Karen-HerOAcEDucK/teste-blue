<?php

namespace TestBlue\ItemInventory;

use TestBlue\Base\AncillaryClass;

class ItemInventoryLoader extends AncillaryClass{
    public static function load(ItemInventory $itemInventory)
    {
        $CI = self::getCI();
        $CI->load->model("ItemInventoryModel");
        $data = $CI->ItemInventoryModel->getItem($itemInventory->id);

        $itemInventory->setAmout($data['amount']);
        $itemInventory->setProcessor($data['processor']);
        $itemInventory->setBrandName($data['brand_name']);
        $itemInventory->setRamMemory($data['ram_memory']);
        $itemInventory->setStorage($data['storage_computer']);
        $itemInventory->setTypeStorage($data['storage_type']);
        $itemInventory->setModelComputer($data['model_computer']);
        $itemInventory->setDateInventory($data['date_inventory']);
    }
}