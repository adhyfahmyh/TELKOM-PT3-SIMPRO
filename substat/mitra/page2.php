<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="mitra"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Page</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<script src="../../js/jquery-1.11.3.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/mitra.css">
</head>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="mitra.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>
		</div>
      	<div class="logout">
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')" style="border:none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page2.php" class="pageactive"><h4><strong>Report</strong></h4></a>
      		<a href="page1.php" class=""><h4><strong>Progres</strong></h4></a>
      		<a href="page.php" class=""><h4><strong>Update</strong></h4></a>
      	</div>
    </div>
   <?php
    	include '../../include/connection.php';
        $page = isset($_GET['page'])?$_GET['page']:1;
	    if ($page==""||$page=="1") {
	    	$page1=0;
	    }else{
	    	$page1=($page*10)-10;
	    }

	?>
    <div class="container">
    	<ul class="tabs">
			<li>
				<input type="radio" name="tabs" id="tab1" checked/>
				<label for="tab1">Tabel Mitra</label>
				<div id="tab-content1" class="tab-content">
					<table class="tableuser" width="1000px">
							<tr>
								<th>No.</th>
								<th>ID Progress</th>
								<th>ID Order</th>
								<th>Status survey</th>
								<th>Nama Project</th>
								<th>Status Pekerjaan Fisik</th>
								<th>Status UT</th>
								<th>Nama  ODP</th>
								<th>Keterangan</th>
							</tr>
							<tbody>
								<?php
								$perpage = 10;
								if(isset($_GET['page'])){
									$page = $_GET['page'];
								}else{
									$page = 1;
								}
								if($page > 1){
									$start = ($page * $perpage) - $perpage;
								}else{
									$start = 0;
								}
									include '../../include/connection.php';
									$query = "SELECT * FROM progres limit $start,$perpage";
									$result = mysqli_query($conn, $query);
									$no=1;
									while($row = mysqli_fetch_array($result)){
									$id_progres	= $row['id_progres'];
									$id_order 	= $row['id_order'];
									$ssurvey 	= $row['ssurvey'];
									$nproject	= $row['nproject'];
									$spfisik 		= $row['spfisik'];
									$sut 	= $row['sut'];
									$namaodp 	= $row['namaodp'];
									$Keterangan 	= $row['keterangan'];
									echo "<tr>
									<td align='center'>$no</td>
									<td>$id_progres</td>
									<td>$id_order</td>
									<td>$ssurvey</td>
									<td>$nproject</td>
									<td>$spfisik</td>
									<td>$sut</td>
									<td>$namaodp</td>
									<td>$Keterangan</td>";?>
								</tr>
							<?php
									$no++;
									}
									if (empty($id_progres)) {
										echo '<tr>';
										echo '<td colspan="100%">Data belum tersedia</td>'; 
										echo '</tr>';
									}
							?>
							</tbody>
					</table>
					<?php
						$query1	= "SELECT * FROM progres ";
						$result1 = mysqli_query($conn, $query1);
						$count 	= mysqli_num_rows($result1);
						$a 		= $count/10;
						$a 		= ceil($a);
						if (!isset($_POST['search'])) {?>
							<div class="clearfix">
								<div class="hint-text">Menampilkan <b><?php echo $page;?></b>, dari <b><?php echo $a;?></b> halaman</div>
								<ul class="pagination">
							<?php 
								for ($b=1; $b <=$a ; $b++){ ?>
									<li class="page-item"><a href="page2.php?page=<?php echo $b;?>"<?php 
									if ($page == $b) {
										echo 'class="pageactive"';}?>><strong><?php echo $b."";?></strong></a></li><?php
									}
						}?>
							</ul>
						</div>
				</div>
			</li>
					<li>
						<input type="radio" name="tabs" id="tab3" />
						<label for="tab3">Table Optima</label>
						
						<div id="tab-content3" class="tab-content">
						<table class="tableuser" width="1000px">
								<tr>
									<th>No.</th>
									<th>ID Order</th>
									<th>ID Project</th>
									<th>Nama Mitra</th>
									<th>Nama Optima</th>
									<th>No. Telp Optima</th>
									<th>Waktu Order</th>
									<th>Tanggal Go Live</th>
								</tr>
								<tbody>
									<?php
										$no 		=1;
										include '../../include/connection.php';
										$query = "SELECT * FROM optima";
										$result = mysqli_query($conn, $query);
										while($row = mysqli_fetch_array($result)){
										$id_order	= $row['id_order'];
										$idproject 	= $row['idproject'];
										$nmitra 	= $row['nmitra'];
										$nama 		= $row['nama'];
										$notelp 	= $row['notelp'];
										$tglorder 	= $row['tglorder'];
										$tglgolive 	= $row['tglgolive'];
										echo "<tr>
										<td align='center'>$no</td>
										<td>$id_order</td>
										<td>$idproject</td>
										<td>$nmitra</td>
										<td>$nama</td>
										<td>$notelp</td>
										<td>$tglorder</td>
										<td>$tglgolive</td>";?>
								</tr>
								<?php
										$no++;
									}
									if (empty($id_order)) {
										echo '<tr>';
										echo '<td colspan="100%">Data belum tersedia</td>'; 
										echo '</tr>';
									}
								?>
								</tbody>
							</table>

						</div>
					</li>
					<li>
				<input type="radio" name="tabs" id="tab2"/>
				<label for="tab2">Tabel User</label>
				<div id="tab-content2" class="tab-content" style="overflow-x:auto;">
					
					<table class="tableuser">
						<tr>
							<th>No.</th>
							<th>Tanggal Input</th>
							<th>ID Project</th>
							<td>Witel</td>
							<th>Info HS</th>
							<th>Nama User</th>
							<th>Alamat</th>
							<th>Longitude</th>
							<th>Latitude</th>
							<th>Jumlah ODP</th>
							<th>No. UNSC</th>
							<th>Keterangan</th>
						</tr>
						<tbody>
							<?php
								include '../../include/connection.php';
								$query = "SELECT * FROM pengajuan";
								$result = mysqli_query($conn, $query);
								$no=1;
								while($row = mysqli_fetch_array($result)){
									$tanggalinput	= $row['tanggalinput'];
									$idproject 	= $row['idproject'];
									$witel 		= $row['witel'];
									$infohs 	= $row['infohs'];
									$infosto	= $row['infosto'];
									$nama_user 	= $row['nama_user'];
									$alamat 	= $row['alamat'];
									$koorlong 	= $row['koorlong'];
									$koorlati 	= $row['koorlati'];
									$jodp 		= $row['jodp'];
									$nounsc 	= $row['nounsc'];
									$keterangan = $row['keterangan'];
									echo "<tr>
									<td align='center'>$no</td>
									<td align='center'>$tanggalinput</td>
									<td align='center'>$idproject</td>
									<td>$infohs</td>
									<td>$witel</td>
									<td>$infosto</td>
									<td>$nama_user</td>
									<td>$koorlong</td>
									<td>$koorlati</td>
									<td align='center'>$jodp</td>
									<td>$nounsc</td>
									<td>$keterangan</td>";?>
								</tr>
						<?php
								$no++;}
								if (empty($idproject)) {
									echo '<tr>';
									echo '<td colspan="100%">Data belum tersedia</td>'; 
									echo '</tr>';
								}
						?>
						</tbody>

					</table>

						
				</div>
					</li>
		</ul>
	</div>

</body>
</html>    