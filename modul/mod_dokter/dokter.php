<?php
$aksi="../apotek/modul/mod_dokter/aksi_dokter.php";
switch($_GET[act]){
  // Tampil suppllier
  default:
   	?>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/datatables.min.js"></script>
<!-- <script src="assets/js/dataTables/datatables.min.js"></script> -->
<script>
	$(document).ready(function () {
		$('.datatable-jquery').dataTable({
			sDom: 'lBfrtip',
			columnDefs: [{
					className: 'text-center',
					targets: [0, 1, 4, 6]
				},
				{
					width: "7%",
					targets: [0]
				},
				{
					orderable: false,
					targets: [6]
				}
			],
		});
	});
</script>

<div class="pagetitle" style="position: relative;">
	<h1>Master Dokter</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Master</a></li>
			<li class="breadcrumb-item active"><a href="#">Dokter</a></li>
			
		</ol>
	</nav>
</div><!-- End Page Title -->

<section class="section">
	<div class="row">
		<div class="col-lg-12">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title p-0" style="display: inline-block">Tabel Dokter</h5>
					<button type="button"
						style="margin-right: 10px; position: absolute; right: 12px; top: 13px; box-shadow: 0 2px 6px #ffc473; background: #ffa426; color: white; font-size: 13px"
						class="btn btn-warning" onclick="window.location.href='dokteradd';"><i
							class="fa fa-plus mr-1"></i>
						Tambah Doktor</button>
				</div>
				<div class="card-body mt-3">
					<div class="table-responsive">
						<table class="table table-striped table-hover datatable-primary datatable-jquery" width="100%">
							<thead>
								<tr>
									<th scope="col">No.</th>
									<th scope="col">Id Dokter</th>
									<th scope="col">Nama Dokter</th>
									<th scope="col">Kota</th>
									<th scope="col">No. Telp</th>
									<th scope="col">Alamat</th>
									<th scope="col" style="width: 15%;">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php		
								$tampil=mysql_query("SELECT * FROM dokter ORDER BY nm_dokter");
								$no=1;
								while($r = mysql_fetch_array($tampil)){
									echo"<tr class='odd gradeX'>
									<td>$no</td>
									<td>$r[id_dokter]</td>
									<td>$r[nm_dokter]</td>
									<td>$r[kota]</td>
									<td>$r[no_hp]</td>
									<td>$r[alamat]</td>
									<td>
										<button class='btn btn-info btn-sm mr-1'><a style='color: white;' href=dokteredit.$r[id_dokter]><i class='fa fa-edit'></i></a></button>
										<button class='btn btn-danger btn-sm'><a style='color: white'; Onclick=\"deleteDokter('$aksi', '$r[id_dokter]', '$r[nm_dokter]')\"><i class='bi bi-trash-fill'></i></a></button>
									</td>";
								$no++;
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<script>
	function deleteDokter(aksi, id, nama) {
		swal({
				title: 'Apakah anda yakin?',
				text: `Apakah anda yakin akan menghapus data ${nama} dari daftar Dokter ?`,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					window.location.href = `${aksi}?op=delete&kode=${id}`;
				}
			});
	}
</script>
<?php

break;
	//Tambah dokter (penyuplai obat-obtan)
	case "tambahdokter":
    ?>

<div class="pagetitle" style="position: relative;">
	<h1>Master Dokter</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Master</a></li>
			<li class="breadcrumb-item"><a href="dokter">Dokter</a></li>
			<li class="breadcrumb-item active"><a href="#">Tambah Dokter</a></li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<section class="section">
	<div class="row">
		<div class="col-lg-10">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title p-0" style="display: inline-block">Tambah Dokter</h5>
				</div>
				<div id="pesan"></div>
				<div class="card-body mt-3">
					<div class="row" style="gap: 11px 0">
                        <div class="col-12 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label>Id Dokter</label>
                                <input type="text" name="id_dokter" id="id_dokter" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-5 col-lg-5">
                            <div class="form-group">
                                <label>Nama Dokter</label>
                                <input type="text" name="nm_dokter" id="nm_dokter" class="form-control">
                            </div>
                        </div>
						<div class="col-12 col-md-2 col-lg-2">
							<div class="form-group">
								<label>No. Telp</label>
								<input type="text" name="no_hp" id="no_hp" class="form-control">
							</div>
						</div>
						<div class="col-12 col-md-3 col-lg-3">
							<div class="form-group">
								<label>Kota</label>
								<input type="text" name="kota" id="kota" class="form-control">
							</div>
						</div>
						<div class="col-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="alamat" style="height: 90px;" id="alamat" class="form-control"></textarea>
							</div>
						</div>
                    </div>
				</div>
				<div class="modal-footer bg-whitesmoke p-3" style="border: 1px solid #ebeef4; gap: 10px">
                    <button type="button" class="btn btn-secondary" onClick="self.history.back()">Batal</button>
                    <button type="button" id="simpan_dokter" class="btn btn-warning">Simpan</button>
                </div>
			</div>
		</div>
	</div>
</section>
	<?php
break;
	//edit dokter (penyuplai obat-obtan)
	case "editdokter":
	?>
<div class="pagetitle" style="position: relative;">
	<h1>Master Dokter</h1>
	<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Master</a></li>
			<li class="breadcrumb-item"><a href="dokter">Dokter</a></li>
			<li class="breadcrumb-item active"><a href="#">Edit Dokter</a></li>
		</ol>
	</nav>
</div><!-- End Page Title -->

<section class="section">
	<div class="row">
		<div class="col-lg-10">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title p-0" style="display: inline-block">Edit Dokter</h5>
				</div>
				<div id="pesan"></div>
				<div class="card-body mt-3">
					<div class="row" style="gap: 11px 0">
					<?php
						$edit=mysql_query("SELECT * FROM dokter WHERE id_dokter='$_GET[id]'");
						$r=mysql_fetch_array($edit);
						echo "
                        <div class='col-12 col-md-2 col-lg-2'>
                            <div class='form-group'>
                                <label>Id Supplier</label>
                                <input type='text' value='$r[id_dokter]' name='id_dokter' id='id_dokter' class='form-control'>
                            </div>
                        </div>
                        <div class='col-12 col-md-5 col-lg-5'>
                            <div class='form-group'>
                                <label>Nama Supplier</label>
                                <input type='text' name='nm_dokter' value='$r[nm_dokter]' id='nm_dokter' class='form-control'>
                            </div>
                        </div>
						<div class='col-12 col-md-2 col-lg-2'>
							<div class='form-group'>
								<label>No. Telp</label>
								<input type='text' name='no_hp' id='no_hp' value='$r[no_hp]' class='form-control'>
							</div>
						</div>
						<div class='col-12 col-md-3 col-lg-3'>
							<div class='form-group'>
								<label>Kota</label>
								<input type='text' name='kota' id='kota' value='$r[kota]' class='form-control'>
							</div>
						</div>
						<div class='col-12 col-md-12 col-lg-12'>
							<div class='form-group'>
								<label>Alamat</label>
								<textarea name='alamat' style='height: 90px;' id='alamat' class='form-control'>$r[alamat]</textarea>
							</div>
						</div>";
						?>
                    </div>
				</div>
				<div class="modal-footer bg-whitesmoke p-3" style="border: 1px solid #ebeef4; gap: 10px">
                    <button type="button" class="btn btn-secondary" onClick="self.history.back()">Batal</button>
                    <button type="button" id="update_dokter" class="btn btn-warning">Simpan</button>
                </div>
			</div>
		</div>
	</div>
</section>
<?php	
break;
  
}
?>