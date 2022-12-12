<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExportFileController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ItemInventoryModel");
    }

    public function exportJsonInfo()
    {
        $contentFileData = $this->ItemInventoryModel->getItemsInventory();

        if(!empty($contentFileData)){
            $contentFileJson = json_encode($contentFileData);
            $fileName = "inventory.json";
    
            $file = fopen(dirname(dirname(dirname(__FILE__))) . '/' . "files/json" . '/' . $fileName, 'w');
            fwrite($file, $contentFileJson);
            fclose($file);
        } else {
            $this->alert->set('alert-danger', "Não foi possível exportar os dados.");
        }

        redirect("inventory/index");
    }

    public function exportCsvInfo()
    {
        $contentFileData = $this->ItemInventoryModel->getItemsInventoryReturnArray();
        
        if(!empty($contentFileData)){
            ob_start();
            $fileName = "inventory.csv";
            $file = fopen(dirname(dirname(dirname(__FILE__))) . '/' . "files/csv" . '/' . $fileName, 'w');

            fputcsv($file, array_keys(reset($contentFileData)));
            foreach ($contentFileData as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
            ob_get_clean();
        } else {
            $this->alert->set('alert-danger', "Não foi possível exportar os dados.");
        }

        redirect("inventory/index");
    }
}