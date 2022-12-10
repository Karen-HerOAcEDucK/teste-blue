<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ItemInventoryModel");
    }

	public function index()
	{
        $itemsInventory = $this->ItemInventoryModel->getItemsInventory();

        echo "<pre>";
        var_dump($itemsInventory); exit;

        $data['title'] = "Listagem dos Inventários";
		$this->template->load("main", "list-inventory/index", $data);
	}

    public function new()
    {
        # code...
    }

    public function edit($id)
    {
        # code...
    }
}
