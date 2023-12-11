<?php require_once("header.php");?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card card-danger">
              <!-- /.card-header -->
              <div class="card-header">
                <h3 class="card-title">Factions / Factiuni</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr class="bg-black">
                      <th>#</th>
                      <th>Name</th>
                      <th>Members</th>
                      <th>Options</th>
                      <th>Applications</th>
                      <th>Requirements</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql = $con->query("SELECT * FROM `factions` ORDER BY ID ASC");
                      if($sql->num_rows != 0) {
                        while($row = $sql->fetch_assoc()) 
                        {
                          $fac_id = $row['ID'];
                          $totalfaction_members = 0; $sql2 = $con->query("SELECT * FROM `users` WHERE Member = '$fac_id'"); if($sql2->num_rows > 0) { while($row2 = $sql2->fetch_assoc()) { $totalfaction_members++; } }
                        ?>
                          <tr>
                            <td><?=$fac_id?></td>
                            <td><?=$row['Name']?></td>
                            <td><?=$totalfaction_members?>/<?=$row['MaxMembers']?></td>
                            <?php
                            if($_COOKIE['login_user'] == 0)
                            {
                            
                            ?>
                            <td><a data-toggle="modal" data-target="#modal-danger">members</a> / <a data-toggle="modal" data-target="#modal-danger">logs</a> / <a data-toggle="modal" data-target="#modal-danger">applications</a> / <a data-toggle="modal" data-target="#modal-danger">complaints</a></td>
                            <td><span class="badge bg-danger" href='login.php'>not logged in</span></td>
                            <?php
                            }
                            else
                            {
                            ?>
                            <td><a href='fac_members.php?id=<?=$row['ID']?>'>members</a> / <a href='fac_logs.php?id=<?=$row['ID']?>'>logs</a> / <a href='fac_applications.php?id=<?=$row['ID']?>'>applications</a> / <a href='fac_complaints.php?id=<?=$row['ID']?>'>complaints</a></td>
                            <?php if($row['Application'] == 1){?>
                              <td><span class="badge bg-success">applications opened</span></td>
                              
                              <?php 
                              }
                              else 
                            { ?>
                            <td><span class="badge bg-danger">applications closed</span></td><?php
                          }
                        } ?>
                            <td>level <?=$row['MinLevel']?></td>
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
<div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Oops ! Something went wrong...</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>You need to be logged in to see this section&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light"><a href="login.php">Login</a></button>
            </div>
          </div>
        <!-- /.row -->
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php require_once("footer.php");?>