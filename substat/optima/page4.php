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
      		<a href="../../logout.php" onclick="return confirm('Anda yakin?')"style="border:none;"><h4><strong>Sign Out</strong></h4></a>
      		<a href="page4.php" class="pageactive"><h4><strong>Mitra</strong></h4></a>
      		<a href="page3.php" class=""><h4><strong>Optima</strong></h4></a>
      		<a href="page2.php" class=""><h4><strong>User</strong></h4></a>
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
		    $valueToSearch 	= $_POST['valuesearch'];
		    $query 			= "SELECT * FROM `progres` WHERE CONCAT(`id_progres`,`id_order`,`nama_mitra`,`ssurvey`,`nproject`,`spfisik`,`sut`,`namaodp`,`keterangan`) LIKE '%".$valueToSearch."%'";
		    $search_result 	= filterTable($query);
		    if (!$query) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}else {
		    $query = "SELECT * FROM progres limit $page1,10";
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
    			<label><h2>Tabel Mitra</h2></label>
    			<div class="tablething">
    				<form class="searh" method="POST">
	    				<input type="text" name="valuesearch" placeholder="Search here..">
	    				<input type="submit" name="search" value="GO">
	    			</form>
    			</div>
    		</div>
    		<div class="table" style="overflow-x:auto;">
    			<table class="tableuser">
	    			<tr>
	                    <th>ID Progress</th>
	                    <th>ID Order</th>
	                    <th>Nama Mitra</th>
	                    <th>Status Survey</th>
	                    <th>Nama Project</th>
	                    <th>Status Pekerjaan Fisik</th>
	                    <th>Status UT</th>
	                    <th>Nama ODP</th>
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
	                        include '../../include/connection.php';
	                        $query = "SELECT * FROM progres ORDER BY id_order limit $start,$perpage";
	                        $result = mysqli_query($conn, $query);
	                        while($row = mysqli_fetch_array($search_result)){
	                        	$id_progres	= $row['id_progres'];
						    	$id_order 	= $row['id_order'];
						    	$nama_mitra = $row['nama_mitra'];
						    	$ssurvey	= $row['ssurvey'];
						    	$nproject 	= $row['nproject'];
						    	$spfisik 	= $row['spfisik'];
						    	$sut 		= $row['sut'];
						    	$namaodp	= $row['namaodp'];
						    	$keterangan = $row['keterangan'];
	                            echo "<tr>
	                            <td>$id_progres</td>
	                            <td>$id_order</td>
	                            <td>$nama_mitra</td>
	                            <td>$ssurvey</td>
	                            <td>$nproject</td>
	                            <td>$spfisik</td>
	                            <td>$sut</td>
	                            <td>$namaodp</td>
	                            <td>$keterangan</td>";
	                            ?>
	                        	<td>
	                            <a href="#editoptima1<?php echo $id_progres;?>"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">border_color</i></a>
	                            <a href="#deleteoptima1<?php echo $id_progres;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
	                            </td>
	                        </tr>
	                <div id="editoptima1<?php echo $id_progres;?>" class="modal fade">
						<div class="modal-dialog" id="editoptima1dialog">
							<div class="modal-content">
								<form action="config/(optima)page4.php" method="post">
									<div class="form-row">
									<div class="modal-header" style="text-align:center;">	
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">ID PROGRESS: <?php echo $id_progres;?></h4>
										<input type="hidden" name="id_progres" value="<?php echo $id_progres;?>">
									</div>
								<div class="modal-body">
									<div class="form-group col-md-6">
				                        <label for="ssurvey">ID Order:</label>
				                        <select name="id_order" class="form-control" id="ssurvey" style="width: 100%;">
				                        	<option selected hidden="<?php echo $id_order;?>"><?php echo $id_order;?></option>
				                            <?php
						                        $q=mysqli_query($conn,"SELECT* FROM optima");
						                        while ($data = mysqli_fetch_assoc($q)){
						                        echo '<option value="'.$data['id_order'].'">'.$data['id_order'].'</option>';
						                        }
						                    ?>
				                        </select>
				                    </div>
				                    <div class="form-group col-md-6">
				                    	<label for="ssurvey" style="width: 100%;">Status Survey:</label>
						                <select name="ssurvey" class="form-control" id="ssurvey" style="width: 100%;">
						                    <option selected hidden value="<?php echo $ssurvey;?>"><?php echo $ssurvey;?></option>
						                    <option value="SURVEY OK">SURVEY OK</option>
						                    <option value="SURVEY NOK">SURVEY NOK</option>
						                </select>
				                    </div>
				                    <div class="form-group col-md-6">
				                        <label for="nproject" style="width: 100%;">Nama Project:</label>
						                <select name="nproject" class="form-control" id="nproject" style="width: 100%;">
						                    <option selected hidden value="<?php echo $nproject;?>"><?php echo $sproject;?></option>
						                    <option value="FTTH">FTTH</option>
						                    <option value="WIFI">WIFI</option>
						                    <option value="PT2">PT2</option>
						                    <option value="HEM">HEM</option>
						                    <option value="NODB">NODB</option>
						                    <option value="OLO">OLO</option>
						                    <option value="QE">QE</option>
						                </select>
				                    </div>
				                   	<div class="form-group col-md-6">
				                        <label style="width: 100%;">Status Pekerjaan Fisik:</label>
						                <select name="spfisik" class="form-control" style="width: 100%;">
						                    <option selected hidden value="<?php echo $sproject;?>"><?php echo $sproject;?></option>
						                    <option value="OGP">OGP</option>
						                    <option value="Closed">Closed</option>
						                </select>
				                    </div>
				                    <div class="form-group col-md-6">
				                    	<label for="sut">Status UT:</label>
				                    	<input type="date" name="sut" id="sut" class="form-control" value="<?php echo $sut;?>" style="width: 100%;">
				                    </div>
				                    <div class="form-group col-md-6">
				                    	<label style="width: 100%;">Nama ODP:</label>
                						<input type="text" name="namaodp" class="form-control" value="<?php echo $namaodp;?>" style="width: 100%;">
				                    </div>
				                    <div class="form-group">
				                    	<label style="width: 100%;">Keterangan:</label>
                						<input type="text" name="keterangan" class="form-control" value="<?php echo $keterangan;?>" style="width: 100%; height: 50px;">
				                    </div>
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
						<div id="deleteoptima1<?php echo $id_progres;?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post" action="config/(optima)page4.php">
										<div class="modal-header">						
											<h4 class="modal-title">Delete Progress: <?php echo $id_progres;?></h4>
											<input type="hidden" name="id_progres" value="<?php echo $id_progres; ?>">
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
									</form>
								</div>
							</div>
						</div>
					<?php
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
				$query1	= "SELECT * FROM progres";
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
				        	<li class="page-item"><a href="page4.php?page=<?php echo $b;?>"<?php 
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