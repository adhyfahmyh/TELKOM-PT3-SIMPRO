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
      		<a href="page3.php" class="pageactive"><h4><strong>Optima</strong></h4></a>
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
		    $query 			= "SELECT * FROM `optima` WHERE CONCAT(`id_order`,`idproject`,`nmitra`,`nama`,`notelp`,`tglorder`,`tglgolive`) LIKE '%".$valueToSearch."%'";
		    $search_result 	= filterTable($query);
		    if (!$query) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}else {
		    $query = "SELECT * FROM optima limit $page1,10";
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
    			<label><h2>Tabel Optima</h2></label>
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
	                    <th>ID Order</th>
	                    <th>ID Project</th>
	                    <th>Nama Mitra</th>
	                    <th>Nama Optima</th>
	                    <th>No. Telp Optima</th>
	                    <th>Tgl Order</th>
	                    <th>Tgl Go Live</th>
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
	                        $query = "SELECT * FROM optima ORDER BY id_order limit $start,$perpage";
	                        $result = mysqli_query($conn, $query);
	                        $no=1;
	                        while($row = mysqli_fetch_array($search_result)){
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
	                            <td>$tglgolive</td>";
	                            ?>
	                        	<td>
	                            <a href="#editoptima1<?php echo $id_order;?>"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">border_color</i></a>
	                            <a href="#deleteoptima1<?php echo $id_order;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
	                            </td>
	                        </tr>
	                <div id="editoptima1<?php echo $id_order;?>" class="modal fade">
						<div class="modal-dialog" id="editoptima1dialog">
							<div class="modal-content">
								<form action="config/(optima)page3.php" method="post">
									<div class="modal-header" style="text-align:center;">	
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Edit Order: <?php echo $id_order;?></h4>
									</div>
								<div class="modal-body">
										<input type="hidden" name="id_order" class="form-control" readonly value="<?php echo $id_order;?>">
									<div class="form-group">
				                        <label>ID Project:</label>
				                        <select name="idproject" class="form-control">
				                            <?php
				                            	include '../../include/connection.php';
				                                $q=mysqli_query($conn,"SELECT* FROM pengajuan");
				                                while ($data = mysqli_fetch_assoc($q)){
				                                    echo '<option value="'.$data['idproject'].'">'.$data['idproject'].'</option>';
				                                }
				                            ?>
				                        </select><hr>
				                    </div>
				                    <div class="form-group">
				                    	<label>Nama Mitra:</label>
				                        <input value="<?php echo $nmitra;?>" type="text" name="nmitra" class="form-control" placeholder="Nama Mitra"><hr>
				                        <label>Nama Optima:</label>
				                        <input value="<?php echo $nama;?>" type="text" name="nama" class="form-control" placeholder="Nama"><hr>
				                    </div>
				                    <div class="form-group1">
				                        <label>No. Telp Optima:</label>
				                        <input value="<?php echo $notelp;?>" type="text" name="notelp" class="form-control" placeholder="No.Telp" ><hr>
				                    </div>
				                    <div class="form-group">
				                        <label>Tanggal Go Live:</label>
				                        <input value="<?php echo $tglgolive;?>"type="date" name="tglgolive" class="form-control" ><hr>
				                    </div>
				                    </div>
			                    	<div class="modal-footer">
			                    		<input id="submitForm" type="submit" class="btn btn-info" value="Save" name="updatedata">
			                    		<input  type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
			                    	</div>
			                    </form>
							</div>
						</div>
					</div>
						<div id="deleteoptima1<?php echo $id_order;?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post" action="config/(optima)page3.php">
										<div class="modal-header">						
											<h4 class="modal-title">Delete Order: <?php echo $id_order;?></h4>
											<input type="hidden" name="id_order" value="<?php echo $id_order; ?>">
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
	    		<?php
				$query1	= "SELECT * FROM optima";
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
				        	<li class="page-item"><a href="page3.php?page=<?php echo $b;?>"<?php 
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
