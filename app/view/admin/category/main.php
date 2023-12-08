<div class="title">Nhóm Danh mục</div>

<form action="<?php echo _WEB_ROOT?>/admin/category/addCategory" method="post"  class ='post-data-categoty ' id="categoryForm">
    <div class="menu-category">
        <div style="display:none" class="catalog-list">
            <div class="handle">
            <input class="id-catalog" type="hidden" value="" />
                <span class="name-catalog"></span>
                <div class="action">
                    <div class="action-items delete">';
                    
                    echo '</div>
                    <div class="action-items change">
                        <ion-icon name="open-outline"></ion-icon>
                    </div>
                    <div class="action-items see-category">
                        <ion-icon name="chevron-down-outline"></ion-icon>
                    </div>
                </div>
            </div>
            
            <form action="/admin/category/addCategoryItems" method="post">

            <div class="category-list">';
                echo '<div class="category-items last add-category-items">
                    <span></span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </div>
            </div>
            </form>
        </div>
        <?php
        if(!empty($catalogList)){
            foreach($catalogList as $key=>$category){
            echo '<div class="catalog-list">
                <div class="handle">
                <input class="id-catalog" type="hidden" value="'.$category['ndm_id'].'" />
                    <span class="name-catalog">'.$category['ndm_ten'].'</span>
                    <div class="action">
                        <div class="action-items delete">';
                        ?>
                        <a href="<?php echo _WEB_ROOT?>/admin/category/deleteCategory?ndm_id=<?php echo $category['ndm_id']; ?>" name="deleteCatalog"> 
                        <ion-icon name="trash-outline"></ion-icon>
                        </a> 
                        <?php
                        echo '</div>
                        <div class="action-items change">
                            <ion-icon name="open-outline"></ion-icon>
                        </div>
                        <div class="action-items see-category">
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </div>
                    </div>
                </div>
                
                <form action="'._WEB_ROOT.'/admin/category/addCategoryItems" method="post">
                <div class="category-list">';
                if(!empty($categoryList[$category['ndm_id']])){
                    foreach($categoryList[$category['ndm_id']] as $value){
                     echo ' <div class="category-items">
                         <input type="hidden" class="id-category-items" value="'.$value['dm_id'].'" />
                         <span class="name-category" >'.$value['dm_ten'].'</span>
                         <div class="action">
                             <div class="action-items change">
                                 <ion-icon name="open-outline"></ion-icon>
                             </div>
                             <div class="action-items">
                             ';
                             ?>
                             <a href="<?php echo _WEB_ROOT?>/admin/category/deleteCategoryItems?dm_id=<?php echo $value['dm_id']; ?>" name="deleteCatalog">
                             <ion-icon name="trash-outline"></ion-icon>
                             </a> 
                             <?php
                         echo '</div>
                         </div>
                      </div>';
                    }
                }
                    echo '<div class="category-items last add-category-items">
                        <span></span>
                        <ion-icon name="add-circle-outline"></ion-icon>
                    </div>
                </div>
                </form>
            </div>';
            }
        }
        ?>
    </div>
    <div class="add-catalog">
            <span></span>
            <ion-icon name="add-circle-outline"></ion-icon>
    </div>
</form>
<script src="<?php echo _WEB_ROOT?>/public/assets/admin/js/category.js"></script>
<script src="<?php echo _WEB_ROOT?>/public/assets/admin/js/categoryItem.js"></script>