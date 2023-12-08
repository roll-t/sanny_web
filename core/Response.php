<?php
class Response{

    function redirect($uri='',$delay=false,$delayTimes='0.1'){
        if(preg_match('~^(http|https)~is',$uri)){
            $url=$uri;
        }else{
            $url=_WEB_ROOT.'/'.$uri;
        }
        if($delay){
            header('Refresh: '.$delayTimes.';url='._WEB_ROOT.'/'.$uri);
        }else{
            header('location:'.$url);
        }
        exit;
    }
}