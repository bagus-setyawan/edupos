<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('backend/tpl/header'); ?>
<body class="hold-transition" style="background-image: url(assets/images/bg2.gif);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center bottom;">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url(); ?>" style=""><b><?php echo PROJECT_TITLE; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="opacity: 0.80;background: #555a75;color:#fff;">
  <?php if(!empty(ses_data('stat', true))):?>
  <div class="alert alert-<?php echo $this->session->flashdata('stat'); ?> alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<h4><i class="icon fa fa-bell-o"></i> Info!</h4>
		<?php echo ses_data('msg', true); ?>
  </div>
  <?php endif; ?>
  
  <?php if($this->input->get('logout') == 'true') : ?>
  <div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<h4><i class="icon fa fa-bell-o"></i> Info!</h4>
		<?php echo $this->input->get('msg'); ?>
  </div>
  <?php endif; ?>
    <p class="login-box-msg">Login ke akun anda</p>
	<noscript>
    <style type="text/css">
        form {display:none;}
    </style>
    <div class="noscriptmsg">
    Harap aktifkan Javascript anda.
    </div>
	</noscript>
	<?php echo form_open(site_url('auth/login')); ?>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Nama User" value="<?php echo form_return(ses_data('return', true), 'username'); ?>" autofocus required autocomplete="false" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="password" required />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"></i> Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php $this->load->view('backend/tpl/script'); ?>
</body>
</html>