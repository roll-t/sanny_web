<?php

define('_DIR_ROOT',__DIR__);

// xu ly http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
    $web_root='https://'.$_SERVER['HTTP_HOST'];
}else{
    $web_root='http://'.$_SERVER['HTTP_HOST'];
}
$folder=str_replace(strtolower($_SERVER['DOCUMENT_ROOT']),'',strtolower(_DIR_ROOT));
$folder=ltrim($folder,'\\');
$web_root=$web_root.'/'.$folder;
define('_WEB_ROOT',$web_root);

// tu dong load configs
$configs_dir=scandir('configs');
if(!empty($configs_dir)){
    foreach ($configs_dir as $key=>$value){
        if($value!='.' && $value!='..' && file_exists('configs/'.$value)){
            require_once 'configs/'.$value;
        }
    }
}
//load all serveices
// global
if(!empty($configs['app']['service'])){
    $allServices=$configs['app']['service'];
    if(!empty($allServices)){
        foreach($allServices as $items){
            if(file_exists('app/core/'.$items.'.php')){
                require_once 'app/core/'.$items.'.php';
            }
        }
    }
}

//load service provider class
require_once 'core/ServiceProvider.php';

// load view class
require_once 'core/View.php';

// require laod model middleWare 
require_once 'core/Load.php';

// MiddleWares
require_once 'core/MiddleWares.php';

// require_once 'configs/routes.php';
require_once 'core/Routes.php';//load routes

require_once 'core/Session.php';//load session

if(!empty($configs['database'])){
    $db_configs=array_filter($configs['database']);
    if(!empty($db_configs)){
        require_once 'core/Connection.php';
        require_once 'core/QueryBuilder.php';
        require_once 'core/Database.php';
        require_once 'core/DB.php';
        $db=new Database();
    }
}
// load core Helper co san trong he thong

require 'core/Helper.php';

require_once 'app/App.php';//load app

//load all helper coder tu viet
$configs_dir_helper=scandir('app/helper');
if(!empty($configs_dir_helper)){
    foreach ($configs_dir_helper as $key=>$value){
        if($value!='.' && $value!='..' && file_exists('app/helper/'.$value)){
            require_once 'app/helper/'.$value;
        }
    }
}



require_once 'core/Model.php';// load base model    

require_once 'core/Template.php';//load template engine

require_once 'core/Controller.php';// load base controler

require_once 'core/Request.php';// load request POST/GET

require_once 'core/Response.php';// load request POST/GET