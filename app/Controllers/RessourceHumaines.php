<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:08
 * RESSOURCEHUMAINES
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;


class RessourceHumaines
{

    public static function getRessourceHumaines($request, $response, $args){
        $ressourceHumaines = R::findAll('RESSOURCEHUMAINES');
        return $response->withJson(['data'=>$ressourceHumaines]);
    }


    public static function getRessourceHumainesById($request, $response, $args){
        $ressourceHumaines = R::findOne('RESSOURCEHUMAINES', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$ressourceHumaines]);
    }

}