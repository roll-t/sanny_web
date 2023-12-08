<?php
class Session{
    /*
    data(key,value)=>set_session()
    data(key)=>get_session()
    */
    static public function data($key='',$value=''){
        $sessionKey=self::isInvalid();
        if(!empty($value)){
            if(!empty($key)){
                $_SESSION[$sessionKey][$key]=$value;// set session
                return true;
            }
            return false;
        }else{
            if(empty($key)){
                if(!empty($_SESSION[$sessionKey])){
                    return $_SESSION[$sessionKey];
                }
            }else{
                if(isset($_SESSION[$sessionKey][$key])){
                    return $_SESSION[$sessionKey][$key];// get session
                }  
            }
        }
    } 

    // co 2 truong hop
    // dau tien delete co key xoa session voi key
    // delete khong co key xoa het session
    static function delete($key=''){
        $sessionKey=self::isInvalid();
        if(!empty($key)){
            if(isset($_SESSION[$sessionKey][$key])){
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        }else{
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }

    static public function showErrors($message){
        $data=['mess'=>$message];
        App::$app->loadError('exception',$data);
        die();
    }
    static public function isInvalid(){
        global $configs;

        if(!empty($configs['session'])){
            $sessionConfig=$configs['session'];
            if(!empty($sessionConfig['session_key'])){
                $sessionKey=$sessionConfig['session_key'];
                return $sessionKey;

            }else{
                self::showErrors('thieu cau hinh session_key !!');
            }
        }else{
            self::showErrors('thieu cau hinh session !!');
        }
    }
    // Flash Data
    // set flash data giong nhu set session
    // get flash data giong nhu session nhung se xoa luon data sau khi get xong
    static public function flash($key='',$value=''){
        $dataFlash=self::data($key,$value);
        // kiem tr neu value ton tai thi xoa lun session
        if(empty($value)){
            self::delete($key);
        }
        return $dataFlash;
    }
}