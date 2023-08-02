
<?php
    session_start();
    require "DBcon/ConDB.php";

    if( isset($_POST["submit"])){
        if( $_POST["email"] !== "" && $_POST["tdndk"] !== "" && $_POST["pwdk"] !== "" && $_POST["rpwdk"] !== ""){
            $email = $_POST["email"];
            $tdn = $_POST["tdndk"];
            $pw = $_POST["pwdk"];
            $rpw = $_POST["rpwdk"];
            $loai = 0;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("location:regis.php");
                die();
            }
            if($pw != $rpw){ 
                header("location:regis.php");
                die(); 
            }
            $pw = md5($pw);
            $sql = "
                SELECT * FROM tb_user
                WHERE taikhoan = '$tdn' OR email = '$email'
            ";
            $rs = mysqli_query($conn, $sql);
            if( mysqli_num_rows($rs) > 0 ){
                $_SESSION["trung"] = "Email hoặc tên đăng nhập đã tồn tại";
                header("location:regis.php");
                die();
            }
            $sql = "
                    INSERT INTO tb_user (email, taikhoan, matkhau, loai)
                    VALUES ('$email','$tdn','$pw','$loai')
                ";
            mysqli_query($conn, $sql);
            header("location:login.php");
        }
        else{
            $_SESSION["thongbao"] = "Vui lòng nhập đầy đủ tất cả các thông tin";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Đăng Kí</title>
</head>
<body>
    <div id="dk">
        <h2>ĐĂNG KÍ</h2>
        <div class="form-group">
            <form id="formdk" action="regis.php" method="POST">

                <div class="control ">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" />
                    <i class="fa fa-check-circle fa-2x tcheck csucc" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle fa-2x tcheck cerro" aria-hidden="true"></i>
                    <p id="tb"></p>
                </div>

                <div class="control ">
                    <label for="tdndk">Tên Đăng Nhập:</label>
                    <input type="text" class="form-control" id="tdndk" name="tdndk">
                    <i class="fa fa-check-circle fa-2x tcheck csucc" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle fa-2x tcheck  cerro" aria-hidden="true"></i>
                    <p id="tb"></p>
                </div>
                
                <div id="mk" class="control ">
                    <label for="pwdk">Password:</label>
                    <input type="password" class="form-control" id="pwdk" name="pwdk">
                    <i class="fa fa-check-circle fa-2x bcheck csucc" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle fa-2x bcheck cerro" aria-hidden="true"></i>
                    <p id="tb"></p>
                </div>

                <div id="rmk" class="control ">
                    <label for="pwdk">Nhập Lại Mật Khẩu:</label>
                    <input type="password" class="form-control" id="rpwdk" name="rpwdk">
                    <i class="fa fa-check-circle fa-2x bcheck csucc" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle fa-2x bcheck cerro" aria-hidden="true"></i>
                    <p id="tb"></p>
                </div>
                <div id="clr"></div>
                <p id="tb">
                    <?php 
                        if( isset($_SESSION["trung"]) ){
                            echo $_SESSION["trung"];
                            session_unset("trung");
                        }  
                    ?>
                </p>
                <button  id="btn-dk" class="btn btn-primary" onclick="checkdk()" type="submit" name="submit">Đăng Kí</button>
            </form>   
            
                 
        </div>
        
    </div>
    <script>
        
        var eml = document.getElementById("email");
        var tdn = document.getElementById("tdndk");
        var pwdk = document.getElementById("pwdk");
        var rpwdk = document.getElementById("rpwdk");
        var dk = true;
        var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        eml.addEventListener('blur', (e) => {
            const val = e.target.value;
            if (val === "") {
                setErro(eml, "Email trống");
            } 
        });

        eml.addEventListener('keyup', (e) => {
            const val = eml.value;
            if (val === "") {
                setErro(eml, "Email trống");
            } else if (reg.test(val) != dk) {
                setErro(eml, "Email không đúng định dạng");
            } else {
                setSucc(eml, "");
            }
        });

        tdn.addEventListener('blur', (e) => {
            const val = e.target.value;
            if (val === "") {
                setErro(tdn, "Tên đăng nhập trống");
            }
        });
        tdn.addEventListener('keyup', (e) => {
            const val = tdn.value;
            if (val === "") {
                setErro(tdn, "Tên đăng nhập trống");
            } else {
                setSucc(tdn, "");
            }
        });

        pwdk.addEventListener('blur', (e) => {
            const val = e.target.value;

            if (val === "") {
                setErro(pwdk, "Mật khẩu trống");
            }

        });
        pwdk.addEventListener('keyup', (e) => {
            const val = pwdk.value;

            if (val === "") {
                setErro(pwdk, "Mật khẩu trống");
            }  

        });

        rpwdk.addEventListener('blur', (e) => {
            const val = e.target.value;
            
            if (val === "") {
                setErro(rpwdk, "Nhập lại mật khẩu trống");
            } 
        });
        rpwdk.addEventListener('keyup', (e) => {
            const val = rpwdk.value;
            const pwdk1 = pwdk.value;

            if (val === "") {
                setErro(rpwdk, "Nhập lại mật khẩu trống");
            } else if (val != pwdk1) {
                setErro(rpwdk, "Mật khẩu không trùng khớp");
                setErro(pwdk, "Mật khẩu không trùng khớp")
            } else {
                setSucc(pwdk, "");
                setSucc(rpwdk, "");
            }
        });

        function checkdk() {
            var emlv = eml.value;
            var tdnv = tdn.value;
            var pwdkv = pwdk.value;
            var rpwdkv = rpwdk.value;

            if (emlv === "" && tdnv === "" && pwdkv === "" && rpwdkv === "") {
                alert('Vui lòng nhập đầy đủ tất cả các thông tin');
            }         
        }

        function setErro(input, mess) {
            var formc = input.parentElement;
            var tb = formc.querySelector("p");
            tb.innerHTML = mess;
            formc.className = "control erro";
        }

        function setSucc(input, mess) {
            var formc = input.parentElement;
            var tb = formc.querySelector("p");
            tb.innerHTML = mess;
            formc.className = "control succ";
        }
    </script>
</body>
</html>