<?php require_once("header.php");?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Atentie !</h5>
                  Accesul la panel pentru utilizatorii normali este momentan limitat datorita ultimilor lucrari de efectuat. Pentru mai multe detalii intrati pe serverul nostru de <a href="https://discord.io/furzed">Discord</a>
                </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Online players</span>
                <span class="info-box-number">
                <?=$total_players_online?>/100
                </span>
                <small><?=$total_registred_players?> accounts and <?=$total_banned_players?> banned.</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-home"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Houses</span>
                <span class="info-box-number"><?=$total_houses_owned + $total_houses_not_owned?></span>
                <small><?=$total_houses_owned?> houses are owned and <?=$total_houses_not_owned?> for sale.</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Businesses</span>
                <span class="info-box-number"><?=$total_biz_not_owned + $total_biz_owned?></span>
                <small><?=$total_biz_owned?> businesses are owned and <?=$total_biz_not_owned?> for sale.</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Vehicles</span>
                <span class="info-box-number"><?=$total_vehicles_owned + $total_vehicles_vip?> </span>
                <small><?=$total_vehicles_owned?> vehicles are normal and <?=$total_vehicles_vip?> premium.</small>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
            <!-- /.card -->
            <div class="row">
              <div class="col-md-7">
                <!-- DIRECT CHAT -->
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Announces </h3>
                  </div>
                  <!-- /.card-header -->
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <!-- Message. Default to the left -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">Kimiksen</span>
                          <span class="direct-chat-timestamp float-right">27 November 10:44 AM</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="dist/img/avatars/40/250.png" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                        Deschiderea officiala a comunitatii Furzed are loc pe data de 04.12.2021 la ora 20:00!
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-footer-->
                <!--/.direct-chat -->
              <!-- /.col -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Latest server news</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/avatars/40/101.png" alt="Product Image" class="img-size-40">
                      </div>
                      <div class="product-info">
                        <a class="product-title">Faction join
                        <span class="product-description">
                          m0untain has joined the faction Los Santos Police Department (invited by Kimiksen).
                        </span>
                      </div>
                    </li>
                    <li class="item">
                      <div class="product-img">
                        <img src="dist/img/avatars/40/101.png" alt="Product Image" class="img-size-40">
                      </div>
                      <div class="product-info">
                        <a class="product-title">Faction left
                        <span class="product-description">
                          m0untain has left Paramedics after 5 days using /quitfaction.
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.card-footer -->
              </div>
        <!-- /.row -->
      </div>
      <div class="col-md-5">
        <div class="card bg-gradient-primary">
        <div class="card-header">
              <h5><i class="icon fas fa-thumbs-up"></i> Like us on Facebook</h5>
              <p></p>
              <div class="text-center">
                <div class="fb-page text-center"
                  data-href="https://www.facebook.com/Furzed-Community-100951469105908" 
                  data-width="1500"
                  data-hide-cover="false"
                  data-show-facepile="true"></div>
              </div>
          </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Top 5 online players this week</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php
                  $counter = 0;
                    $sql = $con->query("SELECT * FROM `users` ORDER BY Last7Hours DESC LIMIT 5");
                    if($sql->num_rows != 0) {
                      while($row = $sql->fetch_assoc()) 
                      {
                        $counter++;
                        $ACTUAL2_skin_id = explode("|", $row['Skin']);
                  ?>
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/avatars/40/<?=$ACTUAL2_skin_id[0]?>.png" alt="Product Image" class="img-size-40">
                    </div>
                    <div class="product-info">
                      <a class="product-title">#<?=$counter?> <?=$row['name']?>
                      <span class="product-description"> <a class="fas fa-clock"></a>
                        Played last 7 days: <?=$row['Last7Hours']?>
                      </span>
                    </div>
                  </li>
                  <?php
                      }
                    }
                    ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-footer -->
            </div>
      </div>
      <div class="col-md-6">

      </div>
<!--/. container-fluid -->
        <!-- /.row -->
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once("footer.php");?>