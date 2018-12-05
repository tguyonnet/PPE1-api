<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 22/11/18
 * Time: 13:36
 */

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Career
{

    public static function getCareerEmployeePost($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostMission($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostSalary($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostBounty($request, $response, $args){
            $career = R::findAll('career');
            return $response->withJson(['data'=>$career]);
    }




    public static function getCareerEmployeePostHiringDate($request, $response, $args){
            $career = R::findAll('career');
            return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostTermination($request, $response, $args){
            $career = R::findAll('career');
            return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostRetirement($request, $response, $args){
            $career = R::findAll('career');
            return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostResignation($request, $response, $args){
            $career = R::findAll('career');
            return $response->withJson(['data'=>$career]);
    }




    public static function getCareerEmployeePostDate($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostMissionDate($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostSalaryDate($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

    public static function getCareerEmployeePostBountyDate($request, $response, $args){
        $career = R::findAll('career');
        return $response->withJson(['data'=>$career]);
    }

}