<?php
class App{
    
    private $__controller, $__action,$__params,$__routes,$__db;
    static public $app;
    public $titlePage;
    function __construct()
    {
        global $routes,$titlePage;
        self::$app=$this;
        $this->__routes= new Routes();
        if(!empty($routes['defaultController'])){
            $this->__controller=$routes['defaultController'];
        }else{
            $this->__controller='home';
        }
        $this->__action='index';
        $this->__params=[];

        // link db thông qua base controller
        if (class_exists('DB')){
            $db_obj=new DB();
            $this->__db = $db_obj->db;
        }
        $this->handleUrl();
  
    }
    
    function getUrl(){
        if(!empty($_SERVER['PATH_INFO'])){
            $url=$_SERVER['PATH_INFO'];
        }else{
            $url='/';
        }
        return $url;
    }




    function handleUrl(){

        $url= $this->getUrl();

        $url= $this->__routes->handleRoutes($url);

        $this->titlePage= $this->__routes->getTitlePage();

        // load middleWare app

        $this->handleRouteMiddleWare($this->__routes->getKeyRoute(),$this->__db);

        $this->handleGlobalMiddleWare($this->__db);

        // load service proviceder app

        $this->handleAppServiceProvider($this->__db);

        $urlArr=array_filter(explode('/',$url));
        
        $urlArr=array_values($urlArr);

        $urlCheck='';
        if(!empty($urlArr)){
            foreach ($urlArr as $key=>$value){
               $urlCheck.=$value.'/';
               $fileCheck=rtrim($urlCheck,'/');
               $fileArr=explode('/',$fileCheck);
               $lastItems=end($fileArr);
               $lastItems=ucfirst($lastItems);
               $fileArr[count($fileArr)-1]=$lastItems;
               $fileCheck=implode('/',$fileArr);
               if(!empty($urlArr[$key-1])){
                   unset($urlArr[$key-1]);
               }
               if(file_exists('app/controllers/'.($fileCheck).'.php')){
                    $urlCheck= $fileCheck;
                    break;
               }
            }
        }
        $urlArr=array_values($urlArr);
        // xu ly controller
        if(empty($urlCheck)){
            $urlCheck=$this->__controller;
        }
        if(!empty($urlArr[0])){
            $this->__controller=ucfirst($urlArr[0]);
        }else{
            $this->__controller=ucfirst($this->__controller);
        }
        if(file_exists('app/controllers/'.($urlCheck).'.php')){
            require_once 'controllers/'.($urlCheck).'.php';
            //kiem tra class ton tai
            if(class_exists($this->__controller)){
                $this->__controller = new $this->__controller;
                unset($urlArr[0]);
                if(!empty($this->__db)){
                    $this->__controller->db=$this->__db;
                }
            }else{
                $this->loadError();
            }
        }else{
            $this->loadError();
        }

        // xu ly action 
        if(!empty($urlArr[1])){
            $this->__action=$urlArr[1];
            unset($urlArr[1]);
        }

        // xu ly params
        $this->__params=array_values($urlArr);
        if(method_exists($this->__controller,$this->__action)){
            call_user_func_array([$this->__controller,$this->__action],$this->__params);
        }else{
            $this->loadError();
        }
    }

    function handleRouteMiddleWare($routeKey='',$db){
        $routeKey=trim($routeKey);
        //middleWare app
        global $configs;
        if(!empty($configs['app']['routesMiddleWare'])){
            $routeMiddleWareArr=$configs['app']['routesMiddleWare'];
            foreach($routeMiddleWareArr as $key=>$items){
                if(file_exists('app/middleWare/'.$items.'.php') && $routeKey==trim($key)){
                    require_once 'app/middleWare/'.$items.'.php';
                    if(class_exists($items)){
                        $middleWareObj=new $items();
                        if(!empty($db)){
                            $middleWareObj->db=$db;                 
                        }
                        $middleWareObj->handle();
                    }
                }
            }
        }
    }
    function handleGlobalMiddleWare($db){
        global $configs;
        if(!empty($configs['app']['globalMiddleWare'])){
            $globalMiddleWareArr=$configs['app']['globalMiddleWare'];
            foreach($globalMiddleWareArr as $items){
                if(file_exists('app/middleWare/'.$items.'.php') ){
                    require_once 'app/middleWare/'.$items.'.php';
                    if(class_exists($items)){
                        $middleWareObj=new $items();
                        if(!empty($db)){
                            $middleWareObj->db=$db;
                        }
                        $middleWareObj->handle();
                    }
                }
            }
        }
    }

    public function handleAppServiceProvider($db=''){
        global $configs;
        if(!empty($configs['app']['boot'])){
            $serviceProviderArr=$configs['app']['boot'];
            foreach($serviceProviderArr as $items){
                if(file_exists('app/core/'.$items.'.php') ){
                    require_once 'app/core/'.$items.'.php';
                    if(class_exists($items)){
                        $serviceObj=new $items();
                        if(!empty($db)){
                            $serviceObj->db =$db;
                        }
                        $serviceObj->boot();
                    }
                }
            }
        }
    }

    function loadError($name='404',$data=[]){
        extract($data);
        require_once 'errors/'.$name.'.php'; 
    }
}