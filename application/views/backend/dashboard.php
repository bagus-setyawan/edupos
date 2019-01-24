<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<?php if(!empty($notice)): ?>
		<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<h4><i class="icon fa fa-info-circle"></i> Info!</h4>
					<?php echo $notice['value']; ?>
			</div>
		</div>
		</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3>Rp. <?php 
						$jmljual = substr($listcount['jmljual'], 0, -9);
						echo(!empty($jmljual) ? $jmljual:0);
					?>jt</h3>
				  <p>Penjualan</p>
				</div>
				<div class="icon">
				  <i class="fa fa-arrow-right"></i>
				</div>
				<a href="<?php echo site_url('data/sales'); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3>Rp. <?php 
						$jmlbeli = substr($listcount['jmlbeli'], 0, -9);
						echo(!empty($jmlbeli) ? $jmlbeli:0);
					?>jt</h3>
				  <p>Pembelian</p>
				</div>
				<div class="icon">
				  <i class="fa fa-arrow-left"></i>
				</div>
				<a href="<?php echo site_url('data/sekolah'); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-purple">
				<div class="inner">
				  <h3><?php echo $listcount['jmlvendor']; ?></h3>
				  <p>Vendor</p>
				</div>
				<div class="icon">
				  <i class="fa fa-suitcase"></i>
				</div>
				<a href="<?php echo site_url('data/mou'); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-maroon">
				<div class="inner">
				  <h3><?php echo $listcount['jmlprod']; ?></h3>
				  <p>Barang</p>
				</div>
				<div class="icon">
				  <i class="fa fa-dropbox"></i>
				</div>
				<a href="<?php echo site_url('data/produk'); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3><?php echo $listcount['jmlusers']; ?></h3>
				  <p>Pengguna</p>
				</div>
				<div class="icon">
				  <i class="fa fa-users"></i>
				</div>
				<a href="<?php echo site_url('data/transaksi'); ?>" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-blue">
				<div class="inner">
				  <h3>Rp. <?php 
						//$jmlterima = substr($listcount['jmlterima'], 0, -9);
						//echo(!empty($jmlterima) ? $jmlterima:0);
					?>jt</h3>
				  <p>Penerimaan</p>
				</div>
				<div class="icon">
				  <i class="fa fa-arrow-left"></i>
				</div>
				<a href="javascript:void(0)" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3>Rp. <?php 
						//$jmlkeluar = substr($listcount['jmlkeluar'], 0, -9);
						//echo(!empty($jmlkeluar) ? $jmlkeluar:0);
					?>jt</h3>
				  <p>Pengeluaran</p>
				  
				</div>
				<div class="icon">
				  <i class="fa fa-arrow-right"></i>
				</div>
				<a href="javascript:void(0)" class="small-box-footer">Lihat Detail <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<div class="box box-primary">
					<div class="box-header with-border">
					  <h4 class="box-title">Resume bulan <?php echo ucfirst(date('F'));?></h4>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					  </div>
					</div>
					<div class="box-body">
					  
					</div>
				  </div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary box-solid">
					<div class="box-header">
						<h3 class="box-title"><i class="fa fa-paper-plane-o"></i> Performa hari ini...</h3>
					</div>
					<div class="box-body">
						
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title"><i class="fa fa-clock-o"></i> Histori aktifitas</h3>
					</div>
					<div class="box-body" style="background-color:#d0d0d0;">
						<ul class="timeline">
						<?php if(isset($logs)): 
								$tmp = "";
								foreach($logs as $log):
						?>
						<?php if(date('d-m-Y', strtotime($log['created_at'])) != $tmp): ?>
						<li class="time-label">
							<span class="bg-blue">
								<?php echo date('d-m-Y', strtotime($log['created_at'])); ?>
							</span>
						</li>
						<?php endif; ?>
						<li>
							<i class="<?php echo $log['class']; ?>"></i>
							<div class="timeline-item">
								<span class="time"><i class="fa fa-clock-o"></i> <span class="moment"><?php echo $log['created_at']; ?></span></span>

								<h3 class="timeline-header"><?php echo $log['fullname']." ".$log['judul']; ?></h3>

								<?php if(!empty($log['isi'])) : ?>
								<div class="timeline-body">
									<?php echo $log['isi']; ?>
								</div>
								<?php endif; ?>
							</div>
						</li>
						<!-- END timeline item -->
					<?php 
					$tmp = date('d-m-Y', strtotime($log['created_at']));;
					endforeach;
					endif; ?>
					</ul>
					</div>
				</div>
			</div>
		</div>
		