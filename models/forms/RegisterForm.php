<?php
namespace app\models\forms;

use JurateVilima\MvcCore\Model;

class RegisterForm extends Model {
    public $email = '';
    public $password = '';
    public $confirmPassword = '';
    public $formName = 'Reģistrācija';
    public $id = 'register';

    public function rules() {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', ['min' => 6]],
            'confirmPassword' => ['required', ['match' => $this->password]],
        ];
    }

    public function ruleLabels() {
        return [
            'email' => 'Epasta adrese',
            'password' => 'Parole',
            'confirmPassword' => 'Paroles apstiprinājums',
        ];
    }

    public function getDbAttributes() {

    }

    public function tableName() {

    }
}