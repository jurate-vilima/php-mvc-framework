<?php
namespace app\controllers;

use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\Controller;
use JurateVilima\MvcCore\View;
use JurateVilima\MvcCore\Request;
use app\models\User;
use JurateVilima\MvcCore\form\Form;

use app\models\forms\LoginForm;
use app\models\forms\RegisterForm;

class HomeController extends Controller {
    public $loginModel;
    public $loginForm;
    public $registerModel;
    public $registerForm;

    public function __construct(View $view, Request $request) {
        parent::__construct($view, $request);

        $this->loginModel = new LoginForm;
        $this->loginForm = new Form($this->loginModel);
        $this->registerModel = new RegisterForm;
        $this->registerForm = new Form($this->registerModel);
    }

    public function index()
    {
        $this->render('pages/home', ['loginForm' => $this->loginForm, 'registerForm' => $this->registerForm]);
    }
}