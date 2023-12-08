<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php $this->view('admin/blocks/head',$sub_content )?>
<body>
    <?php $this->view('admin/blocks/header')?>
    <div class="container">
    <?php $this->view('admin/blocks/menu')?>

    <div class="main-content">

    <?php $this->view($content,$sub_content)?>

    </div>
    </div>
</body>
<script src="<?php echo _WEB_ROOT?>/public/assets/admin/js/home.js"></script>
</html>
<?ob_end_flush() ?>