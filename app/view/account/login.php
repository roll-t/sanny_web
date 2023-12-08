<link rel="stylesheet" href="<?php echo _WEB_ROOT?>/public/assets/client/css/account/acount.css">
<div class="container banner">
    <div class="main-body">
        <h2 class="title">Đăng Nhập</h2>
        <div class="to-sign-up">
            <span>Bạn chưa có tài khoản?</span><a href="./index.php?page=sign_up">Đăng ký</a>
        </div>
        <div class="form-login">
            <form  class="from-login" method="post" action="./index.php">
                <div class="group-input">
                    <input type="text" name="userName" placeholder="Tên đăng nhập" class="user-name input-login">
                    <span class="erorr"></span>
                    <div class="line"></div>
                </div>
                <div class="group-input">
                    <input type="password" name="password" placeholder="Mật khẩu" class="user-name input-password">
                    <span class="erorr"></span>
                    <div class="line"></div>
                </div>
                <div class="remember">
                    <input type="checkbox"><span>Ghi nhớ tài khoản</span>
                </div>
                <div class="confirm">
                    <a href="./index.php?page=forgot_password" class="forget">Quên mật khẩu ?</a>
                    <input class="btn-login" name="confirmLogin" type="submit" value="Đăng nhập">
                </div>
                <div href="#"style="position:absolute;opacity:0;" class="check-login"></div>
                <a href="#" class="handle-value"></a>
            </form>
            
        </div>
    </div>
</div>

<script src='<?php echo _WEB_ROOT?>/public/assets/client/js/account/Validate.js'></script>
<script src='<?php echo _WEB_ROOT?>/public/assets/client/js/account/login.js'></script>