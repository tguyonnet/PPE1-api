<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:11
 * RESPONSABLESECTEUR
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;


class ResponsableSecteur
{

    public static function getResponsableSecteur($request, $response, $args){
        $responsableSecteur = R::findAll('RESPONSABLESECTEUR');
        return $response->withJson(['data'=>$responsableSecteur]);
    }


    public static function getResponsableSecteurById($request, $response, $args){
        $responsableSecteur = R::findOne('RESPONSABLESECTEUR', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$responsableSecteur]);
    }

}