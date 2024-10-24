<?php
namespace app\controllers;

use JurateVilima\MvcCore\Controller;
use JurateVilima\MvcCore\View;
use JurateVilima\MvcCore\Request;
use JurateVilima\MvcCore\form\Form;

use app\models\form\ContactForm;

class SiteController extends Controller {
    public $contactModel;
    public $form;

    public function __construct(View $view, Request $request) {
        parent::__construct($view, $request);

        $this->contactModel = new ContactForm;
        $this->form = new Form($this->contactModel);
    }

    public function contact() {
        $params = [
            'name' => 'Jurate',
            'index' => 'Yo',
            'form' => $this->form,
        ];

        if($this->request->isGet()) {
            $this->render('contacts', $params);
        }
        else {
            $this->contactModel->loadData($this->request->fetchSanitizedData());
            $this->contactModel->validate($this->contactModel->rules());

            if($this->contactModel->errors) {
                $this->render('contacts', $params);
            } else {
                $this->contactModel->send();
                $this->render('contacts', $params);
            }         
        }      
    }

    public function handleContacts() {
        var_dump($this->request->fetchSanitizedData());
    }
}