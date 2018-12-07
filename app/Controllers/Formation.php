<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 17/11/18
 * Time: 14:31
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Formation
{

    public static function getFormation($request, $response, $args){
        $formation = R::findAll('formation');
        return $response->withJson(['data'=>$formation]);
    }



    public static function getFormationId($request, $response, $args){
        $formation = R::findOne('formation', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationDate($request, $response, $args){
        $formation = R::findall('formation', 'date= ?', [$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationEmployee($request, $response, $args){
        $formation = R::findall('participate', 'employee_id= ?', [$args['employee_id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationEmployeeDate($request, $response, $args){

        $participate = R::getAll(
            "SELECT * FROM `formation`, participate".
                " WHERE participate.formation_id = formation.id".
                " and participate.employee_id =".$args['employee_id'].
                " and formation.date>=".$args['date']
                        );
        return $response->withJson(['data'=>$participate]);
    }


}