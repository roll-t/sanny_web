<?php
class AddServiceProvider extends ServiceProvider{
    public function boot(){
        $value=$this->db->table('khach_hang')->select('kh_taikhoan')->where('kh_id','=',1)->first();
        $data_2['user_login']=$value;
        View::share($data_2);
    }
}