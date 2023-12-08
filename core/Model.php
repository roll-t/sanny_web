<?php
// modle lay du lieu tu database

abstract class Model extends Database{
    protected $db;
    function __construct()
    {
        $this->db= new Database();
    }

    //dinh nghia 1 bang
    // khởi tạo phương thức trù tượng
    abstract function tableFill();
    abstract function fiedFill(); 
    abstract function primaryKey();
    function all($table=''){
        $tableName=$this->tableFill();
        $fiedSelect=$this->fiedFill();
        if(empty($fiedSelect)){
            $fiedSelect='*';
        }
        if(!empty($table)){
            $sql="SELECT $fiedSelect FROM $table";
        }else{
            $sql="SELECT $fiedSelect FROM $tableName";
        }
        $query=$this->db->query($sql);
        if(!empty($query)){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    function find($id=''){   
        $tableName=$this->tableFill();
        $fiedSelect=$this->fiedFill();
        $primaryKey=$this->primaryKey();
        if(empty($fiedSelect)){
            $fiedSelect='*';
        }
        $sql="SELECT $fiedSelect FROM $tableName WHERE $primaryKey='$id'";
        $query=$this->db->query($sql);
        if(!empty($query)){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    function check($data){
        if($data){
            return $data;
        }else{
            return $data;
        }
    }
    function paginate($table,$index,$quantityPage,$option=true,$fied=''){
        if($option===true){
            $list=$this->db->table($table)->limit($quantityPage,$index)->getValue();
        }else if(is_array($option)){
            foreach($option as $key=>$value){
                if($key==='search'){
                    $list=$this->db->table($table)->whereLike('sp_ten', '%' . $value . '%')->limit($quantityPage,$index)->getValue();
                    break;
                }else if($key==='filter'){
                    $list=$this->db->table($table)->where($fied,'=',$value)->limit($quantityPage,$index)->getValue();
                    break;
                }else{
                    $list=$this->db->table($table)->limit($quantityPage,$index)->getValue();
                    break;
                }
            }
        }
        return $list;
    }

    function countList($table='',$option=false,$fied=''){
        if(is_array($option)){
            $list=0;
            foreach($option as $key=>$value){
                if($key=='search'){
                    $list=$this->db->table($table)->whereLike('sp_ten', '%' . $value . '%')->getValue();
                    $list=count($list);
                }else if($key=='filter'){
                    $list=$this->db->table($table)->where($fied,'=',$value)->getValue();
                    $list=count($list);
                }
            }
            return $list;
        }else{
            return false;
        }
    }

}