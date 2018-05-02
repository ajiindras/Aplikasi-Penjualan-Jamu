<?php 
  $id = $_SESSION['admin']['id_member'];
  $hasil_profil = $lihat -> member_edit($id);
?>

<style>
	a {
		margin-left : 10px;
		align		: center;}
  </style>
	
	<div class="bg-shadow" style="background:rgba(0,0,0,0.3);z-index:99999;position:fixed;width:100%;height:6000px;"></div>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Product</h3>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Add Stock Success !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Saving Success !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Delete Success !</p>
						</div>
						<?php }?>
						<table>
							<tr>
								<td><button id="tombol-simpan" onclick="clickModals()" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New Product </button></td>
							</tr>
						</table>
						<br/>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered table-hover" style="width:100%" id="example1">
								<thead>
									<tr style="background:pink;color:#333;">
										<th style="width:15%">Product Barcode</th>
										<th style="width:16%">Product Category</th>
										<th style="width:13%">Product Name</th>
										<th style="width:15%">Product Merk</th>
										<th>Price</th>
										<th>Stock</th>
										<th style="width:20%">Product Describe</th>
										<th style="width:22%">Created</th>
										<th style="width:15%">Creator</th>
										<th style="width:8%">Manipulation</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$hasil = $lihat -> barang();
									$no=1;
									foreach($hasil as $isi){
								?>
									<tr>
										<td><?php echo $isi['barcode'];?></td>
										<td><?php echo $isi['nama_kategori'];?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['merk'];?></td>
										<td>Rp.<?php echo number_format($isi['harga_jual']);?>,-</td>
										<td>
											<?php if($isi['stok'] <= '0'){?>
												<span class="label label-danger label-mini">Sold Out</span>
											<?php }else{?>
												<?php echo $isi['stok'];?>
											<?php }?>
										</td>
										<td><?php echo $isi['keterangan'];?></td>
										<td><?php if($isi['tgl_update'] == NULL){?>
												<?php echo $isi['tgl_input'];?>
											<?php }else{?>
												<?php echo $isi['tgl_update'];?>
											<?php }?>
										</td>
										<td><?php echo $isi['nm_member'];?></td>
										<td>
											<?php if($isi['stok'] < '3'){?>
												<form method="POST" action="fungsi/edit/edit.php?stok=edit">
													<input type="number" min="1" name="restok" class="form-control" placeholder="Masukkan Jumlah Stock" title="Hanya Angka">
													<input type="hidden" name="member" value="<?php echo $hasil_profil['id_member'];?>" class="form-control">
													<input type="hidden" name="id" value="<?php echo $isi['id_barang'];?>" class="form-control">
													<button class="btn btn-warning btn-xs" title="Restock"><i class="fa fa-refresh ">
													</i></button>
												</form>
											<?php }else{?>
											<a href="index.php?page=barang/details&barang=<?php echo $isi['id_barang'];?>" title="Details"><button class="btn btn-success btn-xs"><i class="fa fa-eye "></i></button></a>
											<a href="index.php?page=barang/edit&barang=<?php echo $isi['id_barang'];?>" title="Edit"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
										    <a href="fungsi/hapus/hapus.php?barang=hapus&id=<?php echo $isi['id_barang'];?>" onclick="javascript:return confirm('Are You Sure to Delete Data ?');" title="Delete"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i></button></a>
											<?php }?>
										</td>
									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
							<div class="clearfix" style="padding-top:27%;"></div>
						</div>
					<!-- end view barang -->
					<!-- tambah barang MODALS-->
					<div class="modal-create" style="z-index:9999999; position:absolute; margin:0 auto; padding:0; top:0; width:85%;">
						<div class="panel panel-default" style="border:0px;">
							<div class="panel-heading">
								<h4><i class="fa fa-user-plus"></i>  ADD PRODUCT
									<a class="pull-right">
										<button type="submit" class="btn btn-sm btn-danger" onclick="cancelModals()" id="batal">Cancel</button>
									</a>
								</h4>
							</div>
							<div class="panel-body">
								<div class="box-content">
									<table class="table table-striped bordered">
										<form action="fungsi/tambah/tambah.php?barang=tambah" method="POST">
										 <tr>
												<td>Product Barcode</td>
												<td><input type="text"  placeholder="Barcode " class="form-control"  name="barcode" autofocus></td>
											</tr> 
											<tr>
												<td>Product Category</td>
												<td>
												<select name="kategori" class="form-control btn btn-default dropdown-toggle" data-toggle="dropdown">
													<option value="#">-SELECT-</option>
													<?php  $kat = $lihat -> kategori(); foreach($kat as $isi){ 	?>
													<option value="<?php echo $isi['id_kategori'];?>"><?php echo $isi['nama_kategori'];?></option>
													<?php }?>
												</select>
												</td>
											</tr>
											<tr>
												<td>Product Name</td>
												<td><input type="text" style="width:100%;text-transform:uppercase" class="form-control" name="nama"></td>
											</tr>
											<tr>
												<td>Product Merk</td>
												<td>
													<select name="merk" class="form-control btn btn-default dropdown-toggle" data-toggle="dropdown">
														<option value="#">-SELECT-</option>
														<?php  $kat = $lihat -> merk(); foreach($kat as $isi){ 	?>
														<option value="<?php echo $isi['id_merk'];?>"><?php echo $isi['merk'];?></option>
														<?php }?>
													</select>
											</tr>
											<tr>
												<td>Product Purchase</td>
												<td><input type="number" placeholder="Harga beli" class="form-control" name="beli"></td>
											</tr>
											<tr>
												<td>Product Sale</td>
												<td><select name="jual" class="form-control btn btn-default dropdown-toggle" data-toggle="dropdown">
														<option value="#">-SELECT-</option>
														<?php  $jual = $lihat -> price(); foreach($jual as $isi){ 	?>
														<option value="<?php echo $isi['harga_jual'];?>"><?php echo $isi['harga_jual'];?></option>
														<?php }?>
													</select>
											</tr>
											<tr>
												<td>Unit</td>
												<td>
													<select name="satuan" class="form-control btn btn-default dropdown-toggle" data-toggle="dropdown">
														<option value="#">-SELECT-</option>
														<option value="PCS">PCS</option>
														<option value="BOX">BOX</option>
														<option value="PACK">PACK</option>
														<option value="BOTTLE">BOTTLE</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>Stock</td>
												<td><input type="number" min="1" Placeholder="Stock" class="form-control"  name="stok"></td>
											</tr>
											<tr>
												<td>Describe</td>
												<td><textarea style="width:100%;text-transform:uppercase" class="form-control" name="keterangan"></textarea></td>
											</tr>
											<tr>
												<td>Created</td>
												<td><input type="text" readonly="readonly" class="form-control" value="<?php echo  date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
												<input type="hidden" name="member" class="form-control" value="<?php echo $hasil_profil['id_member'];?>" readonly>
											<tr>
												<td></td>
												<td><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Save </button></td>
											</tr>
										</form>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
