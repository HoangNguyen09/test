<!DOCTYPE html>
<html>
<head>
<title></title>
  <link rel="stylesheet" type="text/css" href="css2\stylelogo.css">
  <link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="css/dangki.css">
</head>
<body style="background-image: url(https://i.imgur.com/AIF5QsW.jpg);">

  <div class="container">
    <div class="col-md-6 col-md-offset-3" style="margin-left: 300px;margin-top: 60px;" >
      <div class="form form-body" style="opacity: 0.9;background-color: white;">
        <div class="header-form">
          <div class="login-h active-login" id="login-h">
            <span>Đăng Nhập</span>
          </div>
          <div class="signup-h" id="signup-h">
            <span>Đăng Ký</span>
          </div>
        </div>
        <div class="login-panel" id="login-panel">
          <h2></h2>
          <div>
          <form method="post">
            <div class="form-group">
              <label for="pnum">Số Điện Thoại</label>
              <input type="text" name="pnum" id="pnum" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="password">Mật Khẩu</label>
              <input type="password" name="password"  id="password" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <button type="submit" name="login"  id="login-btn" class="btn-primary-outline-login">Đăng Nhập</button>
            </div>
          </form>
          <?php
            include("connect.php");
            if(isset($_POST['login'])){
              $account = mysqli_real_escape_string($connect, $_POST['pnum']);
              $password = mysqli_real_escape_string($connect, $_POST['password']);
              $password = md5($password); 
              $sql="SELECT * FROM user WHERE Dienthoai='$account' and Password='$password'";
              $query=mysqli_query($connect,$sql);
              $num_row=mysqli_num_rows($query);
              if ($num_row != 0){
                
                echo "Đăng nhập thành công";
              
              }
              else {
                echo "Sai thông tin đăng nhập";
              }
            }
          ?>
        </div>
        </div>

          
        
        <div class="signup-panel" id="signup-panel">
          <h2></h2>
          
          <form method="post">
          <div class="form-group">
              <label for="name">Tên</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="pnum">Số Điện Thoại</label>
              <input type="text" name="pnum" id="pnum" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password"  id="password" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              
              <input type="checkbox" name="password"  id="password"/>
              <label>Ghi nhớ</label>
            </div>
            <div class="form-group">
              <button type="submit" name="login"  id="login-btn" class="btn-primary-outline-signup">Đăng Ký</button>
            </div>
          </form>
          <?php
              include("connect.php");
              if(isset($_POST['login'])){
                $name = mysqli_real_escape_string($connect, $_POST['name']);
                $account = mysqli_real_escape_string($connect, $_POST['pnum']);
                $password = mysqli_real_escape_string($connect, $_POST['password']);
                $password = md5($password); 
                $sql="INSERT INTO user(HoTen, Dienthoai, Password) VALUES('$name','$account','$password')";
                $query=mysqli_query($connect, $sql);
              }
            ?>
         
        </div>
      </div>
    </div>
    </div>
  </div>


        </div>
  <script type="text/javascript" src="bootstrap4/js/bootstrap.js"></script>
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="js/dangki.js"></script>

</body>
</html>
