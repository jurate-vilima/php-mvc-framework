<?php
namespace app\controllers;

use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\Controller;
use JurateVilima\MvcCore\View;
use JurateVilima\MvcCore\Request;
use app\models\User;
use JurateVilima\MvcCore\form\Form;

class HomeController extends Controller {
    public function index()
    {
        $this->render('pages/home');
    }
}