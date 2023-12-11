<?php require_once("scripts/functions.php");
if($_COOKIE['login_user'] == 0) {
    ?>
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bgiamge {
  /* The image used */
  background-image: url("dist/img/background-login.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Furzed  Community - Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bgiamge">
<div class="login-box">
<div class="login-logo">
    <a href="index.php"><img src="dist/img/logo2.png" alt="" class="brand-image elevation-3" style="width:355px;height:100px;"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary bg-black">
    <div class="card-body bg-dark">
      <p class="login-box-msg">Sign in to start your session</p>
      <div class="alert" id="invalid_password" style="display: none; background-color: color: #ffffff; background-color: rgb(255 102 102 / 67%); border-color: #797979;">
                                Username sau parolă nu se potrivesc !
                            </div>
      <form method="post">
        <div class="bg-dark input-group mb-3">
          <input placeholder="Username" class="form-control bg-dark" name="user">
          <div class="bg-dark input-group-append bg-dark">
            <div class="bg-dark input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 bg-dark">
          <input type="password" class="form-control bg-dark" placeholder="Password" name="pass">
          <div class="input-group-append bg-dark">
            <div class="input-group-text bg-dark">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <h10 for="remember">
                Remember Me
              </h10>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<?php 
    if(isset($_POST['user']) && isset($_POST['pass'])) {
        $post_user = $_POST['user'];
        $post_password = hash("whirlpool",$_POST['pass']);
        $sql = $con->query("SELECT * FROM `users` WHERE name = '$post_user' AND password = '$post_password'");
        if($sql->num_rows != 0) {
          $row = mysqli_fetch_assoc($sql);
          $acc_id = $row['id'];
          $sesidx = uniqid(rand());
          $sesid = substr($sesidx, 0, 44);
          setcookie('login_user', $sesid, 0, '', $domain);
          $con->query("INSERT INTO sessions (acc_id, sess_id) VALUES('$acc_id', '$sesid')");
          header("Location: index.php");
        }
        else {
            ?>
            <script>
                document.getElementById("invalid_password").style.display='block';
            </script>
            <?php 
        }
    }
    ?>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
<?php 
}
else {
    header("Location: index.php");
}