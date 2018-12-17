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

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getCareerEmployeePost($request, $response, $args){
        $career = R::findOne('career', 'employee_id=?', [$args['employee_id']]);
        $post = R::findAll('post', 'career_id='.$career->getID());
        return $response->withJson(['data'=>$post]);
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getCareerEmployeePostDetails($request, $response, $args){
        $post = R::findOne('post', 'id=?', [$args['post_id']]);
        $salary = R::findOne('salary', 'post_id=? and employee_id=?', [$args['post_id'],$args['employee_id']]);
        $bounty = R::findAll('bounty', 'salary_id='.$salary->getID());
        $hiringDate = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);

        $enterexit = R::findOne('enterexit', 'employee_id=?', [$args['employee_id']]);
        $termination = R::findOne('termination', 'enterexit_id='. $enterexit->getID());
        $retirement = R::findOne('retirement', 'enterexit_id='. $enterexit->getID());
        $departure = R::findOne('departure', 'enterexit_id='. $enterexit->getID());


        if ($bounty != null){
            $respdsqonse = array($post, $salary, $hiringDate, $bounty, $termination, $retirement, $departure);
        }else{
            $respdsqonse = array($post, $salary, $hiringDate, null, $termination, $retirement, $departure);
        }

        return $response->withJson(['data'=>$respdsqonse]);
    }



}