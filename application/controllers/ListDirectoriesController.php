<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListDirectoriesController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->input->method() == 'post'){
            $input = $this->input->post();
            $path = $input['file-path'];

            $contents = [];
            $itens = new DirectoryIterator($path);
            foreach ($itens as $item) {
                if ($item->gettype() === 'dir') {
                    array_push($contents, [$item->getFilename(), 'dir']);
                    // $data['directories'][] = $item->getFilename();
                } else {
                    array_push($contents, [$item->getFilename(), 'file']);
                    // $data['files'][] = $item->getFilename();
                }
            }
            $data['contentsPath'] = $contents;
        }

        $data['title'] = "Listagem de Diretórios Linux";
        $this->template->load("main", "list-directories/index", $data);
    }
}
