<?php
namespace app\migrations;

use JurateVilima\MvcCore\Application;

class m0001_initial {
    public function up() {
        Application::$app->db->pdo->exec('CREATE TABLE IF NOT EXISTS`users` 
        (`users_id` INT NOT NULL AUTO_INCREMENT , 
        `first_name` VARCHAR(50) NOT NULL , 
        `last_name` VARCHAR(50) NOT NULL , 
        `age` INT NOT NULL , 
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        PRIMARY KEY (`users_id`)) ENGINE = InnoDB;');
    }

    public function down() {
        Application::$app->db->pdo->exec('DROP TABLE users;');
    }
}