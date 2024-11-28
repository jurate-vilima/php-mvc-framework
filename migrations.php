<?php
use JurateVilima\MvcCore\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/jurate-vilima/mvc-core/helpers.php';

$dotenv = Dotenv::createImmutable(__DIR__); // Specify the directory where .env is located
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'paths' => [
        'root' => $_ENV['ROOT_DIR'],
        'base_url' => $_ENV['BASE_URL'],
    ]
];

$app = new Application($config);

$app->db->applyMigrations();