<?php require_once("header.php");
$fac_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fac_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");
$sql = $con->query("SELECT * FROM `factions` WHERE ID = '$fac_id'");
if($sql->num_rows == 0) {
    return header("Location: index.php");
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card card-dark">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Aplicatii noi</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>Player</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE status = '1' ORDER BY id DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id']?></td>
                                    <td><a href="profile.php?id=<?=$row['user_id']?>"><?=GetUserNameByID($row['user_id'])?></a></td>
                                    <td><?=$row['date']?></td>
                                    <td><a href="fac_application.php?id=<?=$row['id']?>" class="badge bg-dark">view</a></td><?php
                                }
                            } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      <div class="row">
          <div class="col-12">
            <div class="card card-green">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Aplicatii acceptate pentru teste</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>Player</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE status = '2' ORDER BY id DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id']?></td>
                                    <td><a href="profile.php?id=<?=$row['user_id']?>"><?=GetUserNameByID($row['user_id'])?></a></td>
                                    <td><?=$row['date']?></td>
                                    <td><a href="fac_application.php?id=<?=$row['id']?>" class="badge bg-dark">view</a></td><?php
                                }
                            } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-purple">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Aplicatii jucatoriilor invitati</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>Player</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE status = '3' ORDER BY id DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id']?></td>
                                    <td><a href="profile.php?id=<?=$row['user_id']?>"><?=GetUserNameByID($row['user_id'])?></a></td>
                                    <td><?=$row['date']?></td>
                                    <td><a href="fac_application.php?id=<?=$row['id']?>" class="badge bg-dark">view</a></td><?php
                                }
                            } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>  
        <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Aplicatii respinse</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>Player</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE status = '0' ORDER BY id DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id']?></td>
                                    <td><a href="profile.php?id=<?=$row['user_id']?>"><?=GetUserNameByID($row['user_id'])?></a></td>
                                    <td><?=$row['date']?></td>
                                    <td><a href="fac_application.php?id=<?=$row['id']?>" class="badge bg-dark">view</a></td><?php
                                }
                            } ?>
                  </tbody>
                </table>
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