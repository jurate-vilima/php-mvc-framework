<?php
namespace app\models\forms;

use JurateVilima\MvcCore\Model;

class LoginForm extends Model {
    public $email = '';
    public $password = '';
    public $formName = 'Pieteikšanās';
    public $id = 'login';

    public function rules() {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function ruleLabels() {
        return [
            'email' => 'Epasta adrese',
            'password' => 'Parole',
        ];
    }

    public function getDbAttributes() {

    }

    public function tableName() {

    }
}