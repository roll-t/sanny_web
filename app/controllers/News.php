<?php
class News extends Controller{
    public  $data=[];

    public function index(){
        $this->view('home/page_news',$this->data);
    }

    public function list_news(){
       $value=$this->model('ClientModel');

       $this->data['sub_content']['client']=$value->getList();
       $this->data['sub_content']['new_title']='danh sach khach hang <script></script>';
       $this->data['sub_content']['new_content']='san pham nay khogn ban';
       $this->data['sub_content']['new_post']='bai viet moi';
       $this->data['sub_content']['my_major']='infomation systems';
       $this->data['sub_content']['page_title']='trang tin tuc';
       $this->data['sub_content']['page']='tin tuc mekong';
       $this->data['content']='home/news';
       $this->view('layouts/client_layout',$this->data);
    }
}