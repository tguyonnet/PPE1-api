<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:03
 */


namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class VisitorMedical{

    public static function getVisiteurMedical($request, $response, $args){
        $visiteurMedical = R::findAll('VISITEURMEDICAL');
        return $response->withJson(['data'=>$visiteurMedical]);
    }


    public static function getVisiteurMedicalById($request, $response, $args){
        $visiteurMedical = R::findOne('VISITEURMEDICAL', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$visiteurMedical]);
    }




}