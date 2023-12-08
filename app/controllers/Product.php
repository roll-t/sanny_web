<?php
    class Product extends Controller{
        public $productModel;
        public $data=[];
        function __construct()
        {
            $this->productModel=$this->model('ProductModel');
        }
        public function index(){
            $listProduct=$this->productModel->getProductList();
            // render view
            $title='danh sach san pham';
            $this->data['listProduct']=$listProduct;
            $this->data['sub_content']['title']=$title;
            $this->data['content']='product/sale';
            $this->view('layouts/client_layout',$this->data);
        }
        public function list(){
            $this->view('product/list');
        }
}