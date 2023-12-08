
<link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/admin/css/product.css">
<h1 class="title">Danh sách sản phẩm</h1>
<?php
?>
<div class="body-list-product">
    <div class="headline-list-product">
        <div class="left">
            <form action="<?php echo _WEB_ROOT?>/admin/product/add_product" method="post">
                <div class="group-input btn">
                    <input type="submit" value="Thêm Sản phẩm" class="submit-btn">
                </div>
            </form> 
            </div>
            <div class="right">
            <form style="display:flex;algin-items:center"  action="<?php echo _WEB_ROOT?>/admin/product/list_product">   
            <div class="group-input">
                <select name="filter" class="select-input" id="">
                    <option value="" disabled selected>Tất cả</option>
                    <?php
                    if(!empty($categoryList)){
                        foreach($categoryList as $key=>$category){
                          echo '<option value="'.$category['dm_id'].'">'.$category['dm_ten'].'</option>';
                        }
                    }
                    ?>
                </select> 
                <input type="submit"value="Tìm Kiếm">
            </div>
        </form>
        <form style="display:flex;algin-items:center;flex:1" action="<?php echo _WEB_ROOT?>/admin/product/list_product" method="get">
            <div class="group-input search">
                <input name="search" value="<?php echo !empty($search)?$search:false?>" type="text" placeholder="nhập tên sản phẩm">
                <input type="submit" value="Tìm kiếm">
            </div>
        </form>
        </div>
    </div>
    <div class="list-product">
        <?php
        if(!empty($listProduct)){
            foreach($listProduct as $key=>$value){
                $img=$value['sp_img'];
                $arrImg=explode('|',$value['sp_img']);
                echo '
                <input type="hidden" value='.$value['sp_id'].' />
                <div class="product-items">
                <div class="left">
                    <div class="img-product">
                        <img class="img img-product-js img-main" src="'._WEB_ROOT.'/public/imgs/product/listProduct/'.$arrImg[0].'" alt="">
                    </div>
                    <div class="name-product">
                        '.$value['sp_ten'].'
                    </div>
                    <div class="price-product">
                        '.$value['sp_gia'].' vnd
                    </div>
                </div>
                <div class="right">
                    <div class="action">';
                        ?>
                        <div class="action-items">
                            <a href="<?php echo _WEB_ROOT?>/admin/product/edixProduct?sp_id=<?php echo $value['sp_id']; ?>" name="deleteCatalog"> 
                            <ion-icon name="open-outline"></ion-icon>
                        </div>
                        <div class="action-items">
                            <a href="<?php echo _WEB_ROOT?>/admin/product/deleteProduct?sp_id=<?php echo $value['sp_id']; ?>" name="deleteCatalog"> 
                            <ion-icon name="trash-outline"></ion-icon>
                            </a> 
                        </div>
                        <?php
                    echo '</div>
                </div>
            </div>';
            }
        }
        ?>  
    </div>
    <div class="paging">   
        <?php 
        $limitPage=3;
        // duoc tao khi lay du lieu tren csdl 
        $countPage=!empty($quantityPage)?$quantityPage:$limitPage;
        // xac dinh trang duoc active   
        $currentPage=!empty($currentPage)?$currentPage:1;
        $keyPage=[];
        if(!empty($search)){
            $keyPage['search']=$search;
        }else if(!empty($filter)){
            $keyPage['filter']=$filter;
        }

        function renderPaginate($count,$limitPage,$currentPage,$keyPage=[]){
            function className($isCurrent) {
                return $isCurrent ? 'paging-items active' : 'paging-items';
            }

            $link=_WEB_ROOT . '/admin/product/list_product?page=';

            if(!empty($keyPage)){
                foreach($keyPage as $key=>$value){
                    $link=_WEB_ROOT.'/admin/product/list_product?'.$key.'='.$value.'&&page=';
                }
            }

            $startPaging=1;
            $pageItems=$count;
            if($count>$limitPage){
                $startPaging=($currentPage)>1 ? ($currentPage-1):1; 
                $pageItems=($currentPage < $limitPage) ? $limitPage:$startPaging+($limitPage-1);
                if($pageItems>$count){
                    $pageItems=$count;
                    $startPaging=$startPaging-1;    
                }
            }
            // echo ra prev
            if($currentPage>1){
                echo '<a class="paging-items prev" href="'.$link.($currentPage-1).'"><ion-icon name="chevron-back-outline"></ion-icon></a>';
                if($currentPage>3){
                    echo '<a class="paging-items prev" href="'.$link.'">1</a>';
                    echo '<span>. . .</span>';
                   }
            }
            // echo ra 3 nut o giua
            for($items=$startPaging;$items<=$pageItems;$items++){
                if (abs($items - $currentPage) === 0) {
                    echo '<a class="paging-items ' . className($items, $currentPage) . '" href="' .$link . $items . '">' . $items . '</a>';
                }else{
                    echo '<a class="paging-items " href="' .$link . $items . '">' . $items . '</a>';
                }
           }
           //echo next
           if($currentPage<$count){
            if($currentPage<$count-2){
                echo '<span>. . .</span>';
                echo '<a class="paging-items prev" href="'.$link.'">'.$count.'</a>';
               }
               echo '<a class="paging-items prev" href="'.$link.($currentPage+1).'"><ion-icon name="chevron-forward-outline"></ion-icon></a>';
            }
        }

        renderPaginate($countPage,$limitPage,$currentPage,$keyPage);

        ?>
    </div>
</div>
