<?php

use TestBlue\ItemInventory\ItemInventory;

defined('BASEPATH') or exit('No direct script access allowed');

class ItemInventoryModel extends MY_Model
{
    public $table = 'inventory';
    public $primary_key = 'id';

    public function __construct()
    {
        $this->load->database();
    }

    public function getItemsInventory()
    {
        $this->db->select("i.id");
        $this->db->select("i.amount");
        $this->db->select("i.processor");
        $this->db->select("i.brand_name");
        $this->db->select("i.ram_memory");
        $this->db->select("i.storage_type");
        $this->db->select("i.date_inventory");
        $this->db->select("i.model_computer");
        $this->db->select("i.storage_computer");
        $this->db->from($this->table . " i");
        $this->db->order_by("i.id asc");

        $query = $this->db->get();
        $itemsInventoryData = ($query->num_rows() > 0) ? $query->result_array() : [];
        
        $itemsInventory = array_map(function($itemsInventoryData){
            $item = new ItemInventory($itemsInventoryData['id']);
            $item->load();
            return $item;
        }, $itemsInventoryData);
        return $itemsInventory ?: [];
    }

    public function getItemsInventoryReturnArray()
    {
        $this->db->select("i.id");
        $this->db->select("i.amount");
        $this->db->select("i.processor");
        $this->db->select("i.brand_name");
        $this->db->select("i.ram_memory");
        $this->db->select("i.storage_type");
        $this->db->select("i.date_inventory");
        $this->db->select("i.model_computer");
        $this->db->select("i.storage_computer");
        $this->db->from($this->table . " i");
        $this->db->order_by("i.id asc");

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result_array() : [];
    }

    public function getItem($id)
    {
        $this->db->select("i.id");
        $this->db->select("i.amount");
        $this->db->select("i.processor");
        $this->db->select("i.brand_name");
        $this->db->select("i.ram_memory");
        $this->db->select("i.storage_type");
        $this->db->select("i.date_inventory");
        $this->db->select("i.model_computer");
        $this->db->select("i.storage_computer");
        $this->db->from($this->table . " i");
        $this->db->where("i.id", $id);

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : [];
    }

    public function insertNewItem($fields)
    {
        $data = [
            "brand_name"       => $fields['brand-name'],
            "model_computer"   => $fields['model'],
            "processor"        => $fields['processor'],
            "ram_memory"       => $fields['ram-memory'],
            "storage_computer" => $fields['storage'],
            "storage_type"     => $fields['storage-type'],
            "amount"           => $fields['amount'],
            "date_inventory"   => date('d/m/Y'),
        ];

        $this->db->set($data);
        $result = $this->db->insert($this->table);
        return $result;
    }

    public function updateItem($fields, $id)
    {
        $data = [
            "brand_name"       => $fields['brand-name'],
            "model_computer"   => $fields['model'],
            "processor"        => $fields['processor'],
            "ram_memory"       => $fields['ram-memory'],
            "storage_computer" => $fields['storage'],
            "storage_type"     => $fields['storage-type'],
            "amount"           => $fields['amount'],
            "date_inventory"   => date('d/m/Y'),
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $result = $this->db->update($this->table);
        return $result;
    }

    public function deleteItem($id)
    {
        $this->db->where("id", $id);
        $result = $this->db->delete($this->table);
        return $result;
    }
}
