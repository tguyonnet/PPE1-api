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


class Absence
{
    public static function getAbsenceDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_id($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idDisease($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idRtt($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idFurlough($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }




    public static function getAbsenceEmployee_idDiseaseDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idRttDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceEmployee_idFurloughDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }



    public static function getAbsenceDiseaseDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceRttDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }

    public static function getAbsenceFurloughDate($request, $response, $args){
        $absence = R::findAll('Absence');
        return $response->withJson(['data'=>$absence]);
    }




}