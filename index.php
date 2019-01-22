<?php

chdir(__DIR__);

require './vendor/autoload.php';


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \RedBeanPHP\R as R;




//R::setup('mysql:host='.\Core\Core::HOST.';dbname='.\Core\Core::DBNAME.'',\Core\Core::USERNAME,\Core\Core::PASSWORD);
R::setup('mysql:host=localhost;dbname=sanofi_vf','usersio', 'pwsio');


$dataGenerator = Faker\Factory::create('fr_FR');


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

/**
 * Accueil
 */
$app->get('/', function ($request, $response, $args) {
    return 'Bienvenue sur l\'API du PPE1';
});
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

$app->get('/formation/add/{employee_id}/{formation_id}', \Controllers\Formation::class . ':addFormation');
$app->get('/formation/update/{id}/{employee_id}/{formation_id}', \Controllers\Formation::class . ':updateFormation');
$app->get('/formation/delete/{employee_id}/{formation_id}', \Controllers\Formation::class . ':delFormation');


/**
 * Routes a propos de la carriere.
 */
$app->get('/career/{employee_id}/post', \Controllers\Career::class . ':getCareerEmployeePost');
$app->get('/career/{employee_id}/post/{post_id}', \Controllers\Career::class . ':getCareerEmployeePostDetails');
$app->get('/career/post/update/{employee_id}/{post_id}/{libelle}/{mission}/{salary_amount}', \Controllers\Career::class . ':updatePost');


/**
 * Routes a propos des absences.
 */
$app->get('/absence/date/{date}', \Controllers\Absence::class . ':getAbsenceDate');
$app->get('/absence/employee/{employee_id}', \Controllers\Absence::class . ':getAbsenceEmployee_id');
$app->get('/absence/employee/{employee_id}/date/{date}', \Controllers\Absence::class . ':getAbsenceEmployee_idDate');
$app->get('/absence/employee/{employee_id}/type/{type}', \Controllers\Absence::class . ':getAbsenceEmployee_idType');
$app->get('/absence/employee/{employee_id}/type/{type}/date/{date}', \Controllers\Absence::class . ':getAbsenceEmployee_idTypeDate');
$app->get('/absence/type/{type}', \Controllers\Absence::class . ':getAbsenceType');

$app->get('/absence/update/{id}/{start_date}/{end_date}/{absence_pattern}/{type}/{employee_id}', \Controllers\Absence::class . ':updateAbsence');
$app->get('/absence/add/{start_date}/{end_date}/{absence_pattern}/{type}/{employee_id}', \Controllers\Absence::class . ':addAbsence');
$app->get('/absence/delete/{id}', \Controllers\Absence::class . ':delAbsence');







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
$app->get('/visiteur/cost/{id}',\Controllers\Costs::class . ':getOneCost');
$app->get('/visiteur/cost/{id}/visiteurid',\Controllers\Costs::class . ':getOneCostVisiteurId');
$app->get('/visiteur/{cost_id}',\Controllers\VisitorMedical::class . ':getEmployeeWithCost');


//liste une fiche frais
$app->get('/visiteur/expenseAccount/{id_expenseAccount}',\Controllers\ExpenseAccount::class . ':getExpenseAccount');

//liste parametre
$app->get('/visiteur/parameter/all',\Controllers\Parameter::class . ':getParameter');
$app->get('/visiteur/parameter/{id_parameter}',\Controllers\Parameter::class . ':getOneParameter');

//fiche frais archivé
$app->get('/visiteur/status/archive',\Controllers\Status::class . ':getStatusArchive');
$app->get('/visiteur/status/paiement',\Controllers\Status::class . ':getStatusPaiement');





$app->run();

