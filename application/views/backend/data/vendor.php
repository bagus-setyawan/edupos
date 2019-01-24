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
			<div class="col-md-12">
				<?php if(!empty(ses_data('stat', true))):?>
				  <div class="alert alert-<?php echo $this->session->flashdata('stat'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
						<h4><i class="icon fa fa-bell-o"></i> Info!</h4>
						<?php echo ses_data('msg', true); ?>
				  </div>
				  <?php endif; ?>
				<div class="box box-primary box-solid">
					<div class="box-header">
						<h3 class="box-title"><i class="fa fa-table"></i> Daftar Vendor</h3>
					</div>
					<div class="box-body">
						<table id="listvendor" class="table table-bordered datatable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Logo</th>
								<th>Nama</th>
								<th>Telepon</th>
								<th>Alamat</th>
								<th>Options</th>
							</tr>
						<thead>
						<tbody>
						<?php foreach($listvendor as $vendor): ?>
							<tr>
								<td><?php echo $vendor['id']; ?></td>
								<td><?php echo $vendor['logo'] != "" ? "<img src='".site_url('assets/images/'.$vendor['logo'])."' class='img-responsive' />" : "Belum ada logo"; ?></td>
								<td><?php echo $vendor['nama_vendor']; ?></td>
								<td><?php echo $vendor['telepon']; ?></td>
								<td><?php echo $vendor['alamat']; ?></td>
								<td>
									<button type="button" class="btn btn-xs btn-default" onclick="view_data('vendor', '<?php echo site_url("ajax/view_data"); ?>', '<?php echo $vendor['id']; ?>')"><i class="fa fa-search"></i> Lihat</button>
									<button type="button" class="btn btn-xs btn-success" onclick="edit_data('vendor', '<?php echo site_url("ajax/edit_data"); ?>', '<?php echo $vendor['id']; ?>')"><i class="fa fa-pencil"></i> Edit</button>
									<button type="button" class="btn btn-xs btn-danger" onclick="delete_data('vendor', '<?php echo site_url("ajax/delete_data"); ?>', '<?php echo $vendor['id']; ?>')"><i class="fa fa-trash"></i> Hapus</button>
								</td>
							</tr>
						 <?php endforeach; ?>
						 </tbody>
						 </table>
					</div>
					<div class="box-footer">
						<button type="button" class="btn btn-md btn-primary" onclick="add_data('vendor', '<?php echo site_url("ajax/add_data"); ?>')"><i class="fa fa-plus"></i> Tambah</button>
					</div>
				</div>
			</div>
		</div>