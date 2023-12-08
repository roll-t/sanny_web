<?php

class ProductModel extends Model{

    private $__table='sanpham';


    function tableFill(){
        return 'sanpham';
    }

    function fiedFill(){
        return '*';
    }
    

    function primaryKey(){
        return 'sp_id';
    }
    function listProduct(){
        $list= $this->db->table($this->__table)->orderBy($this->primaryKey(),'DESC')->getValue();
        if(!empty($list)){
            return $list;
        }else{
            return [];
        }
    }
    function listProductFilter($id=0){
        $list=$this->db->table($this->__table)->where('dm_id','=',$id)->orderBy('sp_id', 'DESC')->getValue();
        if(!empty($list)){
            return $list;
        }else{
            return [];
        }
    }
    function addProduct($data){
        $result=$this->db->table($this->__table)->insert($data);
        return $this->check($result);
    }
    function deleteProduct($id){
        $result=$this->db->table($this->__table)->where($this->primaryKey(),'=',$id)->delete();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    function edixProduct($data=[]){
        if(!empty($data)){
            $id=$data[$this->primaryKey()];
            unset($data[$this->primaryKey()]);
            $result=$this->db->table($this->__table)->where($this->primaryKey(),'=',$id)->update($data);
            return $this->check($result);
        }
    }

    function search($data=''){
        if(!empty($data)){
            $result=$this->db->table($this->__table)->whereLike('sp_ten', '%' . $data . '%')->orderBy('sp_id', 'DESC')->getValue();
            return $this->check($result);

        }
    }
    function count(){
        $count=$this->db->table($this->__table)->count()->getValue();
        return  $count[0]['count'];
    }
}