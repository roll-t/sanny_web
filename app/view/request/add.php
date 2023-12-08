

<style>
    input{
        width:40%;
        height:30px;
    }
</style>
<?php
 HtmlHelper::formOpen('post',_WEB_ROOT.'/home/index');
 HtmlHelper::input('submit','confirm');
 HtmlHelper::formClose();

?>
<form action="<?php echo _WEB_ROOT;?>/home/post_user" method="post">
    <div style="display:flex;flex-direction: column;gap:10px;align-items:center;">
        <div style="width:50%" >
            <input type="text" name="fullName" value="<?php echo old('fullName')?>" class="input" placeholder="Ho ten">
            <br>
           <?php  echo form_error('fullName','<span style="color:red;">','</span>'); ?>
        </div>
        <div style="width:50%" >
            <input type="mail" name="email" value="<?php echo old('email')?>"  class="input" placeholder="mail">
            <br>
            <?php  echo form_error('email','<span style="color:red;">','</span>'); ?>
        </div>
        <div style="width:50%" >
            <input type="password" name="password" class="input" placeholder="mat khau">
            <br>
            <?php  echo form_error('password','<span style="color:red;">','</span>'); ?>
        </div>
        <div style="width:50%" >
            <input type="password" name="confirmPassword" class="input" placeholder="xac nhan mat khau">
            <br>
            <?php  echo form_error('confirmPassword','<span style="color:red;">','</span>'); ?>
        </div>
        <div style="width:50%" >
            <input type="submit" name="confirm" class="input" value="dang ky">
        </div>
    </div>
</form>