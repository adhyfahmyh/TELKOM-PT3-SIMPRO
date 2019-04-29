<?php
	session_start();

    if(!isset($_SESSION['username'])){
        die("<script>alert('anda belum login');window.location.href='../../logout.php';</script>");
    }
    if($_SESSION['status']!="optima"){
        die("Anda tidak memiliki hak akses!");
    }
	include '../../../include/connection.php';
    if (!$conn) {
        echo "GAGAL";
    }
    if (isset($_POST['updatedata'])) {
        $id_order   = $_POST['id_order'];
        $idproject  = $_POST['idproject'];
        $nmitra     = $_POST['nmitra'];
        $nama       = $_POST['nama'];
        $notelp     = $_POST['notelp'];
        $tglgolive  = $_POST['tglgolive'];
        $query      ="UPDATE optima SET  
                        idproject   ='$idproject', 
                        nmitra      ='$nmitra', 
                        nama        ='$nama', 
                        notelp      ='$notelp', 
                        tglgolive   ='$tglgolive'
                    WHERE 
                        id_order    ='$id_order'";

        $hasil=mysqli_query($conn, $query);
            if(!$hasil) {
                die ("<script>alert('gagal');window.location.href='../page3.php';</script>");
            }else{
                echo'<script>alert("Berhasil!");window.location.href="../page3.php";</script>';
            }
    }
    if (isset($_POST['deletedata'])) {
        $id     = $_POST['id_order'];
        $query  = "DELETE FROM optima WHERE id_order='$id'";
        if ($conn->query($query) === TRUE) {
            echo'<script>window.location.href="../page3.php";</script>';
        } else {
            echo'<script>alert("gagal");window.location.href="../page3.php";</script>';
        }
    }

?>