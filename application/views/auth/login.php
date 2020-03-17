<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $this->config->item('sitename_tittle')?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/iCheck/square/purple.css">
  </head>
<body class="hold-transition login-page" style="height: 100%;overflow: hidden;">

  
  <div class="login-box">
    <div class="login-logo">
        <h1><?= $this->config->item('sitename')?></h1>
    </div>
    <div class="login-box-body ">
      <p class="login-box-msg"><?php echo lang('login_subheading');?></p>
        <div id="infoMessage" style="color: red"><?php echo $message;?></div>
      <?php echo form_open("auth/login");?>
         <div class="form-group has-feedback">
          <label><?php echo lang('login_identity_label') ?></label>
          <input type="text" name="identity" class="form-control" placeholder="<?php echo lang('login_identity_label') ?>" autofocus />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <label><?php echo lang('login_password_label') ?></label>
          <input type="password" id="password" data-toggle="password" name="password" class="form-control" placeholder="<?php echo lang('login_password_label') ?>"  />
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input name="remember" type="checkbox" class="icheckbox_flat-green" value="1"> <?php echo lang('login_remember_label') ?>
              </label>
            </div>                    
          </div><!-- /.col -->
          <div class="col-xs-4">
            <input type="submit" class="btn bg-purple btn-block" id="loginBtn" value="<?php echo lang('login_submit_btn') ?>" />
          </div><!-- /.col -->
        </div>
        <?php echo form_close();?>
        <a href="forgot_password"><?php echo lang('login_forgot_password');?></a><br/>
        <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
      
    </div>
  </div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url();?>assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-purple',
      radioClass: 'icheckbox_flat-green',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>