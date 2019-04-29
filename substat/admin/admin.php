<?php
	session_start();
   	include '../../include/connection.php';
    if(!isset($_SESSION['username'])){
    	die("<script>alert('Anda belum login!');window.location.href='../../logout.php';</script>");
    }

    if($_SESSION['status']!="admin"){
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
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
</head>
<script type="text/javascript">
function confirm_delete() {
  return confirm('Apakah anda yakin?');
}
function showpassword() {
var x = document.getElementById("pass");
	if (x.type == "pass") {
	    x.type = "text";
	} else {
	    x.type = "pass";
	}
}
</script>
<body>
	<div class="topnav">
		<div class="navindex">
			<a id="ctl00_XXX" title="XXX" class="hdrXXX" href="admin.php">
		        <img src="../../img/logonavbar.png" alt="home" style="border: 0; float: left; margin-right: 15px; margin-bottom:5px;height: 100%;width: 34%;" /> 
		        <span id="XXX"><h4><strong>SELAMAT DATANG! </strong></h4><p><?php echo $_SESSION['nama'];?></p></span>
		    </a>
		</div>
      	<div class="logout">
          	<a href="../../logout.php" onclick="return confirm('Anda yakin?')"><h4><strong>Sign Out</strong></h4></a>
      	</div>
    </div>
    <?php
    	include '../../include/connection.php';
        $page = isset($_GET['page'])?$_GET['page']:1;
	    if ($page==""||$page=="1") {
	    	$page1=0;
	    }else{
	    	$page1=($page*5)-5;
	    }

		if(isset($_POST['search'])){
		    $valueToSearch = $_POST['valuesearch'];
		    $query = "SELECT * FROM `user` WHERE CONCAT(`id_user`, `nama`, `email`,`username`,`no_tel`,`alamat`,`status`) LIKE '%".$valueToSearch."%' LIMIT $page1, 5";
		    $search_result 	= filterTable($query);
		    $if 		= $valueToSearch;
		    
		}else {
		    $query = "SELECT * FROM user limit $page1,5";
		    $search_result = filterTable($query);
		    $if 		= $search_result;
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
    	<div class="content">
    		<div class="headregister">
    			<label><h2>Tambah pengguna</h2></label>
    		</div>
    		<div class="headtable">
    			<div class="titletable">
    				<label><h2>Daftar Pengguna</h2></label>
    			</div>
    			<div class="tablething">
    				<form class="searh" method="POST">
	    				<input type="text" name="valuesearch">
	    				<input type="submit" name="search" value="GO">
	    			</form>
    			</div>
    		</div>
    		<div class="table">
    			<table class="tableuser">
	    			<tr>
	    				<th>No.</th>
	                    <th>Id User</th>
	                    <th>Nama</th>
	                    <th>E-mail</th>
	                    <th>Username</th>
	                    <th>No. Telp</th>
	                    <th>Alamat</th>
	                    <th>Status</th>
	                    <th>Options</th>
	                </tr>
	                <tbody>
	                	<?php
		                    $perpage = 5;
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
	                        $query = "SELECT * FROM user ORDER BY id_user limit $start,$perpage";
	                        $result = mysqli_query($conn, $query);
	                        $no= ($perpage - 1) * ($page1 + 1);
	                        while($row = mysqli_fetch_array($search_result)){
	                        	$id_user			= $row['id_user'];
						    	$nama 		= $row['nama'];
						    	$email 		= $row['email'];
						    	$username	= $row['username'];
						    	$no_tel 		= $row['no_tel'];
						    	$alamat 		= $row['alamat'];
						    	$status 	= $row['status'];
						    	
	                            echo "<tr><td align='center'>$no</td>
	                            <td align='center'>$id_user</td>
	                            <td>$nama</td>
	                            <td>$email</td>
	                            <td>$username</td>
	                            <td>$no_tel</td>
	                            <td>$alamat</td>
	                            <td>$status</td>";
	                            ?>
	                        	<td align="center">
	                            <a href="#editEmployeeModal<?php echo $id_user;?>"  class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">border_color</i></a>
	                            <a href="#deleteEmployeeModal<?php echo $id_user;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
	                            </td>
	                        </tr>
	                        
		                
		                <div id="editEmployeeModal<?php echo $id_user;?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header" style="text-align:center;">						
											<h4 class="modal-title">Edit User</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<p><strong>Account ID:</strong></p>
												<input style="text-align: center; border: none;" name="id_user" readonly value="<?php echo $id_user?>" class="form-control">
											</div>					
											<div class="form-group">
												<label>Name:</label>
												<input name="nama" type="text" class="form-control" value="<?php echo $nama;?>">
											</div>
											<div class="form-group">
												<label>Email:</label>
												<input name="email" type="email" class="form-control" value="<?php echo $email;?>">
											</div>
											<div class="form-group">
												<label>Username:</label>
												<input name="username" type="text" class="form-control" value="<?php echo $username;?>">
											</div>
											<div class="form-group">
												<label>No. Telp:</label>
												<input name="no_tel" type="text" class="form-control" value="<?php echo $no_tel;?>">
											</div>
											<div class="form-group">
												<label>Alamat</label>
												<textarea name="alamat" type="text" class="form-control" value="<?php echo $alamat;?>"><?php echo $alamat;?></textarea>
											</div>
											<div class="form-group">
												<label>Status:</label>
												<select class="form-control" name="status">
													<option selected hidden value="<?php echo $status;?>"><?php echo $status;?></option>
													<option value="user">User</option>
						                            <option value="mitra">Mitra</option>
						                            <option value="optima">Optima</option>
						                            <option value="admin">Admin</option>
												</select>
											</div>					
										</div>
										<div class="modal-footer">
											<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
											<input type="submit" class="btn btn-info" value="Save" name="updatedata">
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="deleteEmployeeModal<?php echo $id_user;?>" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="post">
										<div class="modal-header">						
											<h4 class="modal-title">Delete Employee: <?php echo $nama;?></h4>
											<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
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
$no++;}
					if (isset($_POST['updatedata'])) {
						$id_user	= $_POST['id_user'];
						$nama		= $_POST['nama'];
						$email		= $_POST['email'];
						$username	= $_POST['username'];
						$no_tel 	= $_POST['no_tel'];
						$alamat		= $_POST['alamat'];
						$status 	= $_POST['status'];
						$sql 		= "UPDATE user SET
										nama 		= '$nama',
										email		= '$email',
										username 	= '$username', 
										no_tel		= '$no_tel',
										alamat 		= '$alamat',
										status 		= '$status'
										WHERE 
										id_user 	='$id_user' ";
						if ($conn->query($sql) === TRUE) {
							echo'<script>alert("Update Berhasil!");window.location.href="admin.php";</script>';
						}else{
							echo "Error: " . $sql . "<br>" . $conn->error;
						}
					}							
					if (isset($_POST['deletedata'])) {
						$delete_id = $_POST['id_user'];
                        $sql = "DELETE FROM user WHERE id_user='$delete_id' ";
                        if ($conn->query($sql) === TRUE) {
                        	echo'<script>window.location.href="admin.php";</script>';
                        } else {
                            echo "Error deleting record: " . $conn->error;
                        }
                    }
					?>
		                </tbody>
	    		</table>
	    		<?php
	    		
				$query1	= "SELECT * FROM user";
				$result1 = mysqli_query($conn, $query1);
				$count 	= mysqli_num_rows($result1);
				$a 		= $count/5;
				$a 		= ceil($a);
				if ($if=$search_result || !$_POST('valueToSearch')) {?>
					<div class="clearfix">
			            <div class="hint-text">Menampilkan <b><?php echo $page;?></b>, dari <b><?php echo $a;?></b> halaman</div>
			            <ul class="pagination">
			        <?php 
			        for ($b=1; $b <=$a ; $b++){ ?>
				        <li class="page-item"><a href="admin.php?page=<?php echo $b;?>"
				        <?php 
						    if ($page == $b) {
						        echo 'class="active"';
						    }?>
				        	><strong><?php echo $b."";?></strong></a></li>
						<?php
					}
				}
				?>
				</ul>
			</div>
    		</div>
    		<div class="form">
    			<form method="post" id="regist">
                    <div class="grup">
                        <label> Nama:&emsp; </label>
                        <input type="text"  name="nama" id="nama" class="field-style field-split" placeholder="Masukkan nama" required>
                    </div>
                    <div class="grup">
                        <label> Email:&emsp;</label>
                        <input type="email" name="email" id="email" class="field-style field-split"  placeholder="Masukkan e-mail" required>
                    </div>
                    <div class="grup">
                        <label>Username/NIK:&emsp;</label>
                        <input type="text" name="username" id="username" class="field-style field-split" placeholder="Masukkan Username/NIK"required>
                    </div>
                    <div class="grup">
                        <label>Password:&emsp; </label>
                    	<input type="text" name="pass" id="pass" placeholder="Masukkan Password" required>
                    </div>
                    <div class="grup">
                        <label>No Telp:&emsp;</label>
                        <input type="tel" name="tel" id="tel" class="field-style field-split" placeholder="ex: 08**********" required>
                    </div>
                    <div class="grup">
                        <label>Alamat:&emsp;  </label>
                        <textarea type="text" name="alamat" id="alamat" class="field-style field-split" placeholder="Masukkan alamat user" required> </textarea>
                    </div>
                    <div class="grup">
                        <label>Status:&emsp;  </label>
                        <select name="status" class="field-style field-split" required>
                            <option selected hidden value="">Status hak akses</option>
                            <option value="user">User</option>
                            <option value="mitra">Mitra</option>
                            <option value="optima">Optima</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="grup">
                        <input type="submit" value="Submit" name="submit" id="send">
                    </div>
                </form>
            </div>
    	</div>
    </div>
</body>
</html>          
<?php
	if (isset($_POST['submit'])) {
		$nama 		= $_POST['nama'];
		$email 		= $_POST['email'];
		$username 	= $_POST['username'];
		$pass  		= md5($_POST['pass']);
		$tel 		= $_POST['tel'];
		$alamat 	= $_POST['alamat'];
		$status 	= $_POST['status'];
		$sql_u 		= "SELECT * FROM user WHERE username='$username'";
		$sql_e 		= "SELECT * FROM user WHERE email='$email'";
		$res_u 		= mysqli_query($conn, $sql_u);
		$res_e 		= mysqli_query($conn, $sql_e);

		if (mysqli_num_rows($res_u) > 0) {
	  		echo'<script>alert("Username sudah ada!");window.location.href="admin.php";</script>'; 	
	  	}elseif (mysqli_num_rows($res_e) > 0) {
	  		echo'<script>alert("Email sudah ada!");window.location.href="admin.php";</script>'; 	
	  	}else{
			$sql		= "INSERT INTO user (nama,email,username,password,no_tel,alamat,status) 
			VALUES ('$nama','$email','$username','$pass','$tel','$alamat','$status')";		
			$result 	= mysqli_multi_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Berhasil!');window.location.href='admin.php';</script>";
			}else{
				echo "<script>alert('Gagal!');window.location.href='admin.php';</script>";
			}
		}
	}

?>                      		                            
<script>
	$(function(){
		$("#send").click(function(e){
			e.preventDefault();
			$.ajax({
				type: "post",
				url: "admin.php",
				data: $("#regist").serialize(),
				success: function(response){	
				if(response == "done"){	
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; alert("Form submitted successfully!");	
				}else{	
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; alert("Form submission failed!");	}
				},error:function(response){	
					alert(response);	
				}
			});
		});
	});
</script>