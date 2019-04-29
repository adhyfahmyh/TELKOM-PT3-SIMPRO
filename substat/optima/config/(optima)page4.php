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
    $id_progres = $_POST['id_progres'];
    $id_order   = $_POST['id_order'];
    $ssurvey    = $_POST['ssurvey'];
    $nproject   = $_POST['nproject'];
    $spfisik    = $_POST['spfisik'];
    $sut        = $_POST['sut'];
    $namaodp    = $_POST['namaodp'];
    $keterangan = $_POST['keterangan'];
    $query      ="UPDATE progres SET  
                id_order    ='$id_order', ssurvey   ='$ssurvey', 
                nproject    ='$nproject',  
                spfisik     ='$spfisik', sut       ='$sut',
                namaodp     ='$namaodp', keterangan ='$keterangan' 
                WHERE 
                id_progres  ='$id_progres' ";
    $hasil=mysqli_query($conn, $query);
        if(!$hasil) {
            die ("<script>alert('Gagal!');window.location.href='../page4.php';</script>");
        }else{
            echo'<script>alert("Berhasil!");window.location.href="../page4.php";</script>';
        }
}
    
    
  if (isset($_POST['deletedata'])) {
        $id     = $_POST['id_progres'];
        $query  = "DELETE FROM progres WHERE id_progres='$id'";
        if ($conn->query($query) === TRUE) {
            echo'<script>window.location.href="../page4.php";</script>';
        } else {
            die('<script>alert("gagal");window.location.href="../page4.php";</script>');
        }
    }
?>