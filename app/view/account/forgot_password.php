<link rel="stylesheet" href="../css/account/acount.css">
<div class="container banner">
    <div class="main-body">
        <h2 class="title">Quên mật khẩu</h2>
        <div class="to-sign-up">
            <span>Bạn chưa có tài khoản?</span><a href="../index.php?page=sign_up">Đăng ký</a>
        </div>
        <div class="form-forgot-password">
            <form onsubmit="return false" class="from-forgot-password" action="../php/account/handle_account.php">
                <div class="group-input">
                    <input type="text" name="userName" placeholder="Tên tài khoản" class="user-name input-login">
                    <span class="erorr"></span>
                    <div class="line"></div>
                </div>
                <div class="group-input">
                    <input type="mail" name="mail" placeholder="Email hoặc số điện thoại" class="user-name input-password">
                    <span class="erorr"></span>
                    <div class="line"></div>
                </div>
                <div class="confirm">
                    <a href="#" class="forget"></a>
                    <input class="get-password" type="submit" value="Gữi">
                </div>
                <input type="hidden" class="get-password-hidden" name='forgotPassword' >
            </form>
        </div>
    </div>
</div>
<script src='../js/account/Validate.js'></script>
<script src='../js/account/forgot_password.js'></script>