<?php defined('BASEPATH') OR exit('No direct script access allowed');
		$role = $this->session->userdata('ses_role');
		$menudata = array('vendor','barang', 'karyawan', 'pelanggan', 'kategori');
 ?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>OS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>D&#x27;</b>KWU</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<li><a href="<?php echo site_url('transaksi/depan'); ?>" target="_blank"> <i class="fa fa-shopping-cart"></i> Transaksi Depan</a></li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->session->userdata('ses_foto') != "" ? base_url('assets/images/profile/'.$this->session->userdata('ses_foto')):base_url('assets/images/default-avatar.png'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('ses_fullname'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->session->userdata('ses_foto') != "" ? base_url('assets/images/profile/'.$this->session->userdata('ses_foto')):base_url('assets/images/default-avatar.png'); ?>" class="img-circle" alt="User Image">
				<p><?php echo $this->session->userdata('ses_fullname'); ?>
				<small><?php echo $this->session->userdata('ses_rolename'); ?></small>
				</p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url('logout'); ?>" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->session->userdata('ses_foto') != "" ? base_url('assets/images/profile/'.$this->session->userdata('ses_foto')):base_url('assets/images/default-avatar.png'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('ses_fullname'); ?>
		  </p>
          <small><?php echo $this->session->userdata('ses_rolename'); ?></small>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <li class="treeview<?php if($this->uri->segment(1)==""){echo " active";} ?>">
          <a href="<?php echo site_url(); ?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
        <li class="treeview<?php if(in_array($this->uri->segment(2),$menudata)){echo " active";} ?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data Master</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php if($role == '1' || $role == '2'): ?>
			<li<?php if($this->uri->segment(1)=="data" && $this->uri->segment(2)=="vendor"){echo " class='active'";} ?>><a href="<?php echo site_url('data/vendor'); ?>"><i class="fa fa-arrow-circle-right"></i> Data Vendor</a></li>
			<?php endif; ?>
            <li<?php if($this->uri->segment(1)=="data" && $this->uri->segment(2)=="barang"){echo " class='active'";} ?>><a href="<?php echo site_url('data/barang'); ?>"><i class="fa fa-arrow-circle-right"></i> Data Barang</a></li>
			<li<?php if($this->uri->segment(1)=="data" && $this->uri->segment(2)=="kategori"){echo " class='active'";} ?>><a href="<?php echo site_url('data/kategori'); ?>"><i class="fa fa-arrow-circle-right"></i> Data Kategori</a></li>
			<li<?php if($this->uri->segment(1)=="data" && $this->uri->segment(2)=="pelanggan"){echo " class='active'";} ?>><a href="<?php echo site_url('data/pelanggan'); ?>"><i class="fa fa-arrow-circle-right"></i> Data Pelanggan</a></li>
          </ul>
        </li>
        <li class="treeview<?php if($this->uri->segment(1)=="transaksi"){echo " active";} ?>">
          <a href="<?php echo site_url('transaksi'); ?>">
            <i class="fa fa-exchange"></i>
            <span>Data Transaksi</span>
          </a>
        </li>
		<?php if($role == '1' || $role == '2'): ?>
		<li class="treeview<?php if($this->uri->segment(1)=="laporan"){echo " active";} ?>">
          <a href="<?php echo site_url('laporan'); ?>">
            <i class="fa fa-search"></i>
            <span>Laporan</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li<?php if($this->uri->segment(1)=="laporan" && $this->uri->segment(2)=="sekolah"){echo " class='active'";} ?>><a href="<?php echo site_url('laporan/sekolah'); ?>"><i class="fa fa-arrow-circle-right"></i> Laporan Sekolah</a></li>
			<li<?php if($this->uri->segment(1)=="laporan" && $this->uri->segment(2)=="profit"){echo " class='active'";} ?>><a href="<?php echo site_url('laporan/profit'); ?>"><i class="fa fa-arrow-circle-right"></i> Laporan Profit</a></li>
			<li<?php if($this->uri->segment(1)=="laporan" && $this->uri->segment(2)=="mou"){echo " class='active'";} ?>><a href="<?php echo site_url('laporan/mou'); ?>"><i class="fa fa-arrow-circle-right"></i> Laporan MOU</a></li>
			<li<?php if($this->uri->segment(1)=="laporan" && $this->uri->segment(2)=="transaksi"){echo " class='active'";} ?>><a href="<?php echo site_url('laporan/transaksi'); ?>"><i class="fa fa-arrow-circle-right"></i> Laporan Transaksi</a></li>
          </ul>
        </li>
		<?php if($role == '1'): ?>
		<li class="treeview<?php if($this->uri->segment(1)=="pengaturan"){echo " active";} ?>">
          <a href="<?php echo site_url('pengaturan'); ?>">
            <i class="fa fa-gears"></i>
            <span>Pengaturan</span>
          </a>
        </li>
		<li class="treeview<?php if($this->uri->segment(1)=="users"){echo " active";} ?>">
          <a href="<?php echo site_url('users'); ?>">
            <i class="fa fa-users"></i>
            <span>Pengguna</span>
          </a>
        </li>
		<?php endif; ?>
		<?php endif; ?>
		<li class="treeview">
          <a href="<?php echo site_url('logout'); ?>" onclick="return logout(event, this);">
            <i class="fa fa-sign-out"></i>
            <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->