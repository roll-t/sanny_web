<?php
class Product extends Controller{
    private $__modelProduct,$__dataProduct=[],$__dirUrl='admin/product/add_product',$__dirRoot='admin/product';
    public $request;
    function __construct()
    {
        $this->request= new Request();
        $this->__modelProduct=$this->model('admin/ProductModel');
    }
    function index(){
       $this->list_product();
    }

    function list_product(){

        $this->__dataProduct['sub_content']['categoryList']=$this->__modelProduct->all('danhmuc');

        $quantityItemsPage=3;

        $currentPage=!empty($_GET['page'])?$_GET['page']:1;

        $page=($currentPage-1)*$quantityItemsPage;

        $quantityPage=ceil(($this->__modelProduct->count('sanpham'))/$quantityItemsPage);

        $list= $this->__modelProduct->paginate('sanpham',$page,$quantityItemsPage);

        if(!empty($_GET)){
            $list= $this->__modelProduct->paginate('sanpham',$page,$quantityItemsPage,$_GET,'dm_id');
            
            $quantityPage=ceil(($this->__modelProduct->countList('sanpham',$_GET,'dm_id'))/$quantityItemsPage);
        }

        if($currentPage<1){

            $currentPage=1;

        }else if($currentPage>$quantityPage){

            $currentPage=$quantityPage;

        }

        if(!empty($_GET['search'])){
            Session::data('search',$_GET['search']);
            $check=Session::flash('search');
            if($check){
             $this->__dataProduct['sub_content']['search']=$check;
            }
         }  

         if(!empty($_GET['filter'])){
            Session::data('filter',$_GET['filter']);
            $check=Session::flash('filter');
            if($check){
             $this->__dataProduct['sub_content']['filter']=$check;
            }
         }
         
        $this->__dataProduct['sub_content']['quantityPage']=$quantityPage;

        $this->__dataProduct['sub_content']['currentPage']=$currentPage;

        $this->__dataProduct['sub_content']['listProduct']=$list; 
      
        $this->__dataProduct['content']='admin/product/listProduct';

        $this->view('layouts/admin_layout',$this->__dataProduct);
    }


