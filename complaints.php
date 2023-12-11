<?php require_once("header.php");
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
                <h3 class="card-title">Complaints / Reclamatii</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>ID</th>
                      <th>Complainer</th>
                      <th>Accuser</th>
                      <th>Reason</th>
                      <th>Date</th>
                      <th>Complaint status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                           $sql = $con->query("SELECT * FROM `panel_normal_complaints` ORDER BY id DESC");
                            if($sql->num_rows != 0) {
                                while($row = $sql->fetch_assoc()) 
                                {
                                ?>
                                 <tr>
                                    <td><?=$row['id']?></td>
                                    <td><a href="profile.php?id=<?=$row['complainer']?>"><?=GetUserNameByID($row['complainer'])?></a></td>
                                    <td><a href="profile.php?id=<?=$row['accuser']?>"><?=GetUserNameByID($row['accuser'])?></a></td>
                                    <td><?=$row['reason']?></td>
                                    <td><?=$row['date']?></td>
                                    <?php if($row['status'] == 1){?>
                                    <td><a href="complaint.php?id=<?=$row['id']?>" class="badge bg-success">complaint opened</a></td>
                                    
                                    <?php 
                                    }
                                    else 
                                    { ?>
                                    <td><a href="complaint.php?id=<?=$row['id']?>" class="badge bg-danger">complaint closed</a></td><?php
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
<?php require_once("footer.php");?>