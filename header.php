<?php
require_once("scripts/functions.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Furzed Community - Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v12.0" nonce="ABeADG0P"></script>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/logo2.png" alt="Furzed Community">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <?php
        $total_notifications = 0; $sql = $con->query("SELECT * FROM `panel_notifications` WHERE notification_receiver = '$acc_id'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_notifications++; } }
        $total_notifications_read = 0; $sql = $con->query("SELECT * FROM `panel_notifications` WHERE notification_receiver = '$acc_id' AND notification_read = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_notifications_read++; } }
        $total_notifications_notread = 0; $sql = $con->query("SELECT * FROM `panel_notifications` WHERE notification_receiver = '$acc_id' AND notification_read = 0"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_notifications_notread++; } }
        if($_COOKIE['login_user'] != 0) {
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
            if($total_notifications_notread > 0)
            {
          ?>
          <span class="badge badge-warning navbar-badge"><?=$total_notifications_notread?></span>
          <?php
            }
            else
            {
              ?>
              <span class="badge badge-warning navbar-badge"></span>
              <?php
            }
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$total_notifications_notread?> new notifications</span>
          <div class="dropdown-divider"></div>
      <?php
              $sql = $con->query("SELECT * FROM `panel_notifications` WHERE notification_receiver = '$acc_id' AND notification_read = 0 ORDER BY id DESC LIMIT 3");
              if($sql->num_rows != 0) {
                while($row = $sql->fetch_assoc()) 
                {
                  $how_long_ago_notif = $current_timestamp - $row['notification_timestamp']
                  ?>
                  <a href="handle_notif.php?id=<?=$row['id']?>" class="dropdown-item">
                  <div class="media">
                      <img src="<?=$row['notification_image']?>" alt="Notification Image" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          <?=$row['notification_title']?>
                          <?php
                          if($row['notification_read'] == 0)
                          {
                            ?>
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                          <?php
                          }
                          else
                          {
                            ?>
                            <span class="float-right text-sm text-danger"><i class=""></i></span>
                            <?php
                          }
                          ?>
                        </h3>
                        <p class="text-sm"><?=$row['notification_short_text']?></p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?=howLongAgo($how_long_ago_notif)?></p>
                      </div>
                    </div>
                  </a>
                  <?php
                }
              }
      ?>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <?php
        }
      ?>
      <li class="nav-item">
      <?php
          if($_COOKIE['login_user'])
          {
            ?>
            <a href="logout.php" class="nav-link">Logout</a>
            <?php
          }
          else
          {
        ?>
          <a href="login.php" class="nav-link">Login</a>
        <?php
          }
        ?>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/logo2.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <?php
      $ACTUAL_skin_id = explode("|", $acc_skin_id);

      if($_COOKIE['login_user'] == 0) {
        ?>
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/no-photo.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">Guest</a>
            </div>
          </div>
    <?php
      }
      else
      {
        ?>
          <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/avatars/40/<?=$ACTUAL_skin_id[0]?>.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="profile.php?id=<?=$acc_id?>" class="d-block"><?=$acc_name?></a>
            </div>
          </div>
        <?php
      }
    ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Main navigation</li>
              <li class="nav-item">
                 <a href="index.php" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Dashboard
                  </p>
               </a>
              </li>
          <li class="nav-item">
            <a href="online_players.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Online players
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="staff.php" class="nav-link">
              <i class="nav-icon fas fa-shield-alt"></i>
              <p>
                Staff
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="shop.php" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Shop
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="factions.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Factions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="complaints.php" class="nav-link">
              <i class="nav-icon fas fa-gavel"></i>
              <p>
                Complaints
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://discord.io/furzed" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Tickets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="unbans.php" class="nav-link">
              <i class="nav-icon fas fa-ban"></i>
              <p>
                Cereri debanare
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Banned Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-fighter-jet"></i>
              <p>
                Wars
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-trophy"></i>
              <p>
                Server stats
              </p>
            </a>
          </li>
          <?php
          if($acc_leader > 0)
          {
          ?>
          <li class="nav-item">
            <a href="leader_panel.php" class="nav-link">
              <i class="nav-icon fas fa-people-arrows"></i>
              <p>
                Leader panel
              </p>
            </a>
          </li>
          <?php
          }
      $ACTUAL_skin_id = explode("|", $acc_skin_id);

      if($acc_id == 1 || $acc_id == 2) {
        ?>
          <li class="nav-header">Owner navigation</li>
              <li class="nav-item">
                 <a href="acp.php" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Dashboard
                  </p>
               </a>
              </li>
              <?php
      }
      ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->