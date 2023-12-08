<?php

class ClientModel extends Model{
    private $__table='khach_hang';
    function tableFill(){
        return 'khach_hang';
    }
    function fiedFill(){
        return '*';
    }
    function primaryKey(){
        return 'kh_id';
    }
    public function getList(){
      $value=$this->db->table($this->tableFill())->getValue();
      return $value;
    }

}