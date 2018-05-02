<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> barang();
?>
<html>
	<head>
		<title>JAMU</title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container-fluid">
			<p>Dicetak oleh <i> <?php  echo $_GET['nm_member'];?></i> pada <?php  echo date("j F Y, G:i");?></p>
			<table class="table table-bordered" style="width:20%;font-size:13px;">
				<tr>
					<td style="width:3%;">No</td>
					<th>Barcode</th>
					<th>Category</th>
					<th>Name</th>
					<th style="width:15%;">Merk</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Describe</th>
					<th>Created</th>
					<th>Creator</th>
				</tr>
				<?php $no=1; foreach($hsl as $isi){?>
				<tr>
					<td><?php echo $no;?></td>
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
				</tr>
				<?php $no++; }?>
			</table>
		</div>
	</body>
</html>
