<?php
namespace app\controllers;

use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\Controller;
use JurateVilima\MvcCore\View;
use JurateVilima\MvcCore\Request;
use app\models\User;
use JurateVilima\MvcCore\form\Form;

class AuthController extends Controller {
    public $userModel;
    public $form;

    public function __construct(View $view, Request $request) {
        parent::__construct($view, $request);

        $this->userModel = new User;
        // $this->form = new Form($this->userModel);
    }

    public function login() {
        if($this->request->isGet()) {
            $this->render('login',  ['form' => $this->form]);
        } else {
            $this->userModel->loadData($this->request->fetchSanitizedData());
            $this->userModel->validate($this->userModel->loginRules());

            if($this->userModel->errors) {
                $this->render('login', ['form' => $this->form]);
            } else {
                if(!$this->userModel->login()) 
                    $this->render('login', ['form' => $this->form]);
                else
                    redirect('/contacts');
            }
        }
    }

    public function ajaxLogin() {
        if ($this->request->isPost()) {
            $data = $this->request->fetchSanitizedData();
            $this->userModel->loadData($data);

            // User data validation
            $this->userModel->validate($this->userModel->loginRules());
            if ($this->userModel->errors) {
                return $this->jsonResponse([
                    'success' => false,
                    'errors' => $this->userModel->errors,
                ]);
            }
    
            // Try login if validation successful
            // $this->userModel->login();
            if ($this->userModel->login()) {
                // echo 'log';
                return $this->jsonResponse(['success' => true]);
            } else {
                return $this->jsonResponse([
                    'success' => false,
                    // 'errors' => ['login' => 'Неверный email или пароль.'],
                    'errors' => $this->userModel->errors,
                ]);
            }
        }
    
        return $this->jsonResponse(['success' => false, 'message' => 'Invalid request.']);
    }
    
    private function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    

    public function register() {
        if($this->request->isGet()) {
            $this->render('register' , ['form' => $this->form]);
        } else { 
            $this->userModel->loadData($this->request->fetchSanitizedData());
            $this->userModel->validate();

            if($this->userModel->errors) {
                // show registration errors
                $this->render('register' ,['form' => $this->form]);
            }
            else {
                // save user to the db
                $this->userModel->save();
                redirect('/');
                //$this->render('home', ['model' => $registerModel, 'errors' => $registerModel->errors]);
            }
                //var_dump('Success');
            //$this->render('dashboard', [], 'auth');
        }
    }

    public function logout() {
        // var_dump($this->request->getMethod());
        $this->userModel->logout();
        redirect('/');
    }

    public function profile() {
        $this->render('profile');
    }
}