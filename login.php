<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login Page | SIMPRO</title>
        <link rel="icon" type="image/png" href="img/titleicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/login.css">
    </head>
<body>
    <div class="title" title="Sistem Informasi Planning Alat Produksi">
            <label><strong>SIMPRO</strong></label>
            <p>(Sistem Informasi Planning Alat Produksi)</p>
        </div>
    <body class="gambar">
        <div class="content">
            <div class="logo"><h3><strong>Selamat Datang!<br></strong></h3></div>
            <div class="form"> 
                <div class="head">
                    <h3 class="s_title"><strong>SIGN IN</strong></h3>
                </div>         
                <form action="include/login.php?op=in" method="post" onSubmit="return validasi()">
                    <div class="grup">
                        <label> Username/NIK:  </label>
                        <input type="text"  name="username" id="username" placeholder="Your username">
                    </div>
                    <div class="grup">
                        <label> Password:  </label>
                        <input type="password" name="password" id="password"  placeholder="Your password">
                    </div>
                    <div class="showpassword">
                        <input type="checkbox" onclick="showpassword()"><label>&nbsp;Show Password</label>
                    </div>
                    <div class="grup">
                        <input type="submit" value="SIGN IN" class="tombol">
                        <a href="forgotpass.php" onclick="confirm('Anda akan meninggalkan halaman ini')">Lupa password?</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        function validasi() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var failed = "FAILED!";      
            if(username == "" && password==""){
                alert(failed+"\n\nPlease fill in Username and Password");
                return false;
            }
            else{
                return true;
            }
        }
        function showpassword() {
            var x = document.getElementById("password");
            if (x.type == "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    </body>
</html>
