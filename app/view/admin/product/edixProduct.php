<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/admin/css/product.css">
<link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/admin/css/list_product.css">
<div class="wrap-form">
    <div class="main-info">
        <h1 class="title">Thay đổi thông tin sản phẩm</h1>
        <form action="<?php echo _WEB_ROOT ?>/admin/product/confirmEdix" enctype="multipart/form-data" id="addProductForm" method="post" class="product-form">
            <?php
            if(!empty($product)){
                echo '<input type="hidden" name="sp_id" value='.$product['sp_id'].' />';
            }
            ?>
            <div class="group-input">
                <label for="categotyProduct">Chọn danh mục</label>
                <select name="dm_id" class="select-input custom-select" id="">
                    <?php
                    if (!empty($categoryList)) {
                        if(!empty($product['dm_id'])){
                            $idFind=$product['dm_id'];
                            $productFound = array_filter($categoryList, function ($categoryList) use ($idFind) {
                                return $categoryList['dm_id'] === $idFind;
                            });
                            // Lấy phần tử đầu tiên trong mảng kết quả
                            $productFound = reset($productFound);
                            echo '<option value="' . $productFound['dm_id'] . '">' . $productFound['dm_ten'] . '</option>'; 
                        }
                        foreach ($categoryList as $key => $category) {
                            echo '<option value="' . $category['dm_id'] . '">' . $category['dm_ten'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="group-input text ">
                <label for="productName" class="form-label">Tên sản phẩm:</label>
                <input type="text" id="productName" name="sp_ten" value="<?php echo !empty($product['sp_ten']) ? $product['sp_ten'] : false ?>" placeholder="san pham 1 .." class="form-input">
            </div>
            <div class="group-input text">
                <label for="productPrice" class="form-label">Giá:</label>
                <input type="number" id="productPrice" name="sp_gia" value="<?php echo !empty($product['sp_gia']) ? $product['sp_gia'] : false ?>" placeholder="500 000 ... VDN" class="form-input">
            </div>
            <div class="group-input img">
                <label for="">Chọn ảnh sản phẩm <span style="font-size:13px">(có thể đế trống )</span></label> <br>
                <label for="productPrice" class="form-label">ảnh 1</label>
                <input name="imgProduct_1" type="file" class="img-product"><br>
                <label for="productPrice" class="form-label">ảnh 2</label>
                <input name="imgProduct_2" type="file" class="img-product">
            </div>
            <div class="group-input btn">
                <input type="submit" value="Thay đổi" class="submit-btn">
            </div>
        </form>
    </div>
    <div class="view-try">
        <ul class="list-product">
            <li class="product-item">
                <div class="top-product">
                    <img src="<?php echo _WEB_ROOT ?>/public/assets/client/img/product/sp-1-1.jpg" alt="" class="img img-main">
                    <img src="<?php echo _WEB_ROOT ?>/public/assets/client/img/product/sp-1-2.jpg" alt="" class="img img-zoom">
                    <div class="action">
                        <div class="list-action">
                            <div class="action-item view-more">
                                <ion-icon name="eye-outline"></ion-icon>
                            </div>
                            <div class="action-item add-cart">
                                <ion-icon name="cart-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="like">
                        <ion-icon name="heart-outline"></ion-icon>
                        <input type="hidden" value="Đăng nhập trước" class="tag-info">
                    </div>
                    <div class="select-add-cart">
                        <div class="point-close"><ion-icon name="close-outline"></ion-icon></div>
                        <div class="action-add-cart">
                            <div class="color select-color ">
                                <div class="title-color">
                                    <p>Màu:</p><span class="current-color">Nâu</span>
                                </div>
                                <div class="list-color-product">
                                    <div class="color-item active">
                                        <div class="border"></div>
                                    </div>
                                    <div class="color-item">
                                        <div class="border"></div>
                                    </div>
                                    <div class="color-item">
                                        <div class="border"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="size size-product-view">
                                <div class="title">
                                    <p>Size: </p><span class="current-size">L</span>
                                </div>
                                <div class="list-size">
                                    <div class="size-item">M</div>
                                    <div class="size-item active">L</div>
                                    <div class="size-item">XL</div>
                                </div>
                            </div>
                            <div class="total-price">
                                <div class="price"><span class="price-number">400000</span><span>VND</span></div>
                            </div>
                            <div class="add-cart form-quantity">
                                <div class="quantity">
                                    <div class="input">
                                        <div class="prve quantity-item">-</div>
                                        <input class="number quantity-item" value="1" min="1" type="text">
                                        <div class="next quantity-item">+</div>
                                    </div>
                                </div>
                                <div class="btn-confirm">
                                    Thêm vào giỏ hàng
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-product">
                    <h4 class="name-product">san pham 1</h4>
                    <div class="des-product">
                        <p class="price-product"><span class="price">300000</span> <span>VND</span></p>
                        <div class="list-color-product">
                            <div class="color-item">
                            </div>
                            <div class="color-item">
                            </div>
                            <div class="color-item">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="id-product" value='0'>
            </li>
        </ul>
        <div class="btn-view">Xem Thử</div>
    </div>
</div>
<script src="<?php echo _WEB_ROOT?>/public/assets/admin/js/viewTry.js"></script>