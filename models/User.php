<?php
namespace app\models;

use JurateVilima\MvcCore\Application;
use JurateVilima\MvcCore\Model;

class User extends Model {
    public $firstname = '';
    public $lastname;
    public $email;
    public $password;
    public $confirmPassword;

    public function tableName() {
        return 'users';
    }

    public function rules() {
        return [
            'firstname' => ['required', ['min' => 8], 'unique'],
            'lastname' => ['required', ['max' => 2]],
            'email' => ['required', 'email', 'unique'],
            'password' => ['required'],
            'confirmPassword' => ['required', ['match' => 'password']],
        ];
    } 

    public function loginRules() {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function ruleLabels() {
        return [
            'firstname' => 'Vārds',
            'lastname' => 'Uzvārds',
            'email' => 'Epasts',
            'password' => 'Parole',
            'confirmPassword' => 'Paroles apstiprinājums',
        ];
    } 

    public function getDbAttributes() {
        return [
            'firstname', 'lastname', 'email', 'password',
        ];
    }

    public function save() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        parent::save();
    }

    public function login() {
        $user = Application::$app->db->findOne($this->tableName(), ['email' => $this->email]);
        // var_dump($user);

        if($user) {
            $hashedPassword = $user['password'];

            if (password_verify($this->password, $hashedPassword)) {
                session_regenerate_id(true); // Generate new session ID and delete old session

                $userSessionData = [
                    'users_id' => $user['users_id'],
                    'firstname' => $user['firstname'],
                    'role' => 'admin',
                ];

                Application::$app->session->set('user', $userSessionData);
                Application::$app->session->setTimeout(60);
                return true;
                // Proceed with login
            } else {
                Application::$app->session->setFlash('login', 'Password or Email is invalid');
                return false;
                // Handle failed login
            }
        } else {
            Application::$app->session->setFlash('login', 'Password or Email is invalid');
            return false;
            // Handle case where the user doesn't exist
        }
    }

    public function logout() {
        Application::$app->session->destroy();
    }
}