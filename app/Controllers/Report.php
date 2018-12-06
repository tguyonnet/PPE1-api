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


class Report
{
    //Méthodes générales

    public static function getAllVisitorReports($request, $response, $args){

        $allReport = R::findAll('visit','employee_id = ?', [$args['employee_id']]);

        return $response->withJson(['data'=>$allReport]);
    }

    public static function getOneVisitorReport($request, $response, $args){
        $report = R::findOne('visit','id =?',[$args['report_id']],'employee_id=?',[$args['employee_id']]);
        return $response->withJson(['data'=>$report]);
    }
}
