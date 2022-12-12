<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ItemInventoryModel");
    }

    public function index()
    {
        $data['inventorys'] = $this->ItemInventoryModel->getItemsInventory();

        $data['title'] = "Listagem dos Inventários";
        $this->template->load("main", "list-inventory/index", $data);
    }

    public function new()
    {
        if ($this->input->method() == 'post') {
            $inputs = $this->input->post();
            try {
                if (empty($inputs['brand-name'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Marca do Computador.");
                }
                if (empty($inputs['amount'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Quantidade do Computador.");
                }
                if (empty($inputs['processor'])) {
                    throw new Exception("Para inserir um novo item é necessario informar o Processador do Computador.");
                }
                if (empty($inputs['ram-memory'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Memória do Computador.");
                }
                if (empty($inputs['storage'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a quantidade de Armazenamento do Computador.");
                }

                $result = $this->ItemInventoryModel->insertNewItem($inputs);

                if ($result) {
                    $this->alert->set('alert-success', "Novo item cadastrado com sucesso.");
                    redirect("inventory/index");
                } else {
                    throw new Exception("Não foi possivel cadastrar o item.");
                }
            } catch (Throwable $e) {
                $this->alert->set('alert-danger', $e->getMessage());
            }
        }

        $data['title'] = "Adicionar Item";
        $this->template->load("main", "list-inventory/new", $data);
    }

    public function edit($id)
    {
        $data['fields'] = $this->ItemInventoryModel->getItem($id);

        if ($this->input->method() == 'post') {
            $inputs = $this->input->post();
            try {
                if (empty($inputs['brand-name'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Marca do Computador.");
                }
                if (empty($inputs['amount'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Quantidade do Computador.");
                }
                if (empty($inputs['processor'])) {
                    throw new Exception("Para inserir um novo item é necessario informar o Processador do Computador.");
                }
                if (empty($inputs['ram-memory'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a Memória do Computador.");
                }
                if (empty($inputs['storage'])) {
                    throw new Exception("Para inserir um novo item é necessario informar a quantidade de Armazenamento do Computador.");
                }

                $result = $this->ItemInventoryModel->updateItem($inputs, $id);

                if ($result) {
                    $this->alert->set('alert-success', "O item foi alterador com sucesso.");
                    redirect("inventory/index");
                } else {
                    throw new Exception("Não foi possivel alterar o item.");
                }
            } catch (Throwable $e) {
                $this->alert->set('alert-danger', $e->getMessage());
            }
        }

        $data['title'] = "Editar Item";
        $this->template->load("main", "list-inventory/edit", $data);
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $result = $this->ItemInventoryModel->deleteItem($id);

            if ($result) {
                $this->alert->set('alert-success', "O item foi deletado com sucesso.");
                redirect("inventory/index");
            } else {
                $this->alert->set('alert-danger', "Não foi possível deletar o item desejado.");
                redirect("inventory/index");
            }
        }
    }
}
