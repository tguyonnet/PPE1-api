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
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceDate($request, $response, $args){
        $absence = R::findAll('absence', 'start_date<=? and end_date>=?', [$args['date'], $args['date']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceEmployee_id($request, $response, $args){
        $absence = R::findAll('absence', 'employee_id=?', [$args['employee_id']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceEmployee_idDate($request, $response, $args){
        $absence = R::findAll('absence', 'start_date<=? and end_date>=? and employee_id=?', [$args['date'], $args['date'], $args['employee_id']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceEmployee_idType($request, $response, $args){
        $absence = R::findAll('absence', 'employee_id=? and type=?', [$args['employee_id'], $args['type']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceEmployee_idTypeDate($request, $response, $args){
        $absence = R::findAll('absence', 'start_date<=? and end_date>=? and employee_id=? and type=?', [$args['date'], $args['date'], $args['employee_id'], $args['type']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getAbsenceType($request, $response, $args){
        $absence = R::findAll('absence', 'type=?', [$args['type']]);
        return $response->withJson(['data'=>$absence]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     */
    public static function updateAbsence($request, $response, $args){
        $absence = R::dispense('absence');
        $absence->id = $args['id'];
        $absence->start_date = $args['start_date'];
        $absence->end_date = $args['end_date'];
        $absence->absence_pattern = $args['absence_pattern'];
        $absence->type  = $args['type'];
        $absence->employee_id  = $args['employee_id'];
        R::store($absence);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     */
    public static function delAbsence($request, $response, $args){
        $absence = R::findOne('absence', 'id=?', array($args['id']));
        R::trash($absence);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     */
    public static function addAbsence($request, $response, $args){
        $absence = R::dispense('absence');
        $absence->start_date = $args['start_date'];
        $absence->end_date = $args['end_date'];
        $absence->absence_pattern = $args['absence_pattern'];
        $absence->type  = $args['type'];
        $absence->employee_id  = $args['employee_id'];
        R::store($absence);
    }









}