<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="main-footer">
		<div class="pull-right hidden-xs">
		  (Halaman dirender selama <?php echo $this->benchmark->elapsed_time();?> s.) <b>Version</b> 1.0.0
		</div>
		<strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo site_url(); ?>"><?php echo PROJECT_TITLE; ?></a>.</strong> All rights
		reserved.
</footer>