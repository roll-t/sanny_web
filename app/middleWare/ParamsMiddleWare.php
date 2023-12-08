<?php

class ParamsMiddleWare extends MiddleWares{

    public function __construct() {
        if(!empty($_SERVER['QUERY_STRING'])){
            // $response=new Response();
            // $response->redirect(Routes::getFullUrl());
        }
    }
    public function handle(){
       
    }
}