<?php

chdir(__DIR__);

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


//$app->get('/visiteurMedical', '\Controllers\VisiteurMedical:getVisiteurMedical');


$app->get('/visiteurMedical', \Controllers\VisiteurMedical::class . ':getVisiteurMedical');
$app->get('/visiteurMedical/{id}', \Controllers\VisiteurMedical::class . ':getVisiteurMedicalById');





$app->run();

