<?php
namespace app\models\form;

use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\Model;

class ContactForm extends Model {
    public $firstname = '';
    public $lastname;
    public $tel;
    public $message;

    public function tableName() {
        return '';
    }

    public function rules() {
        return [
            'firstname' => ['required', ['min' => 8]],
            'lastname' => ['required', ['max' => 2]],
            'tel' => ['required'],
            'message' => ['required'],
        ];
    } 

    public function getDbAttributes() {
        return [
            'firstname', 'lastname', 'tel', 'message',
        ];
    }

    public function ruleLabels() {
        return [
            'firstname' => 'Vārds',
            'lastname' => 'Uzvārds',
            'tel' => 'Tālrunis',
            'message' => 'Jūsu komentārs',
        ];
    } 

    public function send() {
        Application::$app->session->setFlash('contact', 'Jūsu komentārs tika nosūtīts. Mēs sazināsimies ar Jums tuvākajā laikā.');
        
    }
}