<?php require_once("header.php");?>
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
                      <th>Level</th>
                      <th>Group</th>
                      <th>Hours Played</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        $sql = $con->query("SELECT * FROM `users` WHERE `Status` = 1");
                        if($sql->num_rows != 0) {
                          while($row = $sql->fetch_assoc()) 
                          {
                            ?>
                            <tr>
                              <td><?=$row['name']?></td> 
                              <td><?=$row['Level']?></td> 
                              <td><?=GetGroupNameByID($row['Member'])?></td> 
                              <td><?=$row['ConnectedTime']?></td>
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