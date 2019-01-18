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
     * obtenir tous les postes d'un employée
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getCareerEmployeePost($request, $response, $args){
        $career = R::findOne('career', 'employee_id=?', [$args['employee_id']]);
        $posts = R::findAll('post', 'career_id='.$career->getID());
        return $response->withJson($posts);
    }


    /**
     * obtenir tous les détails d'un poste d'un employée
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

        $Post = ['post_libelle' => $post['post_libelle'], 'mission' => $post['mission'], 'salary'=>$salary['amount'] , 'hiring_date'=>$hiringDate['hiring_date'],
            'bounty'=>$bounty , 'termination'=>$termination['termination_date'] , 'retirement'=>$retirement['retirement_date'] , 'departure'=>$departure['departure_date']];
        return $response->withJson(['data'=>$Post]);
    }

    /**
     * Ajouter un poste
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function addPost($request, $response, $args){
        $career = R::findOne('career', 'employee_id=?', [$args['employee_id']]);

        $post = R::dispense('post');
        $post->post_libelle = $args['libelle'];
        $post->mission = $args['mission'];
        $post->career_id = $career->getID();
        R::store($post);

        $salary = R::dispense('salary');
        $salary->amount = $args['salary_amount'];
        $salary->post = $post;
        $salary->employee_id = $args['employee_id'];
        R::store($salary);


    }



}