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


    public static function getFormationById($request, $response, $args){
        $formation = R::findOne('FORMATION', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationByDate($request, $response, $args){
        $formation = R::findall('FORMATION', 'date= ?', [$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationByEmploye_id($request, $response, $args){
        $formation = R::findall('FORMATION', 'employe_id= ?', [$args['employe_id']]);
        return $response->withJson(['data'=>$formation]);
    }

    public static function getFormationByEmploye_idAndDate($request, $response, $args){
        $formation = R::findall('FORMATION', ['employe_id= ?', 'date= ?'], [$args['employe_id'],$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }


}