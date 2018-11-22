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
        $formation = R::findAll('FORMATION');
        return $response->withJson(['data'=>$formation]);
    }



    public static function getFormationId($request, $response, $args){
        $formation = R::findOne('FORMATION', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationDate($request, $response, $args){
        $formation = R::findall('FORMATION', 'date= ?', [$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationEmployee($request, $response, $args){
        $formation = R::findall('FORMATION', 'employee_id= ?', [$args['employee_id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationEmployeeDate($request, $response, $args){
        $formation = R::findall('FORMATION', ['employee_id= ?', 'date= ?'], [$args['employee_id'],$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }


}