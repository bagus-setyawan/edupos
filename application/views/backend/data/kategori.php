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
						<h3 class="box-title"><i class="fa fa-list"></i> Daftar Kategori</h3>
					</div>
					<div class="box-body">
						<table id="listkategori" class="table table-bordered datatable">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nama Kategori</th>
								<th>Deskripsi</th>
								<th>Options</th>
							</tr>
						<thead>
						<tbody>
						<?php foreach($listkategori as $kategori): ?>
							<tr>
								<td><?php echo $kategori['id']; ?></td>
								<td><?php echo $kategori['nama_kategori']; ?></td>
								<td><?php echo $kategori['deskripsi']; ?></td>
								<td>
									<button type="button" class="btn btn-xs btn-success" onclick="edit_data('kategori', '<?php echo site_url("ajax/edit_data"); ?>', '<?php echo $kategori['id']; ?>')"><i class="fa fa-pencil"></i> Edit</button>
									<button type="button" class="btn btn-xs btn-danger" onclick="delete_data('kategori', '<?php echo site_url("ajax/delete_data"); ?>', '<?php echo $kategori['id']; ?>')"><i class="fa fa-trash"></i> Hapus</button>
								</td>
							</tr>
						 <?php endforeach; ?>
						 </tbody>
						 </table>
					</div>
					<div class="box-footer">
						<button type="button" class="btn btn-md btn-primary" onclick="add_data('kategori', '<?php echo site_url("ajax/add_data"); ?>')"><i class="fa fa-plus"></i> Tambah</button>
					</div>
				</div>
			</div>
		</div>