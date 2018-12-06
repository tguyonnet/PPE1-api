<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:14
 * PRATICIEN
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Praticien
{

    public static function getPraticien($request, $response, $args){
        $praticien = R::findAll('PRATICIEN');
        return $response->withJson(['data'=>$praticien]);
    }


    public static function getPraticienById($request, $response, $args){
        $praticien = R::findOne('PRATICIEN', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$praticien]);
    }

}