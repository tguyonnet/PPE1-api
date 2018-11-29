<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 25/11/18
 * Time: 16:54
 */

chdir(__DIR__);

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;


//R::setup('mysql:host='.\Config\Bdd::HOST.';dbname='.\Config\Bdd::DBNAME.'',\Config\Bdd::USERNAME,\Config\Bdd::PASSWORD);
R::setup('mysql:host=localhost;dbname=sanofi_vtest','usersio','pwsio');


$faker = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];


$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);


$app->get('/', function ($request, $response, $args) {
    $faker = Faker\Factory::create('fr_FR');

    $password = $faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii.$faker->randomAscii;


    $employee = R::dispense('employee');
    $employee->city = $faker->city.$faker->citySuffix;
    $employee->employee_name = $faker->lastName;
    $employee->employee_firstname = $faker->firstName;
    $employee->street_address = $faker->randomNumber().' '.$faker->streetName;
    $employee->postal_code = $faker->postcode;
    $employee->birthdate = $faker->date('Y-m-d');
    $employee->appli_pw = $password;
    $employee->email = $faker->email;
    $employee->cellphone = $faker->phoneNumber;
    R::store($employee);


    $absence = R::dispense('absence');
    $absence->start_date = $faker->date('Y-m-d');
    $absence->end_date = $faker->date('Y-m-d');
    $absence->absence_pattern = $faker->randomElement(['Mon réveil n’a pas sonné', 'Mon enfant est malade', 'Ma voiture ne démarre pas', 'J’attend le plombier', 'J’ai un coup de mou', 'Ma grande-tante est décédée']);
    $absence->type = $faker->randomElement(['disease','rtt','furlough']);
    $absence->employee = $employee;
    R::store($absence);


    $enterexit = R::dispense('enterexit');
    $enterexit->hiring_date = $faker->dateTime();
    $enterexit->employee = $employee;
    R::store($enterexit);


    $termination = R::dispense('termination');
    $termination->termination_date =  $faker->date('Y-m-d');
    $termination->enterexit = $enterexit;
    R::store($termination);


    $retirement = R::dispense('retirement');
    $retirement->retirement_date =  $faker->date('Y-m-d');
    $retirement->enterexit = $enterexit;
    R::store($retirement);


    $departure = R::dispense('departure');
    $departure->departure_date =  $faker->date('Y-m-d');
    $departure->enterexit = $enterexit;
    R::store($departure);


/*
    $formation = R::dispense('formation');
    $formation->formation_libelle = $faker->randomElement(['PHP', 'jQuery', 'AngularJS', 'Slim Framework', 'RedBeanPHP', 'GitHub', 'Moodle', 'Pachagiste', 'Java', 'PhpStorm', 'Atom']);
    $formation->date =  $faker->date('Y-m-d');
    $formation->formation_id = $formation;
    R::store($formation);



    $participate = R::dispense('participate');
    $participate->employee_id = $employee;
    $participate->formation_id = $formation;
    R::store($participate);

*/


    $career = R::dispense('career');
    $career->responsabilities = $faker->randomElement(['employé', '']);
    $career->hierarchy = $faker->randomElement();
    $career->employee = $employee;
    R::store($career);



    $post = R::dispense('post');
    $post->post_libelle = $faker->jobTitle;
    $post->mission = $faker->realText(30);
    $post->career = $career;
    R::store($career);


    $salary = R::dispense('salary');
    $salary->amount = $faker->randomFloat(2, 1400, 5000);
    $salary->post = $post;
    $salary->employee = $employee;
    R::store($salary);

   $bounty = R::dispense('bounty');
   $bounty->amount = $faker->randomFloat(2, 100, 2000);
   $bounty->date = $faker->dateTime('now');
   $bounty->salary = $salary;
   R::store($bounty);





});


$app->run();

