<?php

namespace Controllers;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use RedBeanPHP\R;

class Status {

    public static function getStatusArchive($request, $response, $args){
        $commande = R::store('Status','libelle_Status=archive');
        return $response->withJson(['data'=>$commande]);
    }

    public static function getStatusPaiement($request, $response, $args){
        $commande = R::store('Status','libelle_Status=paiement');
        return $response->withJson(['data'=>$commande]);
    }

}