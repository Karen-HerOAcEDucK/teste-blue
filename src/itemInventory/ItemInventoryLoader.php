<?php

namespace TestBlue\ItemInventory;

use TestBlue\Base\AncillaryClass;

class ItemInventoryLoader extends AncillaryClass{
    public static function load(ItemInventory $itemInventory)
    {
        $CI = self::getCI();
        $CI->load->model("ItemsInventoryModel");
        $data = $CI->ItemsInventoryModel->getItem($itemInventory->id);

        $itemInventory->setAmout($data['amount']);
        $itemInventory->setBrandName($data['brand_name']);
        $itemInventory->setModelComputer($data['model_computer']);
        $itemInventory->setDateInventory($data['date_inventory']);
        $itemInventory->setCodeIdentification($data['identificartion_code_computer']);
    }
}