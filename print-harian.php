<?php 
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
	$hasil = $lihat -> jumlah_nota();
	
?>
<html>
	<head>
		<title>LAPORAN PENJUALAN </title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
	</head>
	<body>
		<script>window.print();</script>
		<div class="container-fluid">
			<p><?php echo $toko['nama_toko'];?></p>
			<p><?php echo $toko['alamat_toko'];?></p>
			<hr color="red" height="12" >
			<p>Dicetak pada : <?php  echo date("j F Y, G:i");?></p>
			<p>Kasir : <?php  echo $_GET['nm_member'];?></p>
			<table class="table table-bordered" >
				<tr>
					<th bgcolor="grey" style="width:5%;"> No</th>
					<th bgcolor="grey" style="width:18%;"> Barcode</th>
					<th bgcolor="grey" style="width:20%;"> Nama </th>
					<th bgcolor="grey" style="width:8%;"> Jumlah</th>
					<th bgcolor="grey" style="width:9%;"> Total</th>
					<th bgcolor="grey" style="width:9%;"> Transaksi</th>
					<th bgcolor="grey" style="width:20%;"> Kasir</th>
					<th bgcolor="grey" style="width:20%;"> Terjual</th>
				</tr>
				<?php $no=1; $hasil = $lihat -> jual();?>
					<?php foreach($hasil as $isi){;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $isi['barcode'];?></td>
							<td><?php echo $isi['nama_barang'];?></td>
							<td><?php echo $isi['jumlah'];?> </td>
							<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
							<td><?php echo $isi['transaksi'];?></td>
							<td><?php echo $isi['cashier'];?></td>
							<td><?php echo $isi['tanggal_input'];?></td>
						</tr>
					<?php $no++; }?>
			</table>
		</div>
		<br>
		<p><?php $hasil = $lihat -> jumlah_nota(); ?>
			Total : Rp.<?php echo number_format($hasil['bayar']);?>,-</p>
		<p><?php $hasil = $lihat -> jumlah_hari_ini(); ?>
			Barang keluar  <?php echo $hasil['semua'];?></p><br><br>
		<table>
		<tr colspan='2'>
		<td width="1200">
		<p align="left">
		Shop Owner,
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			( <?php echo $toko['nama_pemilik'];?> )
			</td>
			</p><td>
			<td width="50%">
			<p align="right">
			Cashier,
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			( <?php echo $_GET['nm_member']; ?> )
			</p></td>
			</tr>
			</table>
	</body>
</html>
