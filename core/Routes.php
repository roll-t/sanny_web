<?php 
class Routes{
    private $__keyRoute=null,$title;
    function handleRoutes($url){
        global $routes;
        $url=ltrim($url,'/');
        $handleUrl=$url;
        $this->title=$url;
        if(!empty($routes)){
            foreach($routes as $key=>$value){
                if(preg_match('~'.$key.'~is',$url)){
                    $handleUrl=preg_replace('~'.$key.'~is',$value,$url);
                    $this->__keyRoute=$key;
                    $this->title=$value;
                }
            }
        }
        return $handleUrl;
    }
    public function getTitlePage(){
        global $titlePage;
        $this->title= !empty($titlePage[$this->title]) ? $titlePage[$this->title] :'không tiêu đề';
        return $this->title;
    }

    public function getKeyRoute(){
        return $this->__keyRoute;
    }

    static public function getFullUrl(){
        $uri= App::$app->getUrl();
        $url=_WEB_ROOT.$uri;
        return $url;
    }

}