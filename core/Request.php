<?php
class Request{
    private $__rules=[],$__message=[],$__errors=[];
    public $checkValidate=true;
    public $db;
    function __construct()
    {
        $this->db= new Database();
    }

    public function getMethod(){
       $request= $_SERVER['REQUEST_METHOD'];
       return strtolower($request);
    }
    public function isPost(){
        if($this->getMethod()=='post'){
            return true;
        }else{
            return false;
        }
    }
    public function isGet(){
        if($this->getMethod()=='get'){
            return true;
        }else{
            return false;
        }
    }
    public function getFields(){
        $dataFields=[];
        if($this->isGet()){
            // lay du lieu voi phuong thuc get
           if(!empty($_GET)){
            foreach($_GET as $key=>$value){
                if(is_array($value)){
                    $dataFields[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY); 
                }else{
                    $dataFields[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS); 
                }
            }
           }
        }

        if($this->isPost()){
            // lay du lieu voi phuong thuc get
           if(!empty($_POST)){
            foreach($_POST as $key=>$value){
                if(is_array($value)){
                    $dataFields[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY); 
                }else{
                    $dataFields[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS); 
                }
            }
           }
        }
        return $dataFields;
    }

    //set rules
    public function rules($rules=[]){
        $this->__rules=$rules;
    }

    // set message
    public function message($message=[]){
        $this->__message=$message;
    }
    // set validate

    public function validate(){
        // loai bo cac phan tu rong trong mang
        $this->__rules=array_filter($this->__rules);
    
        //lay ra du lieu duoc tra ra tu request
        $dataField= $this->getFields();
        if(!empty($this->__rules)){
            // tach mang rules lan 1
            foreach($this->__rules as $key=>$value){
                $rules=explode('|',$value);
                // tach mang rules lan 2
                foreach($rules as $rulesItems){
                    $rulesName=null;
                    $rulesValue=null;
                    $rulesItemsArr=explode(':',$rulesItems);
                    // min : 3 == rulesName : rulesValue
                    // gan rulesName=phan tu dau tien cua mang
                    $rulesName=reset($rulesItemsArr);
                    if(count($rulesItemsArr)>1){
                    // gan rulesValue= phan tu thu 2 cua mang
                        $rulesValue=end($rulesItemsArr);
                    }
                    // kiem tra truong hop rong cua input
                    if($rulesName=='required'){
                        // if request tai vi tri key tuong ung rong thi gan error
                        if(empty(trim($dataField[$key]))){
                            $this->setErrors($key,$rulesName);
                        }
                    }
                    if($rulesName=='min'){
                        if(strlen(trim($dataField[$key]))<$rulesValue){
                            $this->setErrors($key,$rulesName);
                        }
                    }
                    if($rulesName=='max'){
                        if(strlen(trim($dataField[$key]))>$rulesValue){
                            $this->setErrors($key,$rulesName);
                        }
                    }
                    if($rulesName=='email'){
                        if(!filter_var(trim($dataField[$key]),FILTER_VALIDATE_EMAIL)){
                            $this->setErrors($key,$rulesName);
                        }
                    }
                    if($rulesName=='match'){
                        if(trim($dataField[$rulesValue])!=""){
                            if(trim($dataField[$key])!=trim($dataField[$rulesValue])){
                                $this->setErrors($key,$rulesName);
                            }
                        }
                    }
                    if($rulesName=='unique'){
                        $tableName=null;
                        $fieldCheck=null;
                        if(!empty($rulesItemsArr[1])){
                            $tableName=$rulesItemsArr[1];
                        }
                        if(!empty($rulesItemsArr[2])){
                            $fieldCheck=$rulesItemsArr[2];
                        }
                        if(!empty($tableName) && !empty($fieldCheck)){
                            $value=$this->db->table('khach_hang')->count()->where('kh_taiKhoan','=',$dataField[$rulesValue])->getValue();
                            if(!empty($value[0]['count'])){
                               if($value[0]['count']>0){
                                $this->setErrors($key,$rulesName);
                               }
                           }
                        }
                    }
                }
            }                                               
        }
        // pai co class Seession
        $sessionKey=Session::isInvalid();
        Session::flash($sessionKey.'_errors',$this->errors());
        Session::flash($sessionKey.'_olds',$this->getFields());

        return $this->checkValidate;
    }

    // get errors
    public function errors($fieldName=''){
        if(!empty($this->__errors)){
            if(empty($fieldName)){
                $errorArr=[];
                foreach($this->__errors as $key=>$value){
                    $errorArr[$key]=reset($value);
                }
                return $errorArr;
            }else{
                return reset($this->__errors[$fieldName]);
            }
        }else{
            return false;
        }
    }                           

    public function setErrors($fieldName,$ruleName){
        $this->__errors[$fieldName][$ruleName]=$this->__message[$fieldName.'.'.$ruleName];
        $this->checkValidate=false;     
    }                                                                                                       
}