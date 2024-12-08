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

    // public function ajaxLogin() {
    //     if ($this->request->isPost()) {
    //         $data = $this->request->fetchSanitizedData();
    //         $this->userModel->loadData($data);

    //         // User data validation
    //         $this->userModel->validate($this->userModel->loginRules());
    //         if ($this->userModel->errors) {
    //             return $this->jsonResponse([
    //                 'success' => false,
    //                 'errors' => $this->userModel->errors,
    //             ]);
    //         }
    
    //         // Try login if validation successful
    //         // $this->userModel->login();
    //         if ($this->userModel->login()) {
    //             // echo 'log';
    //             return $this->jsonResponse(['success' => true]);
    //         } else {
    //             return $this->jsonResponse([
    //                 'success' => false,
    //                 // 'errors' => ['login' => 'Неверный email или пароль.'],
    //                 'errors' => $this->userModel->errors,
    //             ]);
    //         }
    //     }
    
    //     return $this->jsonResponse(['success' => false, 'message' => 'Invalid request.']);
    // }    

    
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
            if ($this->userModel->login()) {
                return $this->jsonResponse(['success' => true]);
            } else {
                return $this->jsonResponse([
                    'success' => false,
                    'errors' => $this->userModel->errors,
                ]);
            }
        }
    
        return $this->jsonResponse(['success' => false, 'message' => 'Invalid request.']);
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

    public function ajaxRegister() {
        if ($this->request->isPost()) {
            $data = $this->request->fetchSanitizedData();
            $this->userModel->loadData($data);

            // User data validation
            $registerRules['group'] = ['fields' => ['email', 'password', 'confirmPassword'], 'rules' => ['required']] ;
            // $registerRules['group'] = ['fields' => ['email', 'password', 'confirmPassword'], 'rules' => ['required']] ;
            $modelRules = $this->userModel->getRulesByKeys(['email', 'password', 'confirmPassword']);
            $registerRules = [...$registerRules, ...$modelRules];
            // $registerRules = $this->userModel->getRulesByKeys(['email', 'password', 'confirmPassword']);

            $this->userModel->validate($registerRules);
            if ($this->userModel->errors) {
                return $this->jsonResponse([
                    'success' => false,
                    'errors' => $this->userModel->errors,
                ]);
            } else {
                $this->userModel->save('patients', ['email', 'password']);
                // $this->userModel->save();
                return $this->jsonResponse([
                    'success' => true,
                    'message' => "Jūs esat veiksmīgi piereģistrēts. Varat ieet savā kontā.",
                ]);
            }
        }
    
        return $this->jsonResponse(['success' => false, 'message' => 'Invalid request.']);
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