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
        $career = R::findOne('career', 'employee_id=?', [$args['employee_id']]);
        $post = R::findAll('post', 'career_id='.$career->getID());
        return $response->withJson(['data'=>$post]);
    }

    public static function getCareerEmployeePostSalary($request, $response, $args){
        $salary = R::findOne('salary', 'post_id=? and employee_id=?', [$args['post_id'],$args['employee_id']]);
        return $response->withJson(['data'=>$salary]);
    }


    public static function getCareerEmployeePostBounty($request, $response, $args){
        $salary = R::findOne('salary', 'post_id=? and employee_id=?', [$args['post_id'],$args['employee_id']]);
        $bounty = R::findAll('bounty', 'salary_id='.$salary->getID());
        return $response->withJson(['data'=>$bounty]);
    }


    public static function getCareerEmployeePostHiringDate($request, $response, $args){
        $hiringDate = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);
        return $response->withJson(['data'=>$hiringDate]);
    }

    public static function getCareerEmployeePostTermination($request, $response, $args){
        $enterexit = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);
        $termination = R::findAll('termination', 'enterexit_id='. $enterexit->getID());
        return $response->withJson(['data'=>$termination]);
    }

    public static function getCareerEmployeePostRetirement($request, $response, $args){
        $enterexit = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);
        $retirement = R::findAll('retirement', 'enterexit_id='. $enterexit->getID());
        return $response->withJson(['data'=>$retirement]);
    }

    public static function getCareerEmployeePostDeparture($request, $response, $args){
        $enterexit = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);
        $departure = R::findAll('departure', 'enterexit_id='. $enterexit->getID());
        return $response->withJson(['data'=>$departure]);
    }




//    public static function getCareerEmployeePostDate($request, $response, $args){
//        $career = R::findAll('career');
//        return $response->withJson(['data'=>$career]);
//    }
//
//    public static function getCareerEmployeePostMissionDate($request, $response, $args){
//        $career = R::findAll('career');
//        return $response->withJson(['data'=>$career]);
//    }
//
//    public static function getCareerEmployeePostSalaryDate($request, $response, $args){
//        $career = R::findAll('career');
//        return $response->withJson(['data'=>$career]);
//    }
//
//    public static function getCareerEmployeePostBountyDate($request, $response, $args){
//        $career = R::findAll('career');
//        return $response->withJson(['data'=>$career]);
//    }

}