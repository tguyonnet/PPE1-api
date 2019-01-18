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


//R::setup('mysql:host='.\Core\Core::HOST.';dbname='.\Core\Core::DBNAME.'',\Core\Core::USERNAME,\Core\Core::PASSWORD);
R::setup('mysql:host=localhost;dbname=sanofi_vf2','usersio','pwsio');


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


    //insert employees
    for($i=0; $i<200; $i++) {

        $employee = R::dispense('employee');
        $employee->city = $faker->city . $faker->citySuffix;
        $employee->name = $faker->lastName;
        $employee->firstname = $faker->firstName;
        $employee->street_address = $faker->randomNumber() . ' ' . $faker->streetName;
        $employee->postal_code = $faker->postcode;
        $employee->birthdate = $faker->date('Y-m-d');
        $employee->appli_pw = sha1('pw'.$employee->name);
        $name = str_replace(' ', '', $employee->name);
        $employee->email = $name .'.'. $employee->firstname[0] .'@'. $faker->freeEmailDomain;
        $employee->cellphone = $faker->phoneNumber;
        R::store($employee);



        //insert absences random employee.id 1/5
        $randomEmployee = rand(0,5);

        if($randomEmployee == 1){
            for ($y = 0; $y < $randomEmployee; $y++) {

                $absence = R::dispense('absence');
                $absence->start_date = $faker->dateTime();
                $absence->end_date = $faker->dateTimeBetween($absence->start_date, 'now');
                $absence->absence_pattern = $faker->randomElement(['Mon réveil n’a pas sonné', 'Raisons personnelles', 'Rendez-vous extérieur', 'Raisons personnelles',
                    'Raisons de santé', 'Décès', 'Problèmes liés à une grève', 'Mon enfant est malade', 'Ma voiture ne démarre pas', 'Aucun motif', 'Problèmes de transport', 'Action commerciale']);
                $absence->type = $faker->randomElement(['Maladie', 'RTT', 'Congé']);
                $absence->employee = $employee;
                R::store($absence);
            }
        }



        //insert formations random employee.id 2/5
        if($randomEmployee==2 or $randomEmployee==4) {
            for ($y = 0; $y < $randomEmployee; $y++) {

                $formation = R::dispense('formation');
                $formation->formation_libelle = $faker->randomElement(['PHP', 'jQuery', 'C#', 'AngularJS', 'Slim Framework', 'RedBeanPHP', 'GitHub', 'Moodle', 'Pachagiste', 'Java', 'PhpStorm', 'Atom']);
                $formation->date = $faker->date('Y-m-d');
                //$formation->formation_id = $faker->randomElement(['', $formation]);
                R::store($formation);


                //RANDOM FORMATION.id
                $randomFormation = rand(0,5);
                if ($randomFormation == 1) {
                    for ($y = 0; $y < $randomFormation; $y++) {
                        $participate = R::dispense('participate');
                        $participate->employee = $employee;
                        $participate->formation = $formation;
                        R::store($participate);
                    }
                }
            }
        }


                //insert career at all employees
                $career = R::dispense('career');
                $career->employee = $employee;
                R::store($career);


                $post = R::dispense('post');
                $post->post_libelle = $faker->randomElement(['Practicien', 'Visiteur Médical', 'Chef de Secteur', 'Délégué Régional']);
                $post->mission = $faker->realText(30);
                $post->career = $career;
                R::store($career);


                $salary = R::dispense('salary');
                $salary->amount = $faker->randomFloat(2, 1111, 4251);
                $salary->post = $post;
                $salary->employee = $employee;
                R::store($salary);



                //insert hiring date for all employees and 1/5 of termination, retirement, departure
                $enterexit = R::dispense('enterexit');
                $enterexit->hiring_date = $faker->dateTime();
                $enterexit->employee = $employee;
                $enterexit->post_id = $post;
                R::store($enterexit);


                //RANDOM ENTEREXIT.id 1/10
                $randomEnterExit = rand(0, 10);
                if ($randomEnterExit == 1) {
                    for ($y = 0; $y < $randomEnterExit; $y++) {

                        $termination = R::dispense('termination');
                        $termination->termination_date = $faker->dateTimeBetween($enterexit->hiring_date, 'now');
                        $termination->enterexit = $enterexit;
                        R::store($termination);
                    }
                }
                if ($randomEnterExit == 3) {
                    for ($y = 0; $y < $randomEnterExit; $y++) {

                        $retirement = R::dispense('retirement');
                        $retirement->retirement_date = $faker->dateTimeBetween($enterexit->hiring_date, 'now');
                        $retirement->enterexit = $enterexit;
                        R::store($retirement);
                    }
                }
                if ($randomEnterExit == 5) {
                    for ($y = 0; $y < $randomEnterExit; $y++) {
                        $departure = R::dispense('departure');
                        $departure->departure_date = $faker->dateTimeBetween($enterexit->hiring_date, 'now');
                        $departure->enterexit = $enterexit;
                        R::store($departure);
                    }
                }



        //Add bounty for 1/5 of employees
        if($randomEmployee == 3){
            for ($y = 0; $y < $randomEmployee; $y++) {

                $bounty = R::dispense('bounty');
                $bounty->amount = $faker->randomFloat(2, 100, 2000);
                $bounty->date = $faker->dateTime('now');
                $bounty->salary = $salary;
                R::store($bounty);
            }
        }




    }



});


$app->run();

