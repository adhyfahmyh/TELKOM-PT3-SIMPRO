<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="optima"){
    	die("<script>alert('Anda tidak memiliki hak akses!');window.location.href='../../logout.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Report | SIMPRO</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="../../js/jquery-1.11.3.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/optima.css"> 
	
</head>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="optima.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>
		</div>
      	<div class="logout">
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')" style="border:none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page4.php" class=""><h4><strong>Mitra</strong></h4></a>
      		<a href="page3.php" class=""><h4><strong>Optima</strong></h4></a>
      		<a href="page2.php" class="pageactive"><h4><strong>User</strong></h4></a>
      		<a href="page1.php" class=""><h4><strong>Pilih Mitra</strong></h4></a>
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

		if(isset($_POST['search'])){
		    $valueToSearch = $_POST['valuesearch'];
		    $query = "SELECT * FROM `pengajuan` WHERE CONCAT(`tanggalinput`,`idproject`,`witel`,`infohs`,`infosto`,`nama_user`,`alamat`,`koorlong`,`koorlati`,`jodp`,`nounsc`,`keterangan`) LIKE '%".$valueToSearch."%'";
		    $search_result 	= filterTable($query);
		    if (!$search_result) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		    
		}else {
		    $query = "SELECT * FROM pengajuan limit $page1,10";
		    $search_result = filterTable($query);
		}

		// function to connect and execute the query
		function filterTable($query)
		{
		    include '../../include/connection.php';
		    $filter_Result 	= mysqli_query($conn, $query);
		    
		    return $filter_Result;
		}

		?>
    <div class="container">
    	<div class="content1">
    		<div class="headtable">
    			<label><h2>Tabel User</h2></label>
    			<div class="tablething">
    				<form class="searh" method="POST">
	    				<input type="text" name="valuesearch" placeholder="Search here..">
	    				<input type="submit" name="search" value="GO">
	    			</form>
    			</div>
    		</div>
    		<div class="table" style="overflow-x:auto;">
    			<table class="tableuser" id="tableoptima">
	    			<tr>
	    				<th>No.</th>
	                    <th>Tanggal Input</th>
	                    <th>ID Project</th>
	                    <th>Witel</th>
	                    <th>Info HS</th>
	                    <th>STO</th>
	                    <th>Nama User</th>
	                    <th>Alamat</th>
	                    <th>Longitude</th>
	                    <th>Latitude</th>
	                    <th>Jumlah ODP</th>
	                    <th>No. UNSC</th>
	                    <th>Keterangan</th>
	                    <th>Options</th>
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
	                        $no=1;
	                        while($row = mysqli_fetch_array($search_result)){
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
	                            <td>$no</td>
	                            <td>$tanggalinput</td>
	                            <td>$idproject</td>
	                            <td>$witel</td>
	                            <td>$infohs</td>
	                            <td>$infosto</td>
	                            <td>$nama_user</td>
	                            <td>$alamat</td>
	                            <td>$koorlong</td>
	                            <td>$koorlati</td>
	                            <td>$jodp</td>
	                            <td>$nounsc</td>
	                            <td>$keterangan</td>";?>
	                     
	                        	<td>
	                            <a href="#editoptima1<?php echo $idproject;?>"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">border_color</i></a>
	                            <a href="#deleteoptima1<?php echo $idproject;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
	                            </td>
	                        </tr>
	                <div id="editoptima1<?php echo $idproject;?>" class="modal fade">
						<div class="modal-dialog" id="editoptima1dialog">
							<div class="modal-content">
								<form action="config/(optima)page2.php" method="post">
									<div class="modal-header" style="text-align:center;">	
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Edit project: <?php echo $idproject;?></h4>
									</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="witel">WITEL</label>
				                        <select name="witel" id="witel" required class="form-control" style="width: 50%; float: right;">
				                            <option selected hidden value="<?php echo $witel;?>"><?php echo $witel;?></option>
				                            <option value="Bandung">Bandung</option>
				                            <option value="Bandung Barat"> Bandung Barat</option>
				                            <option value="Karawang">Karawang</option>
				                            <option value="Sukabumi">Sukabumi</option>
				                            <option value="Tasikmalaya">Tasikmalaya</option>
				                        </select>
									</div>
									<div class="form-group">
										<input type="hidden" name="idproject" value="<?php echo $idproject;?>">
										<label>HS/DATEL:</label>
					                   	<select name="hsdatel" class="form-control" style="width: 50%; float: right;">
					               			<option selected hidden value="<?php echo $infohs;?>"><?php echo $infohs?></option>
					                        <option value="HS1">HS1</option>
					                        <option value="HS2">HS2</option>
					                        <option value="HS3">HS3</option>
					                        <option value="Datel Sumedang">Datel Sumedang</option>
					                   	</select>
									</div><hr>
									<div class="form-group">
				                        <label>Alamat:</label>
                    					<textarea type="text" name="alamat" class="form-control" value="<?php echo $alamat;?>" style="border-style:solid; padding: 5px; border-radius: 5px; border-width: 1px; border-color: grey;"><?php echo $alamat;?></textarea>
				                    </div><hr>
				                    <div class="form-group col-md-6"style="padding: 0px;">
				                    	<label class="grup" for="long"style="text-align: right;width: 10%;display: inline;">Longitude:</label>
					                    <input type="text" id="long" name="long" value="<?php echo $koorlong;?>"class="form-control"style="text-align: right;width: 98%;display: inline;">
				                    </div>
				                    <div class="form-group col-md-6" style="padding: 0px;">
				                    	<label for="lat"style="text-align:right;display: inline;margin-left: 2%;">Latitude:</label>
				                    	<input type="text" name="lat" id="lat" value="<?php echo $koorlati;?>" class="form-control" style="text-align: right;width: 98%;display: inline;float: right;" pattern="-.+" title="Missing '-' char">
				                    </div><hr>
				                    <div class="form-group">
				                        <label for="sto"> STO: </label>
					                    <select name="sto" class="form-control" id="sto" style="width: 50%; float: right;">
					                        <option selected hidden value="<?php echo $infosto;?>"><?php echo $infosto;?></option>
					                        <option value="CCD">CCD</option>
					                        <option value="LBG">LBG</option>
					                        <option value="DGO">DGO</option>
					                        <option value="HGH">HGH</option>
					                        <option value="GGK">GGK</option>
					                        <option value="TRG">TRG</option>
					                        <option value="KPO">KPO</option>
					                        <option value="TLE">TLE</option>
					                        <option value="CJA">CJA</option>
					                        <option value="UBR">UBR</option>
					                        <option value="SMD">SMD</option>
					                        <option value="TAS">TAS</option>
					                    </select>
				                    </div><hr>
				                    <div class="form-group">
					                    <label>Nomor UNSC:</label>
					                    <input type="text" value="<?php echo $nounsc;?>" name="unsc" class="form-control" style="width: 50%; float: right;">
				                    </div><hr>
				                    <div class="form-group">
					                    <label>Jumlah ODP:</label>
					                    <input type="number" value="<?php echo $jodp;?>" name="jml" class="form-control" style="width: 50%; float: right;">
				                    </div><hr>
				                    <div class="form-group">
					                    <label>Keterangan:</label>
					                    <textarea type="text" name="keterangan" value="<?php echo $keterangan;?>" class="form-control" style="border-style:solid; padding: 5px; border-radius: 5px; border-width: 1px; border-color: grey;"><?php echo $keterangan;?></textarea>
				                    </div>
			                    	<div class="modal-footer">
			                    		<input id="submitForm" type="submit" class="btn btn-info" value="Save" name="updatedata">
			                    		<input  type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
			                    	</div>
			                    </div>
							</form>
						</div>
					</div>
				</div>
						<div id="deleteoptima1<?php echo $idproject;?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post" action="config/(optima)page2.php">
										<div class="modal-header" style="text-align: center;">						
											<h4 class="modal-title">Delete Order: <?php echo $idproject;?></h4>
											<input type="hidden" name="idproject" value="<?php echo $idproject; ?>">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body">					
											<p>Apakah anda yakin akan menghapus data ini?</p>
											<p class="text-warning"><small>Data akan terhapus secara permanen!</small></p>
										</div>
										<div class="modal-footer">
											<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
											<input type="submit" name="deletedata" class="btn btn-danger" value="Delete">
										</div>
									</div>
								</form>
							</div>
						</div>
					<?php
					$no++;
}
					if (empty($idproject)) {
						echo '<tr>';
						echo '<td colspan="100%">Data belum tersedia</td>'; 
						echo '</tr>';
					}
					?>
		                </tbody>
	    		</table>
	    		<?php
				$query1	= "SELECT * FROM pengajuan";
				$result1 = mysqli_query($conn, $query1);
				$count 	= mysqli_num_rows($result1);
				$a 		= $count/10;
				$a 		= ceil($a);
				if (empty($_POST['valuesearch'])) {?>
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
					</div><!-- div class table -->
   		</div><!--div content-->
    </div>
</body>
</html>
