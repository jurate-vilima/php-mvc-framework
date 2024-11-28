<?php
use JurateVilima\MvcCore\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/jurate-vilima/mvc-core/helpers.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__)); // Specify the directory where .env is located
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

// paths are loaded in Router::routes array
$app->router->get('/', 'home');
$app->router->get('/users', 'users');

$app->router->get('/contacts', [SiteController::class, 'contact']);
$app->router->post('/contacts', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->post('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile'])->only(['patient', 'admin']);
//

$app->on(Application::EVENT_BEFORE_REQUEST, function() {
    echo 'Before event';
});

$app->run();