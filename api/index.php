<?php

use Symfony\Component\Yaml\Parser;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$container = new \Pimple\Container();

$container['notebook.routes'] = function($c) {
    $yaml = new Parser();
    
    $routes = $yaml->parse(file_get_contents(__DIR__ . '/src/Config/routes.yml'));
    return $routes;
};

$app = new Silex\Application();
    $app['debug'] = false;
$app->register(new \Silex\Provider\ValidatorServiceProvider());

$app->mount('/', new Notebook\ControllerProvider($container));

$app->run();
