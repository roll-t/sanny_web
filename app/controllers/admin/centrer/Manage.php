<?php
class Manage extends Controller{
    private $__modelAdmin;
    public $data;
    function index(){
        $this->data['title']='admin';
        $this->view('layouts/admin_layout',$this->data);
    }
}