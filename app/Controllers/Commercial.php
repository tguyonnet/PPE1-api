<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 14/11/18
 * Time: 20:15
 * COMMERCIAL
 */

namespace Controllers;

use RedBeanPHP\R;


class Commercial
{

    public static function getCommercial($request, $response, $args){
        $commercial = R::findAll('COMMERCIAL');
        return $response->withJson(['data'=>$commercial]);
    }


    public static function getCommercialById($request, $response, $args){
        $commercial = R::findOne('COMMERCIAL', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$commercial]);
    }

}