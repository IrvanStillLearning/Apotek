<?php		
			require ('../../Inc/koneksi.php');
			$query=mysql_query("select kd_penj.kd_pjl,penjualan.id_product,barang.nama,
                                           penjualan.harga,penjualan.jumlah,penjualan.subtotal
                                           from penjualan,kd_penj,barang
                                           where kd_penj.kd_pjl=penjualan.id_transaksi and barang.kode=penjualan.id_product
                                           and penjualan.id_transaksi='$_GET[id]'") or die (mysql_error());
			$sql = mysql_fetch_array(mysql_query("SELECT * FROM kd_penj WHERE kd_pjl='$_GET[id]'")) or die ("query gagal");
			$no = 1;
			$pemilik=mysql_fetch_array(mysql_query("select nm_perusahaan,alamat from bigbook_perusahaan")) or die ("gagal");
			?>
<html>
	<head>
		<link href="../../css/cetak.css" rel="stylesheet">
		<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="../../js/jquery.shortcuts.min.js"></script>
		<script>
   $.Shortcuts.add({
    type: 'down',
    mask: 'p',
    handler: function() {
        window.print();
    }
   }).start();
   </script>
	</head>
	<body>
		<div class='span8  offset2'>
			<div id='nota'><fieldset><div class='kepala-nota'>
				<p><?php echo"$pemilik[nm_perusahaan]";?><br>
				<?php echo"$pemilik[alamat]";?></p><hr><hr style='color:#000;'></div>
				<div class='kanan-nota'>
                        Nota :<?php echo"$sql[kd_pjl]<span style='margin-left:10px;'></span>$sql[tanggal]";?>
                      </div>
					  <div id='scroll'><table class='nota'>
                                <thead>
                                    <tr>
										<th>No.</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
				<?php	$query=mysql_query("select kd_penj.kd_pjl,penjualan.id_product,barang.nama,
                                           penjualan.harga,penjualan.jumlah,penjualan.subtotal
                                           from penjualan,kd_penj,barang
                                           where kd_penj.kd_pjl=penjualan.id_transaksi and barang.kode=penjualan.id_product
                                           and penjualan.id_transaksi='$_GET[id]'") or die (mysql_error());
								$no=1;
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr class=body>
											<td align='center'>$no</td>
                                            <td>$r[2]</td>
                                            <td align='center'>$r[4]</td>
                                            <td>";echo"Rp&nbsp".number_format($r[5],2,',','.');echo"</td>
                                        </tr>";
									$no++;
								}
                                echo "<tr>
                                        <td colspan='5'><h4 align='right'></h4></td>
                                        <td colspan='5'><h4></h4></td>
                                    </tr>
                                    </table></div><hr><h3 style='float:right; margin-right:20px;'>Total&nbsp ";echo"Rp&nbsp".number_format($sql[total],2,',','.');echo"</h3>
									<p style='font-size:8pt;float:left; padding-top:35px;'>* barang yang sudah dibeli tidak bisa dikembalikan</br>
									<i class='icon-user'></i>Petugas :$sql[user]<p></fieldset></div>";?>
			</fieldset></div>
	</body>
</html>