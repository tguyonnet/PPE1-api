<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:12
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;


class Medecin
{

    public static function getMedecin($request, $response, $args){
        $medecin = R::findAll('MEDECIN');
        return $response->withJson(['data'=>$medecin]);
    }


    public static function getMedecinById($request, $response, $args){
        $medecin = R::findOne('MEDECIN', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$medecin]);
    }



}