<?php

use SSCustomerPanel\Base\Constant;
use SSCustomerPanel\Communication\Protocol\FileTransfer\FileTransferFactory;
use SSCustomerPanel\Communication\Protocol\FileTransfer\FileTransferParams;
use SSCustomerPanel\Communication\Protocol\FileTransfer\FileTransferSettings;
use SSCustomerPanel\Company\Company;
use SSCustomerPanel\ConfirmationEmail\ConfirmationEmailTypes;
use SSCustomerPanel\Email\Email;
use SSCustomerPanel\Email\Wrapper\WrapperPHPMailer;
use SSCustomerPanel\Plugin\Plugin;
use SSCustomerPanel\REST\Http\HttpMethods;

require_once('vendor/autoload.php');

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected function redirectIfNotLoggedIn()
    {
        if (!isLoggedIn()) {
            $this->session->keep_flashdata('alert');
            redirect('login');
        }
    }

    public function startPagination(string $url, int $total, int $perPage = 20, int $segment = 4)
    {

        $config = array();
        $config["base_url"] = site_url($url . '/page');
        $config['first_url'] = site_url($url . '/page/1') . (!empty($this->input->get()) ? '?' . http_build_query($this->input->get()) : '');
        $config["total_rows"] = $total;
        $config["per_page"] = $perPage;
        $config["uri_segment"] = $segment;
        $config['use_page_numbers'] = TRUE;
        $config["reuse_query_string"] = TRUE;

        $config['full_tag_open'] = '<nav><ul class="pagination mb-0">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
        $config['next_tag_close'] = '</span></li>';
        $config['first_link'] = 'Primeira';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_link'] = 'Última';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
        $config['last_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);

        return $config["per_page"];
    }

    public function sendConfirmationEmail(string $confirmationEmailType, int $customerOperatorContactId, string $customerOperatorContactEmail)
    {
        $this->load->model('ConfirmEmailModel');
        list($wasInserted, $confirmationEmailToken) =
            $this->ConfirmEmailModel->generateConfirmationEmail(
                $confirmationEmailType,
                $customerOperatorContactId,
                $customerOperatorContactEmail
            );
        if (!$wasInserted) {
            throw new Exception('Não foi possível gerar uma confirmação de e-mail para o contato informado.');
        }

        $this->load->model('ParametersModel');
        $companyId = $this->ParametersModel->getParam('EMPRESA_PADRAO_SAC_WEB');
        $company = new Company($companyId);
        $company->load();

        switch ($confirmationEmailType) {
            case ConfirmationEmailTypes::PASSWORD:
                $title = 'Definir uma nova senha';
                $templateView = 'confirmationEmail/templates/password';
                break;
            case ConfirmationEmailTypes::EMAIL:
                $title = 'Confirmar novo e-mail';
                $templateView = 'confirmationEmail/templates/email';
        }
        $subject = "{$company->abbrName} - {$title}";

        $templateData['confirmationEmailToken'] = $confirmationEmailToken;
        $templateData['company'] = $company;
        $template = $this->load->view($templateView, $templateData, true);

        $wrapperEmail = new WrapperPHPMailer($company->smtp);
        $wrapperEmail->setFromEmail(new Email($company->sendEmail->value, $company->sendEmail->password));
        $wrapperEmail->setFromName($company->abbrName);
        $wrapperEmail->addToEmail($customerOperatorContactEmail);
        $wrapperEmail->setSubject($subject);
        $wrapperEmail->setBody($template);
        $wrapperEmail->sendEmail();
    }

    public function verifyFile($attachment = [])
    {
        $files = [];
        $fileName = $fileNameHash = '';
        for ($i = 0; $i < count($attachment['name']); $i++) {
            if ($attachment['error'][$i] != 0) {
                throw new Exception('Ocorreu um erro ao enviar o arquivo. Tente novamente mais tarde.');
            }
            $fileName = $attachment['name'][$i];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            // if (array_search($fileExtension, Attachment::ALLOWED_FILE_TYPE) === false) {
            //   throw new Exception("Arquivo '{$fileName}' com extensão inválida.");
            // }
            $fileNameHash = md5(uniqid(time() * rand(0, 9999))) . '.' . $fileExtension;
            $files[$fileName] = $fileNameHash;
        }
        return $files;
    }

    public function uploadFile($attachments, $attachmentsData, $uploadToFtp = false)
    {
        $this->load->model('CrmModel');
        $this->load->model('CompanyModel');
        $this->load->model('ParametersModel');
        for ($i = 0; $i < count($attachments['name']); $i++) {
            $fileName = $attachmentsData['NOME_ARQUIVO'][$i];
            if (!move_uploaded_file($attachments['tmp_name'][$i], ROOT_FS . "assets/files{$fileName}")) {
                throw new Exception("Ocorreu algum problema ao fazer upload do arquivo '{$fileName}'.");
            }
        }
        if ($uploadToFtp) {
            $defaultCompanyId = $this->ParametersModel->getParam('EMPRESA_PADRAO_SAC_WEB');
            $params = $this->CompanyModel->getFileTransferParams(Plugin::SAC_WEB_KEY, $defaultCompanyId);
            $ftParams = new FileTransferParams($params[0]['NREG']);
            $ftParams->setHost($params[0]['HOST']);
            $ftParams->setPort($params[0]['PORTA']);
            $ftParams->setIsPassive($params[0]['AO_PASSIVO'] == Constant::YES);
            $ftParams->setIsSFTP($params[0]['AO_SSH'] == Constant::YES);
            $ftParams->setUser($params[0]['USUARIO']);
            $ftParams->setPassword($params[0]['SENHA']);
            $ftParams->setWorkDir($params[0]['DIR_TRABALHO']);
            $ftParams->setDirPlugin($params[0]['DIR_PLUGIN']);
            $ftParams->setAccessUrl($params[0]['URL_ACESSO']);

            $ft = FileTransferFactory::assemble($ftParams);
            $ft->login();
            $ftSettings = new FileTransferSettings();
            $ftSettings->setCanDeleteAfterUpload(true);
            $ftSettings->setCanEncryptName(true);
            $uploadResult = $ft->upload($attachmentsData['CAMINHO_ARQUIVO'], $ftSettings);
            if (!empty($uploadResult['filesWithError'])) {
                throw new Exception('Ocorreu problemas ao subir seus anexos para a nuvem.');
            }
        }
        return $this->CrmModel->insertFile($attachmentsData);
    }

    /* API-like implementation */
    public function api($resourceId = null)
    {
        header('Content-Type: application/json');
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case HttpMethods::GET:
                    (empty($resourceId) ? $this->_getAll() : $this->_getOne($resourceId));
                    break;
                case HttpMethods::POST:
                    $this->_post();
                    break;
                case HttpMethods::PUT:
                    $this->_put($resourceId);
                    break;
                case HttpMethods::PATCH:
                    $this->_patch($resourceId);
                    break;
                case HttpMethods::DELETE:
                    $this->_delete($resourceId);
            }
        } catch (Throwable $e) {
            $statusCode = ($e->getCode() ?: 500);
            http_response_code($statusCode);
            echo json_encode([
                'error' => [
                    'message' => $e->getMessage(),
                    'code' => $statusCode
                ]
            ]);
        }
    }

    protected function _getAll()
    {
        throw new Exception('Método não permitido', 405);
    }

    protected function _getOne($resourceId)
    {
        throw new Exception('Método não permitido', 405);
    }

    protected function _post()
    {
        throw new Exception('Método não permitido', 405);
    }

    protected function _put($resourceId)
    {
        throw new Exception('Método não permitido', 405);
    }

    protected function _patch($resourceId)
    {
        throw new Exception('Método não permitido', 405);
    }

    protected function _delete($resourceId)
    {
        throw new Exception('Método não permitido', 405);
    }
}
