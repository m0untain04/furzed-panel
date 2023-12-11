<?php require_once("header.php");
$fac_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fac_id || $_COOKIE['login_user'] == 0)
{
    header("Location: index.php");
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>Name</th>
                      <th>Rank</th>
                      <th>FW</th>
                      <th>Days since join</th>
                      <th>Last online</th>
                      <th>Raport in factiune</th>
                      <th>Data verificare raport</th>
                      <th>Optiuni</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = $con->query("SELECT * FROM `users` WHERE `Member` = $fac_id");
                        if($sql->num_rows != 0) {
                          while($row = $sql->fetch_assoc()) 
                          {
                            $faction_tmp = $current_timestamp - $row['FactionJoin'];
                            ?>
                            <tr>
                              <td><?=$row['name']?></td> 
                              <td><?=$row['Rank']?></td> 
                              <td><?=$row['FWarn']?>/3</td> 
                              <td><?=howDaysAgo($faction_tmp)?></td>
                              <td><?=$row['lastOn']?></td>
                              <td>To do..</td>
                              <td>To do..</td>
                              <td><a class="badge bg-danger" href='report.php?id=<?=$row['id']?>'>report player</a></td>
                            </tr>
                        <?php
                          }
                        }
                    ?>
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