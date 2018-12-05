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


class Absence
{
    public static function getAbsenceDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_id($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idType($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idTypeDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }






}