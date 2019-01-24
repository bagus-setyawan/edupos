<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php $this->load->view('backend/tpl/header');
		$logged = $this->session->userdata('ses_id'); ?>
<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php $this->load->view('backend/tpl/menu'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<?php if(isset($content_header)): ?>
	<section class="content-header">
      <h1>
        <?php echo $content_header['title']; ?>
        <small><?php echo $content_header['subtitle']; ?></small>
      </h1>
      <?php echo $content_header['breadcrumbs']; ?>
    </section>
	<?php endif; ?>
    <!-- Main content -->
    <section class="content">
		<?php 
			//Untuk content
			if(isset($content))
			echo $content;
		?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php $this->load->view('backend/tpl/footer'); ?>
<?php if(isset($more_js)) echo "\n".$more_js; ?>
<?php $this->load->view('backend/tpl/script'); ?>
<?php if(isset($script)): echo "\n";?>
<script type="text/javascript">
<?php echo $script; ?>
</script>
<?php endif; ?>
</body>
</html>