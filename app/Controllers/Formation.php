<?php
/**
 * Created by PhpStorm.
 * User: usersio
 * Date: 17/11/18
 * Time: 14:31
 */

namespace Controllers;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Formation
{
    /**
     * trouver toutes les formations
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getFormation($request, $response, $args){
        $formation = R::findAll('formation');
        return $response->withJson(['data'=>$formation]);
    }

    /**
     * trouver une formation a partir de son id
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getFormationId($request, $response, $args){
        $formation = R::findOne('formation', 'id= ?', [$args['id']]);
        return $response->withJson(['data'=>$formation]);
    }

    /**
     * donne toutes les formations depuis x date
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getFormationDate($request, $response, $args){
        $formation = R::findall('formation', 'date>= ? ORDER BY date ASC', [$args['date']]);
        return $response->withJson(['data'=>$formation]);
    }

    /**
     * donne toutes les formtaitons de x employee
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getFormationEmployee($request, $response, $args){
        $formation = R::getAll(
            'SELECT formation.id, date, formation_libelle FROM `participate`, formation
                where participate.formation_id = formation.id
                and employee_id = ? ', [$args['employee_id']]);
        return $response->withJson(['data'=>$formation]);
    }

    /**
     * Donne les formation d'un employée a partir de x date
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function getFormationEmployeeDate($request, $response, $args){

        $participate = R::getAll(
            "SELECT * FROM `formation`, participate".
                " WHERE participate.formation_id = formation.id".
                " and participate.employee_id =".$args['employee_id'].
                " and formation.date>=".$args['date']);
        return $response->withJson(['data'=>$participate]);
    }

    /**
     * Ajouter une participation a une formation
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function addFormation($request, $response, $args){
        $participate = R::dispense('participate');
        $participate->employee_id = $args['employee_id'];
        $participate->formation_id = $args['formation_id'];
        R::store($participate);
    }

    /**
     * modifier une participation a une formation
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public static function updateFormation($request, $response, $args)
    {
        $participate = R::dispense('participate');
        $participate->id = $args['id'];
        $participate->employee_id = $args['employee_id'];
        $participate->formation_id = $args['formation_id'];
        R::store($participate);
    }

    /**
     * Supprimer une participation a une formation
     * @param $request
     * @param $response
     * @param $args
     */
    public static function delFormation($request, $response, $args){
        $participate = R::findOne('participate', 'employee_id=? and formation_id=?', array($args['employee_id'],$args['formation_id']));
        R::trash($participate);
    }



}