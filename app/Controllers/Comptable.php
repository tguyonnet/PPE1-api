<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:13
 */

namespace Controllers;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;


class Comptable
{

    public static function getComptable($request, $response, $args){
        $comptable = R::findAll('COMPTABLE');
        return $response->withJson(['data'=>$comptable]);
    }


    public static function getComptableById($request, $response, $args){
        $comptable = R::findOne('COMPTABLE', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$comptable]);
    }
}