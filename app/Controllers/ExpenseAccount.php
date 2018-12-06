<?php

namespace Controllers;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class ExpenseAccount {

    public static function getExpenseAccount($request, $response, $args){
        $commande = R::store('expenseAccount','id=?',[$args["id_expenseAccount"]]);
        return $response->withJson(['data'=>$commande]);
    }

}