<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class CategoryModel extends Model{

    private $__table='nhom_danhmuc',$__categoryTable='danhmuc';


    function tableFill(){
        return 'nhom_danhmuc';
    }

    function fiedFill(){
        return '*';
    }
    

    function primaryKey(){
        return 'ndm_id';
    } 
    function getCatalog(){
        return $this->db->table($this->__table)->getValue();
    }

    function getCategory(){
        $data=$this->db->table($this->__categoryTable)->getValue();
        if(count($data)>0){
            return $data;
        }else{
            return [];
        }
    }
    function add($data){
        $result= $this->db->table($this->__table)->insert($data);
        return $this->check($result);
    }

    function deleteItems($data){
        if($this->checkChild($this->__categoryTable,'ndm_id',$data)){
            $result=$this->db ->table($this->__table)->where('ndm_id','=',$data)->delete();
            return $this->check($result);
        }else{
            return false;
        }
    }
    function change($data){
        $id=$data[$this->primaryKey()];
        unset($data[$this->primaryKey()]);
        $result=$this->db->table($this->__table)->where($this->primaryKey(),'=',$id)->update($data);
        return $this->check($result);
    }
    function changeItems($data){
        $id=$data['dm_id'];
        unset($data['dm_id']);
        $result=$this->db->table($this->__categoryTable)->where('dm_id','=',$id)->update($data);
        return $this->check($result);
    }
    function addItems($data){
        $result = $this->db->table($this->__categoryTable)->insert($data);
        return $this->check($result);
    }

    function deleteCategoryItems($id){
        if($this->checkChild('sanpham','dm_id',$id)){
            $result=$this->db->table($this->__categoryTable)->where('dm_id','=',$id)->delete();
            return $this->check($result);
        }else{
            return false;
        }
    }
    
    function checkChild($table,$primaryKey,$value){
        $count = $this->db->table($table)->count()->where($primaryKey,'=',$value)->getValue();
        if($count[0]['count']==0){
            return true;
        }else{
            return false;
        }
    }
}