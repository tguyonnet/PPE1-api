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


class Employee
{
    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getEmployee($request, $response, $args){
        $employee = R::findAll('employee', 'id=?', [$args['id']]);
        return $response->withJson(['data'=>$employee]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     */
    public static function getEmployeeId($request, $response, $args){
        $result=null;
        $employee = R::findOne('employee', 'email=? and appli_pw=?', [$args['email'], sha1($args['appli_pw'])]);
        if ($employee) {
            $result=$employee->getID();
        }
        return $response->withJson(['data'=>$result]);
    }



}