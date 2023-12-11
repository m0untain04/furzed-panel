<?php
require_once("header.php");
if($_COOKIE['login_user'] == 0)
{
    header("Location: index.php");
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Unbans request</h3><br> 
                <h3 class="card-title"><a href="unban_request.php">Request unban</a></h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>User</th>
                      <th>Admin</th>
                      <th>Date</th>
                      <th>Unban status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_unbans` ORDER BY id_topic DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id_topic']?></td>
                                    <td><a href="profile.php?id=<?=$row['user']?>"><?=GetUserNameByID($row['user'])?></a></td>
                                    <td><a href="profile.php?id=<?=$row['admin']?>"><?=GetUserNameByID($row['admin'])?></a></td>
                                    <td><?=$row['date']?></td>
                                    <?php if($row['status'] == 1){?>
                                    <td><a href="unban.php?id=<?=$row['id_topic']?>" class="badge bg-success">topic opened</a></td>
                                    
                                    <?php 
                                    }
                                    else 
                                    { ?>
                                    <td><a href="unban.php?id=<?=$row['id_topic']?>" class="badge bg-danger">topic closed</a></td><?php
                                }
                                } ?>
                            <?php
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
<?php
require_once("footer.php");
?>