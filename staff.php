<?php require_once("header.php");
$total_admins_online = 0; $sql = $con->query("SELECT * FROM users WHERE Admin > 0 AND Status = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_admins_online++; } }
$total_helpers = 0; $sql = $con->query("SELECT * FROM users WHERE Helper > 0"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_helpers++; } }
$total_helpers_online = 0; $sql = $con->query("SELECT * FROM users WHERE Helper > 0 AND Status = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_helpers_online++; } }
$total_leaders = 0; $sql = $con->query("SELECT * FROM users WHERE Leader > 0"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_leaders++; } }
$total_leaders_online = 0; $sql = $con->query("SELECT * FROM users WHERE Leader > 0 AND Status = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_leaders_online++; } }
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-header">
              <ul id="nav" class="nav nav-pills justify-content-center mb-3">
                  <li class="page-item"><a class="button button5 page-link active" href="#admins" data-toggle="tab">Admins [<?=$total_admins_online?>/<?=$total_admins?>]</a></li>
                  <li class="page-item"><a class="button button5 page-link" href="#helpers" data-toggle="tab">Helpers [<?=$total_helpers_online?>/<?=$total_helpers?>]</a></li>
                  <li class="page-item"><a class="button button5 page-link" href="#leaders" data-toggle="tab">Leaders [<?=$total_leaders_online?>/<?=$total_leaders?>]</a></li>
                </ul>
              </div>
              <div class="tab-content no-padding">
              <div class="tab-pane card-body table-responsive p-0 fade active show" id="admins">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                    <th>Status</th>
                      <th>Name</th>
                      <th></th>
                      <th>Level</th>
                      <th>Last online</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = $con->query("SELECT * FROM `users` WHERE Admin > 0 ORDER BY Admin DESC");
                        if($sql->num_rows != 0) {
                          while($row = $sql->fetch_assoc()) 
                          {
                            $status_type = "o";
                            if($row['Status'] == 1){$status_type = "Online"; }else {$status_type = "Offline";}
                            ?>
                            <tr>
                              <td><?=$status_type?></td>
                              <td><a href="profile.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                              <td><?=GetImportantUserBadges($row['id'])?></td> 
                              <td><?=$row['Admin']?></td> 
                              <td><?=$row['lastOn']?></td>
                            </tr>
                        <?php
                          }
                        }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane card-body table-responsive p-0 fade" id="helpers">
            <table class="table table-hover text-nowrap no-padding">
                  <thead>
                    <tr class="bg-black">
                    <th>Status</th>
                      <th>Name</th>
                      <th>Level</th>
                      <th>Last online</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = $con->query("SELECT * FROM `users` WHERE Helper > 0 ORDER BY Helper DESC");
                        if($sql->num_rows != 0) {
                          while($row = $sql->fetch_assoc()) 
                          {
                            $status_type = "o";
                            if($row['Status'] == 1){$status_type = "Online"; }else {$status_type = "Offline";}
                            ?>
                            <tr>
                              <td><?=$status_type?></td>
                              <td><a href="profile.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                              <td><?=$row['Helper']?></td> 
                              <td><?=$row['lastOn']?></td>
                            </tr>
                        <?php
                          }
                        }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane card-body table-responsive p-0 fade" id="leaders">
            <table class="table table-hover text-nowrap no-padding">
                  <thead>
                    <tr class="bg-black">
                    <th>Status</th>
                      <th>Name</th>
                      <th>Faction</th>
                      <th>Faction days</th>
                      <th>Last online</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = $con->query("SELECT * FROM `users` WHERE Leader > 0");
                        if($sql->num_rows != 0) {
                          while($row = $sql->fetch_assoc()) 
                          {
                            $status_type = "o";
                            if($row['Status'] == 1){$status_type = "Online"; }else {$status_type = "Offline";}
                            $faction_tmp = $current_timestamp - $row['FactionJoin'];
                            ?>
                            <tr>
                              <td><?=$status_type?></td>
                              <td><a href="profile.php?id=<?=$row['id']?>"><?=$row['name']?></a></td>
                              <td><?=GetGroupNameByID($row['Leader'])?></td> 
                              <td><?=howDaysAgo($faction_tmp)?></td> 
                              <td><?=$row['lastOn']?></td>
                            </tr>
                        <?php
                          }
                        }
                    ?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
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