<?php

use TestBlue\ItemInventory\ItemInventory;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class ItemInventoryModel extends CI_Model
{
    public $table = '';
    public $primary_key = '';

    public function __construct()
    {
        $this->load->database();
    }

    public function getItemsInventory()
    {
        $this->db->select("i.id");
        $this->db->select("i.amount");
        $this->db->select("i.brand_name");
        $this->db->select("i.model_computer");
        $this->db->select("i.date_inventory");
        $this->db->select("i.identification_code_computer");
        $this->db->from("inventory i");
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

    public function getItem($id)
    {
        $this->db->select("i.id");
        $this->db->select("i.amount");
        $this->db->select("i.brand_name");
        $this->db->select("i.model_computer");
        $this->db->select("i.date_inventory");
        $this->db->select("i.identification_code_computer");
        $this->db->from("inventory i");
        $this->db->where("i.id", $id);

        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row_array() : [];
    }
}
