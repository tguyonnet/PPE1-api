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
        $absence = R::findAll('absence', 'start_date<=? and end_date>=?', [$args['date'], $args['date']]);
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_id($request, $response, $args){
        $absence = R::findAll('absence', 'employee_id=?', [$args['employee_id']]);
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idDate($request, $response, $args){
        $absence = R::findAll('absence', 'start_date<=? and end_date>=? and employee_id=?', [$args['date'], $args['date'], $args['employee_id']]);
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idType($request, $response, $args){
        $absence = R::findAll('absence', 'employee_id=? and type=?', [$args['employee_id'], $args['type']]);
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idTypeDate($request, $response, $args){
        $absence = R::findAll('absence', 'start_date<=? and end_date>=? and employee_id=? and type=?', [$args['date'], $args['date'], $args['employee_id'], $args['type']]);
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceType($request, $response, $args){
        $absence = R::findAll('absence', 'type=?', [$args['type']]);
        return $response->withJson(['data'=>$absence]);
    }






}