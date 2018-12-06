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
    public static function getAllVisitorReports($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getOneVisitorReport($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }
}
