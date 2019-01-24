<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Dialog...</h4>
	  </div>
	  <div class="modal-body">
		
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
		<button type="button" class="btn btn-primary" name="btnsave" ><i class="fa fa-save"></i> Simpan</button>
	  </div>
	  </form>
	</div>
  </div>
</div>
<div class="row">
	<input type="hidden" id="urlcart" value="<?php echo site_url('ajax/addtocart'); ?>" />
	<input type="hidden" id="urlinfo" value="<?php echo site_url('ajax/prodinfo'); ?>" />
	<div class="col-md-8">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
			<?php if(!empty($listkategori)){
				$no = 1;
				foreach($listkategori as $kat){
					if($no == 1){
						echo "<li class='active'><a href='#menu_$no' data-toggle='tab'>".ucfirst($kat['nama_kategori'])."</a></li>";
					}else{
						echo "<li><a href='#menu_$no' data-toggle='tab'>".ucfirst($kat['nama_kategori'])."</a></li>";
					}
					$no++;
				}
			}else{
				echo "<li class='active'><a href='#menu_$no' data-toggle='tab'>Kategori Kosong</a></li>";
			}
			?>
			  <li class="pull-left header"><i class="fa fa-th"></i> Daftar Menu</li>
			</ul>
			<div class="tab-content">
			<?php 
			$no = 1;
			if(!empty($listkategori)) :
				foreach($listkategori as $kat) : 
					if($no == 1){
						$aktif = " active";
					}else{
						$aktif = "";
					}?>
			  <div class="tab-pane<?php echo $aktif; ?>" id="menu_<?php echo $no; ?>">
				<div class="row">
					<?php if(!empty($listproduk)) :
					foreach($listproduk as $p):
							if($p['nama_kategori'] == $kat['nama_kategori']) : ?>
					<div class="col-md-3">
						<div class="thumbnail" style="height:auto;">
							<img alt="Foto pos" style="height: auto; width: 100%; display: inline-block;" src="<?php echo base_url('assets/images/'.$p['foto']); ?>">
							<div class="caption">
								<h5><b><?php echo ucfirst(strtolower($p['nama_barang'])); ?></b></h5>
								<p>Rp. <?php echo format_rupiah($p['harga_jual'])."/".$p['satuan']; ?></p>
								<p>
								<input type="hidden" name="nama-<?php echo $p['id']; ?>" value="<?php echo $p['nama_barang']; ?>" />
								<input type="hidden" name="harga-<?php echo $p['id']; ?>" value="<?php echo $p['harga_jual']; ?>" />
								<div class="input-group">
									<span class="input-group-btn">
									  <button type="button" class="btn btn-default btnminusone">-</button>
									</span>
									<input type="text" name="qty-<?php echo $p['id']; ?>" class="form-control text-center inqty" value=1 />
									<span class="input-group-btn">
									  <button type="button" class="btn btn-default btnplusone">+</button>
									</span>
								</div>
								</p><p>
								<button onclick="addtocart(<?php echo $p['id']; ?>)" class="btn btn-danger btn-xs btn-block" role="button"><i class="fa fa-shopping-cart"></i> Pesan</button>
								<button onclick="infoprod(<?php echo $p['id']; ?>)" class="btn btn-info btn-xs btn-block" role="button"><i class="fa fa-info"></i> Info</button></p>
								<textarea name="ket-<?php echo $p['id']; ?>" class="form-control ket" placeholder="Catatan"></textarea>
							</div>
						</div>
					</div>
					<?php 
					endif;
					endforeach;
					else :
						echo "<div class='col-md-12'><p>Produk belum ada</p></div>";
					endif; ?>
				</div>
			  </div>
			  <?php $no++;endforeach;
					else : ?>
					Produk belum ada.
				<?php endif; ?>
			</div>
			<!-- /.tab-content -->
		  </div>
		  <!-- nav-tabs-custom -->
	</div>
	<div class="col-md-4">
		<?php if(!empty(ses_data('stat', true))):?>
		  <div class="alert alert-<?php echo $this->session->flashdata('stat'); ?> alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<h4><i class="icon fa fa-bell-o"></i> Info!</h4>
				<?php echo ses_data('msg', true); ?>
		  </div>
		  <?php endif; ?>
		<div class="box box-primary box-solid">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-list"></i> Daftar Menu</h3>
			</div>
			<div class="box-body">
				<input type="hidden" id="urlloadcart" value="<?php echo site_url('ajax/load_cart'); ?>" />
				<div id="load_cart">
				</div>
			</div>
			<div class="box-footer">
				<button type="button" class="btn btn-md btn-success" onclick="add_data('barang', '<?php echo site_url("ajax/add_data"); ?>')"><i class="fa fa-dollar"></i> Bayar</button>
				<button type="button" class="btn btn-md btn-danger" onclick="clearcart('<?php echo site_url("ajax/clear_cart"); ?>')"><i class="fa fa-trash"></i> Hapus</button>
			</div>
		</div>
	</div>
</div>