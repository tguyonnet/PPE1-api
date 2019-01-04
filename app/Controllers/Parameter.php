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


class Parameter {
    public static function getParameter($request, $response, $args){
        $commande = R::findAll('Parameters');
        return $response->withJson(['data'=>$commande]);
    }

    public static function getOneParameter($request, $response, $args){
        $commande = R::store('Parameter','id=?',[$args["id_parameter"]]);
        return $response->withJson(['data'=>$commande]);
    }
}