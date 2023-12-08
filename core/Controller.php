<?php

class Controller{
    public $db;
    static public $controller;
    public $response;

    function __construct()
    {
        
    }
    public function model($model){
        $arrModelName=explode('/',$model);
        $nameModel=$arrModelName[count($arrModelName)-1];
        if(file_exists(_DIR_ROOT.'/app/models/'.$model.'.php')){
            require_once _DIR_ROOT.'/app/models/'.$model.'.php';
            if(class_exists($nameModel)){
                $modelProject= new $nameModel();
                $this->response = new Response();
                return $modelProject;
            }
        }
        return false;
    }

    public function view($view,$data=[]){

        $titlePage=App::$app->titlePage;
        $data['sub_content']['title']=$titlePage;

        if(!empty(View::$dataShare)){
            $data=array_merge($data,View::$dataShare);
        }
        extract($data);
       
        if(file_exists(_DIR_ROOT.'/app/view/'.$view.'.php')){
            require_once _DIR_ROOT.'/app/view/'.$view.'.php';
        }
    }

    function success($url){
        $this->response->redirect($url);
    }

    function failure($url,$mess,$time='0.1'){
        alert($mess);
        $this->response->redirect($url,true,$time);
    }

    

}