    function add_product(){
        $check=Session::flash('updateProductErrors');
        if(isset($check)){
            $this->__dataProduct['sub_content']['msg']=$check;
        }
        $this->__dataProduct['sub_content']['categoryList']=$this->__modelProduct->all('danhmuc');
        $this->__dataProduct['content']='admin/product/addProduct';
        $this->view ('layouts/admin_layout',$this->__dataProduct);
    }
    function value(){
        return $this->request->getFields();
    }
    function confirmAddProduct(){

        $valueProduct=$this->value();

        function checkEmpty($arr){
            foreach($arr as $value){
                if(empty(trim($value))){
                    return false;
                    break;
                }
            }
            return true;
        }



        $checkEmpty=checkEmpty($valueProduct);
           
        if($checkEmpty){
            $arrImg=[
                'img_1'=>'imgProduct_1',
                'img_2'=>'imgProduct_2'
            ];

            $arrNameImg=[];

            $fileImgOke=true;

            foreach ($arrImg as $key=>$value){

                $check=checkImg($value,'public/imgs/product/listProduct');

                if($check==='pathInfo'){
                    $this->failure($this->__dirUrl,'Sai định dạng ảnh !');
                    $fileImgOke=false;
                    break;
                }
                if($check==='size'){
                    $this->failure($this->__dirUrl,'Kích thước ảnh quá lớn !');
                    $fileImgOke=false;
                    break;
                }
                if($check==='same'){
                    $this->failure($this->__dirUrl,'Tên ảnh đã tồn tại !');
                    $fileImgOke=false;
                    break;
                }

                if($check){
                    $arrNameImg[$key]=$check;
                }
            }

            $linkImg= implode('|',$arrNameImg);

            if(!empty(trim($linkImg))){
                if($fileImgOke){
                    $valueProduct['sp_img'] = $linkImg;
                }     

                $add= $this->__modelProduct->addProduct($valueProduct);

                if($add){
                    $this->success($this->__dirRoot);
                }else{
                    $this->failure($this->__dirUrl,'Thêm sản phẩm thất bại');
                }
            }else{
                Session::data('updateProductErrors',$valueProduct);
                $this->failure($this->__dirUrl,'Phải chọn ít nhất 1 ảnh');
            }
        }else{
            Session::data('updateProductErrors',$valueProduct);
            $this->failure($this->__dirUrl,'Không được bỏ trống');
        }
    }
    function filter_product(){
        $this->__dataProduct['sub_content']['categoryList']=$this->__modelProduct->all('danhmuc');
        if(!empty($_POST['dm_id'])){
            $id=$_POST['dm_id'];
            $listProduct=$this->__modelProduct->listProductFilter($id);
            $this->__dataProduct['sub_content']['listProduct']=$listProduct;
        }else{
            $this->__dataProduct['sub_content']['listProduct']=$this->__modelProduct->listProduct();
        }

        $this->__dataProduct['content']='admin/product/listProduct';
        $this->view('layouts/admin_layout',$this->__dataProduct);
    }
    function deleteProduct(){
        $id=$this->value()['sp_id'];
        $product=$this->__modelProduct->find($id);

        $delete= $this->__modelProduct->deleteProduct($id);

        if($delete){
            $listImg=explode('|',$product['sp_img']);        
            foreach ($listImg as $value){
                if(file_exists(_DIR_ROOT.'/public/imgs/product/listProduct/'.trim($value))){
                    unlink(_DIR_ROOT.'/public/imgs/product/listProduct/'.trim($value));
                }
            }
            $this->success($this->__dirRoot);
        }else{
            $this->failure($this->__dirRoot,'Xóa không thành công');
        }
    }
    function edixProduct(){ 
        $id=$this->value()['sp_id'];

        $this->__dataProduct['sub_content']['product']=$this->__modelProduct->find($id);

        $this->__dataProduct['sub_content']['categoryList']=$this->__modelProduct->all('danhmuc');
        $this->__dataProduct['content']='admin/product/edixProduct';
        $this->view ('layouts/admin_layout',$this->__dataProduct);
    }
    function confirmEdix(){

        $data=$this->value();

        if(!empty($this->value()['sp_id'])){
            $url='admin/product/edixProduct?sp_id='.$this->value()['sp_id'].'';
            $product=$this->__modelProduct->find($this->value()['sp_id']);
        }


        $arrNameImg = $product['sp_img'];



        if(!empty($arrNameImg)){
            $arrNameImg=explode('|',$arrNameImg);
        }

        $listImgOld=$arrNameImg;
        if(!empty($data)){  
            foreach($data as $key=>$items){
                if(empty($items)){
                    unset($data[$key]);
                }
            }
        }


            $arrImg=[   
                'imgProduct_1',
                'imgProduct_2'
            ];
            $arrImgEdix=[];
            $fileImgOke=true;

            foreach ($arrImg as $key=>$value){
                $check=checkImg($value,'public/imgs/product/listProduct');  
                if($check==='pathInfo'){
                    $this->failure($url,'Sai định dạng ảnh !');
                    $fileImgOke=false;
                    break;
                }
                if($check==='size'){
                    $this->failure($url,'Kích thước ảnh quá lớn !');
                    $fileImgOke=false;
                    break;
                }

                if($check==='same'){
                    $this->failure($url,'Tên ảnh đã tồn tại !');
                    $fileImgOke=false;
                    break;
                }

                if($check){
                    if(!empty($arrNameImg[$key])){
                        $arrImgEdix[$key]=$listImgOld[$key];
                        $arrNameImg[$key]=$check;
                    }
                }
            }
            
            $linkImg= implode('|',$arrNameImg);

            if(!empty(trim($linkImg))){
                if($fileImgOke){
                    $data['sp_img'] = $linkImg;
                }          
            }
 
            $edix= $this->__modelProduct->edixProduct($data);
            
            if($edix){
                if(!empty($arrImgEdix)){
                    foreach ($arrImgEdix as $value){
                        if(file_exists(_DIR_ROOT.'/public/imgs/product/listProduct/'.trim($value))){
                            unlink(_DIR_ROOT.'/public/imgs/product/listProduct/'.trim($value));
                        }
                    }
                }
                $this->success($this->__dirRoot);
            }
    }

}