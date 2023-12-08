<?php
class HomeModel extends Model{
    private $__table='khach_hang';
    // phuong thức trù tượng
    function tableFill(){
        return 'khach_hang';
    }
    function fiedFill(){
        return '*';
    }
    function primaryKey(){
        return 'kh_id';
    }
    // co the select nhu bth
    public function getList(){
        $data=$this->db->query("SELECT * FROM $this->__table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function insertUesr($data){
        $this->db->table('khach_hang')->insert($data);
    }
    
    public function updateData($data,$id){
        $this->db->table('khach_hang')->where('kh_id','=',$id)->update($data);
    }
    public function deleteUser($id){
        $this->db->table('khach_hang')->where('kh_id','=',$id)->delete();
    }
}