<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 22/11/18
 * Time: 14:01
 */

namespace Controllers;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;


class Costs
{
    //Méthodes générales
    public static function getCost_idCost($request, $response, $args){
        $cost = R::findOne('cost', 'id= ?', [$args['employee_id']]);
        return $response->withJson(['data'=>$cost]);
    }

    public static function getCostsVisitorPerDay($request, $response, $args){
        $visiteur_id = [$args['employee_id']];
        $date = [$args['date']];

        $cost = R::exec("SELECT cost.id,cost.date_cost,cost.amount_total,cost.description,cost.expenseaccount FROM cost,expenseaccount WHERE cost.cost_date = '$date'
                         and cost.expenseaccount_id = expenseaccount.id
                         and expenseaccount.visiteur_medical_id = visiteurmedical.id
                         and visiteurmedical.id = '$visiteur_id'");

        return $response->withJson(['data'=>$cost]);
    }

    public static function getCostsVisitorPerMonth($request, $response, $args)
    {
        $month = substr([$args['date']], 3,2);
        $year = substr([$args['date']], 0,2);
        $visiteur_id = [$args['employee_id']];

        $cost = R::exec("SELECT cost.id,cost.date_cost,cost.amount_total,cost.description,cost.expenseaccount FROM cost,expenseaccount,visitormedical WHERE MONTH(cost.cost_date) = '$month' and YEAR(cost.cost_date) = '$year' 
                         and cost.expenseaccount_id = expenseaccount.id
                         and expenseaccount.visiteur_medical_id = visitormedical.id
                         and visitormedical.id = '$visiteur_id'");
        return $response->withJson(['data' => $cost]);
    }

    //Méthodes Hors Forfait

    public static function postOutPackageCostV($request, $response, $args){

        $expAccount = R::findOne('expenseaccount','visiteur_medical_id=?',$args['employee_id']);

        $cost = R::dispense('cost');

        $cost->date_cost = [$args['date_cost']];
        $cost->amount_total = [$args['amount']];
        $cost->description = [$args['description']];
        $cost->expenseaccount_id = $expAccount['id'];

        $costOut = R::dispense('outpackage');

        $costOut->picture_cost = [$args['image_bill']];
        $costOut->supplier_cost_out_package = [$args['cost_amount']];
        $costOut->cost_id = R::store($cost);

        $id = store($costOut);
        return $response->withJson(['data'=>$id]);
    }


    public static function putOutPackageCostV($request, $response, $args){

        $expAccount = R::findOne('expenseaccount','visiteur_medical_id=?',[$args['employee_id']]);

        $cost = R::findOne('cost','expenseaccount_id=?',$expAccount['id']);

        $cost->date_cost = [$args['date_cost']];
        $cost->amount_total = [$args['amount']];
        $cost->description = [$args['description']];
        $cost->expenseaccount_id = $expAccount['id'];

        $costOut = R::findOne('outpackage','cost_id=?',$cost['id']);

        $costOut->picture_cost = [$args['image_bill']];
        $costOut->supplier_cost_out_package = [$args['cost_amount']];
        $costOut->cost_id = R::store($cost);

        $id = store($costOut);

        return $response->withJson(['data'=>$id]);
    }

    public static function deleteOutPackageCost($request, $response, $args){
        $costOut = R::findOne('outpackage','id',$args['outPackageCosts_id']);
        $cost = R::findOne('cost','id=?',$costOut['cost_id']);

        R::trash($costOut);
        return $response->withJson(R::trash($cost));
    }

    //Méthodes Forfaitaires VR (Valentin)

    public static function deletePackageCostVR($request, $response, $args){
        $costPackage = R::findOne('package','id',$args['flatCosts_id']);
        $cost = R::findOne('cost','id=?',$costPackage['cost_id']);

        R::trash($costPackage);
        return $response->withJson(R::trash($cost));
    }
    //TODO MODIFIER LA BDD ET INVERSER LA LISAISON PACKAGE/VISITREPORT -> IL FAUT UN VISITREPORT_ID DANS PACKAGE
    public static function putPackageCostVR($request, $response, $args){

        $expAccount = R::findOne('expenseaccount','visiteur_medical_id=?',[$args['employee_id']]);

        $cost = R::findOne('cost','expenseaccount_id=?',$expAccount['id']);

        $cost->date_cost = [$args['date_cost']];
        $cost->amount_total = [$args['cost_amount']];
        $cost->description = [$args['cost_description']];
        $cost->expenseaccount_id = $expAccount['id'];

        $costPackage = R::findOne('package','cost_id=?',$cost['id']);
        $visit_report = R::findOne('visitreport','package_id=?',$costPackage['id']);

        $visit_report->visit_report_id = [$args['visitReport_id']];
        $costPackage->cost_id = R::store($cost);

        $id = store($costPackage);

        return $response->withJson(['data'=>$id]);
    }

    public static function postPackageCostVR($request, $response, $args){
        //praticioner/packageCosts/{employee_id}/create/{date_cost}/{cost_description}/{cost_amount}/{visitorReport_id}
        $expAccount = R::findOne('expenseaccount','visiteur_medical_id=?',$args['employee_id']);

        $cost = R::dispense('cost');

        $cost->date_cost = [$args['date_cost']];
        $cost->amount_total = [$args['cost_amount']];
        $cost->description = [$args['cost_description']];
        $cost->expenseaccount_id = $expAccount['id'];

        $costPackage = R::dispense('package');
        $costPackage->visit_report_id = [$args['visitorReport_id']];

        $costPackage->cost_id = R::store($cost);

        $id = store($costPackage);
        return $response->withJson(['data'=>$id]);
    }

    //Methode Forfaitise (Paul)

    public static function getPackageCost($request, $response, $args){
        $commande = R::getAll("package");
        return $response->withJson(['data'=>$commande]);
    }

    public static function putPackageCost($request, $response, $args){
        $commande = R::store("package","id=? 
            and cost_id=?",[$args['id_package'],$args['cost_id']]);
        return $response->withJson(['data'=>$commande]);
    }

    public static function postPackageCost($request, $response, $args){
        $commande = R::store("package","cost_id=?",[$args['cost_id']]);
        return $response->withJson(['data'=>$commande]);
    }

    public static function deletePackageCost($request, $response, $args){
        $commande = R::trash("package","id=?",[$args['package_id']]);
        return $response->withJson(['data'=>$commande]);
    }


    //Methode non forfaitise (Paul)

    public static function getOutPackageCost($request, $response, $args){
        $commande = R::getAll("Out_package");
        return $response->withJson(['data'=>$commande]);
    }

    public static function putOutPackageCost($request, $response, $args){
        $commande = R::store("Out_package","id=? 
            and cost_id=?",[$args['id_package'],$args['cost_id']]);
        return $response->withJson(['data'=>$commande]);
    }
    
        public static function getOneCost($request, $response, $args){
        $commande = R::getAll("SELECT * FROM cost WHERE id=?",[$args['id']]);
        return $response->withJson(['data'=>$commande]);
    }

    public static function getOneCostVisiteurId($request, $response, $args){
        $commande = R::getAll("SELECT visiteur_medical_id FROM cost,expenseaccount WHERE cost.expenseaccount_id=expenseaccount.id AND cost.expenseaccount_id=?",[$args['id']]);
        return $response->withJson(['data'=>$commande]);
    }

}
