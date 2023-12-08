<?php

class Category extends Controller{
    private $__data=[],$__modelCategory,$__dirUrl='admin/category';
    public $request;
    public $mess=[
        'delete'=>'Chỉ có thể xóa danh mục rỗng'
    ];
    function __construct()
    {
        $this->request=new Request();
        $this->__modelCategory = $this->model('admin/CategoryModel');
    }

    function index(){
        $this->listCategory();
    }

    function listCategory(){
        
        $this->__data['sub_content']['catalogList']=$this->__modelCategory->all();

        $this->__data['sub_content']['categoryAll']=$this->__modelCategory->getCategory();

        $grouped_arrays = array();

        if(!empty($this->__data['sub_content']['categoryAll'])){
            foreach ($this->__data['sub_content']['categoryAll'] as $key=>$item) {
                $ndm_id = $item['ndm_id']; 
                if (!isset($grouped_arrays[$ndm_id])) {
                    $grouped_arrays[$ndm_id] = array();
                }
                $grouped_arrays[$ndm_id][] = $item;
            }
        }

        $this->__data['sub_content']['categoryList']= $grouped_arrays;

        $this->__data['content']='admin/category/main';

        $this->__data['sub_content']['title']='category';

        $this->view('layouts/admin_layout',$this->__data);
    }

    function value(){
        return $this->request->getFields();
    }

    function addCategory(){
        $value =$this->value();
        if($value['confirmChange']){
            $value['ndm_id']=$value['confirmChange'];
            unset($value['confirmChange']);
            $change= $this->__modelCategory->change($value);
            if($change){
                $this->success($this->__dirUrl);
            }
        }else{
            if(!empty($value)){
                $add= $this->__modelCategory->add($value);
                if($add){
                    $this->success($this->__dirUrl);
                }
            }
        }
     
    }

    function deleteCategory(){
        $value = $this->value()['ndm_id'];
        if(!empty($value)){
            $delete=$this->__modelCategory->deleteItems($value);
            if($delete){
                $this->success($this->__dirUrl);
            }else{
                $this->failure($this->__dirUrl,$this->mess['delete']);
            }
        }
    }

    function addCategoryItems(){
        $value= $this->value();
        if(!empty($value['confirmChangecategory'])){
            $value['dm_id']=$value['confirmChangecategory'];
            unset($value['confirmChangecategory']);
            $change=$this->__modelCategory->changeItems($value);
            if($change){
                $this->success($this->__dirUrl);
            }
        }else{
            $add=$this->__modelCategory->addItems($value);
            if($add){
                $this->success($this->__dirUrl);
            }
        }
    }
    
    function deleteCategoryItems(){
        $id=$this->value()['dm_id'];
        $delete=$this->__modelCategory->deleteCategoryItems($id);
        if($delete){
            $this->success($this->__dirUrl);
        }else{
            $this->failure($this->__dirUrl,$this->mess['delete']);
        }
    }
} 