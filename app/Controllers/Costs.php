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
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getCostsVisitorPerDay($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getCostsVisitorPerMonth($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    //Méthodes Hors Forfait

    /*public static function postOutPackageCost($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function putOutPackageCost($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function deleteOutPackageCost($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }
*/
    //Méthodes Forfaitaires VR (Valentin)

    public static function deletePackageCostVR($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function putPackageCostVR($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function postPackageCostVR($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
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

}
