<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 25/11/18
 * Time: 16:54
 */

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;


//R::setup('mysql:host='.\Config\Bdd::HOST.';dbname='.\Config\Bdd::DBNAME.'',\Config\Bdd::USERNAME,\Config\Bdd::PASSWORD);
R::setup('mysql:host=localhost;dbname=sanofi_v0','usersio','pwsio');


$dataGenerator = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);


$app->get('/', function ($request, $response, $args) {




});

$app->run();

