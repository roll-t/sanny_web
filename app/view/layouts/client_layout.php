<html>
    <head>
        <?php $this->view('blocks/head',$sub_content)?>
    </head>
    
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/app.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/cart.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/headline.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/product/view_product.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/footer.css">
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/slide/Slide.js"></script>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/input/Input_1.js"></script>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/method/Toggle.js"></script>
    <body>
        <?php 
        $this->view('blocks/header');
        $this->view($content,$sub_content);
        $this->view('blocks/footer');
        ?>
    </body>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/header/search.js"></script>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/header/header_sticky.js"></script>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/cart/show.js"></script>
    <script src="<?php echo _WEB_ROOT?>/public/assets/client/js/cart/add_cart.js"></script>
</html>

