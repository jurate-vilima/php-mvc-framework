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
        return 'lietotaji';
    }

    public function rules() {
        return [
            'firstname' => ['required', ['min' => 8], 'unique'],
            'lastname' => ['required', ['max' => 2]],
            'email' => [
                'required', 
                'email', 
                ['unique' => ['administrators', 'patients', 'doctors']], // Checking uniqueness in all 3 tables
            ],
            'password' => ['required'],
            'confirmPassword' => ['required', ['match' => 'password']],
        ];
    } 
    // public function rules() {
    //     return [
    //         'email' => [
    //             'required', 
    //             'email', 
    //             ['unique' => ['administratori', 'patients', 'arsti']], // Проверка уникальности в трёх таблицах
    //         ],
    //         'password' => ['required'],
    //     ];
    // }
    
    // public function registerRules() {
    //     return [
    //         'email' => [
    //             'required', 
    //             'email', 
    //             ['unique' => ['administratori', 'patients', 'arsti']], // Проверка уникальности в трёх таблицах
    //         ],
    //         'password' => ['required'],
    //         'confirmPassword'
    //     ];
    // }

    public function loginRules() {
        return [
            'group' => [
                'fields' => ['email', 'password'], 
                'rules' => ['required'],
            ],
            'email' => ['email'], // Дополнительные правила для email
        ];
        // return [
        //     ['email', 'password'] => ['required'],
        //     'email' => ['email'],
        //     // 'email' => ['required', 'email'],
        //     // 'password' => ['required'],
        // ];
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
            ['idlomas' => 3], 'email', 'password',
        ];
    }

    public function save($tableName, $attributes) {
        if(in_array('password', $attributes))
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        
        parent::save($tableName, $attributes);
    }

    // public function login() {
    //     $user = Application::$app->db->findOne($this->tableName(), ['email' => $this->email]);

    //     if($user) {
    //         $hashedPassword = $user['parole'];

    //         // if (password_verify($this->password, $hashedPassword)) {
    //         if($this->password == $hashedPassword) {
    //             session_regenerate_id(true); // Generate new session ID and delete old session

    //             $userSessionData = [
    //                 'user_id' => $user['idlietotaji'],
    //                 // 'firstname' => $user['firstname'],
    //                 'role' => $user['idlomas'],
    //             ];

    //             Application::$app->session->set('user', $userSessionData);
    //             Application::$app->session->setTimeout(60);
    //             return true;
    //             // Proceed with login
    //         } else {
    //             // Application::$app->session->setFlash('login', 'Password or Email is invalid');
    //             $this->errors['login'] = "Parole vai e-pasts nav pareizs";
    //             return false;
    //             // Handle failed login
    //         }
    //     } else {
    //         // Application::$app->session->setFlash('login', 'Password or Email is invalid');
    //         $this->errors['login'] = "Parole vai e-pasts nav pareizs";
    //         return false;
    //         // Handle case where the user doesn't exist
    //     }
    // }

    
    public function login() {
        $user = $this->findUserByEmail($this->email);
    
        if ($user) {
            $hashedPassword = $user['password'];
    
            // if($this->password === $hashedPassword) {
            if (password_verify($this->password, $hashedPassword)) {
                session_regenerate_id(true); // Обновляем сессию
    
                $userSessionData = [
                    'user_id' => $user['user_id'],
                    'role' => $user['role'],
                ];
    
                Application::$app->session->set('user', $userSessionData);
                Application::$app->session->setTimeout(60);
                return true;
            } else {
                $this->errors['login'] = "Epasts vai parole nav pareizs.";
                return false;
            }
        } else {
            $this->errors['login'] = "Epasts vai parole nav pareizs.";
            return false;
        }
    }
    
    public function logout() {
        Application::$app->session->destroy();
    }

    public function findUserByEmail($email) {
        $sql = "
            SELECT 'administrator' AS role, idadministartors AS user_id, email, password
            FROM administrators
            WHERE email = :email
    
            UNION ALL
    
            SELECT 'patient' AS role, idpatients AS user_id, email, password
            FROM patients
            WHERE email = :email
    
            UNION ALL
    
            SELECT 'doctor' AS role, iddoctors AS user_id, email, password
            FROM doctors
            WHERE email = :email;
        ";
    
        $stmt = Application::$app->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }    

    public function isEmailUnique($email) {
        $sql = "
            SELECT COUNT(*) as count FROM (
                SELECT epasts FROM administratori WHERE epasts = :email
                UNION ALL
                SELECT epasts FROM patients WHERE epasts = :email
                UNION ALL
                SELECT epasts FROM arsti WHERE epasts = :email
            ) as email_check;
        ";
    
        $stmt = Application::$app->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        return $result['count'] == 0; // Returms true if an email is unique
    }
    
}