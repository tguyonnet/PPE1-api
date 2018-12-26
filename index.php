<?php

chdir(__DIR__);

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;



//R::setup('mysql:host='.\Config\Bdd::HOST.';dbname='.\Config\Bdd::DBNAME.'',\Config\Bdd::USERNAME,\Config\Bdd::PASSWORD);
R::setup('mysql:host=localhost;dbname=sanofi_vf','usersio','pwsio');



$dataGenerator = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

/**
 * Routes a propos des employées
 */
$app->get('/employee/{id}', \Controllers\Employee::class . ':getEmployee');
$app->get('/employee/{email}/{appli_pw}', \Controllers\Employee::class . ':getEmployeeId');


/**
 * Routes a propos des formations.
 */
$app->get('/formation', \Controllers\Formation::class . ':getFormation');
$app->get('/formation/{id}', \Controllers\Formation::class . ':getFormationId');
$app->get('/formation/date/{date}', \Controllers\Formation::class . ':getFormationDate');
$app->get('/formation/employee/{employee_id}', \Controllers\Formation::class . ':getFormationEmployee');
$app->get('/formation/employee/{employee_id}/{date}', \Controllers\Formation::class . ':getFormationEmployeeDate');


/**
 * Routes a propos de la carriere.
 */
$app->get('/career/{employee_id}/post', \Controllers\Career::class . ':getCareerEmployeePost');
$app->get('/career/{employee_id}/post/{post_id}', \Controllers\Career::class . ':getCareerEmployeePostDetails');


/**
 * Routes a propos des absences.
 */
$app->get('/absence/date/{date}', \Controllers\Absence::class . ':getAbsenceDate');
$app->get('/absence/employee/{employee_id}', \Controllers\Absence::class . ':getAbsenceEmployee_id');
$app->get('/absence/employee/{employee_id}/date/{date}', \Controllers\Absence::class . ':getAbsenceEmployee_idDate');
$app->get('/absence/employee/{employee_id}/type/{type}', \Controllers\Absence::class . ':getAbsenceEmployee_idType');
$app->get('/absence/employee/{employee_id}/type/{type}/date/{date}', \Controllers\Absence::class . ':getAbsenceEmployee_idTypeDate');
$app->get('/absence/type/{type}', \Controllers\Absence::class . ':getAbsenceType');








////ROUTE VALENTIN

$app->get('/Costs/{employee_id)/one/{frais_id}',\Controllers\Costs::class . ':getCost_idCost');
$app->get('/Costs/{employee_id)/allDay/{date}',\Controllers\Costs::class . ':getCostsVisitorPerDay');
$app->get('/Costs/{employee_id)/allMonth/{date}',\Controllers\Costs::class . ':getCostsVisitorPerMonth');

$app->get('/Report/{employee_id)/all',\Controllers\Report::class . ':getAllVisitorReports');
$app->get('/Report/{employee_id)/one/{report_id}',\Controllers\Report::class . ':getOneVisitorReport');





//A REVOIR
//$app->get('/VisitReport/{employee_id)/one/{month}',\Controllers\Report::class . ':getReportCardsPerMonth');
//

$app->get('/praticioner/outPackageCosts/{employee_id}/create/{date_cost}/{amount}/{description}/{cost_description}/{cost_amount}/{image_bill}',\Controllers\Costs::class . ':postOutPackageCostV');
$app->get('/praticioner/outPackageCosts/{employee_id}/modify/{date_cost}/{amount}/{description}/{cost_description}/{cost_amount}/{image_bill}',\Controllers\Costs::class . ':putOutPackageCostV');
$app->get('/praticioner/outPackageCosts/delete/{outPackageCosts_id}',\Controllers\Costs::class . ':deleteOutPackageCost');


$app->get('/praticioner/packageCosts/{employee_id}/create/{date_cost}/{cost_description}/{cost_amount}/{visitorReport_id}',\Controllers\Costs::class . ':postPackageCostVR');
$app->get('/praticioner/packageCosts/{employee_id}/modify/{date_cost}/{cost_description}/{cost_amount}/{visitorReport_id}',\Controllers\Costs::class . ':putPackageCostVR');
$app->get('/praticioner/packageCosts/{employee_id}/delete/{flatCosts_id}',\Controllers\Costs::class . ':deletePackageCostVR');

//ROUTE PAUL

//Frais Forfaitise
$app->get('visiteur/packageCosts/all',\Controllers\Costs::class . ':getPackageCost');
$app->get('/visiteur/packageCosts/{employee_id}/modify/{cost_id}',\Controllers\Costs::class . ':putPackageCost');
$app->get('/visiteur/packageCosts/{employee_id}/create/{cost_id}',\Controllers\Costs::class . ':postPackageCost');
$app->get('/visiteur/packageCosts/{employee_id}/delete/{package_id}',\Controllers\Costs::class . ':deletePackageCost');


//Frais manuel
$app->get('/visiteur/outPackageCosts/all',\Controllers\Costs::class . ':getOutPackageCost');


//liste une fiche frais
$app->get('/visiteur/expenseAccount/{id_expenseAccount}',\Controllers\ExpenseAccount::class . ':getExpenseAccount');

//liste parametre
$app->get('/visiteur/parameter/all',\Controllers\Parameter::class . ':getParameter');
$app->get('/visiteur/parameter/{id_parameter}',\Controllers\Parameter::class . ':getOneParameter');

//fiche frais archivé
$app->get('/visiteur/status/archive',\Controllers\Status::class . ':getStatusArchive');
$app->get('/visiteur/status/paiement',\Controllers\Status::class . ':getStatusPaiement');





$app->run();

