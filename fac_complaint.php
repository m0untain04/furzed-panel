<?php require_once("header.php");
$fcomplaint_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fcomplaint_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");


if(isset($_POST['reply_input']) || isset($_POST['complaint_actions'])) {
  $reply_msg = $_POST['reply_input'];
  if (!empty($reply_msg)) {
      $sql = $con->query("SELECT * FROM `panel_faction_complaints` WHERE id = '$fcomplaint_id'");
      $row = mysqli_fetch_assoc($sql);
      $faction_leader = GetGroupLeaderID($row['faction_id']);
      if($acc_id == $row['complainer'] || $acc_id == $row['accuser'] || $acc_id == $faction_leader) //prevent from entering comments user that is not leader, accuser or complainer
      {
        header("Location: fac_complaint.php?id=$fcomplaint_id");
        mysqli_query($con, "INSERT INTO complaint_comments(comm_author, comm_complaint_type, comm_complaint_id, comm_complaint_text, date) VALUES ('$acc_id', '1', '$fcomplaint_id', '$reply_msg', '$current_timestamp')");
      }
      else
      {
        return header("Location: index.php");
      }
  }

  if(empty($reply_msg) && $_POST['complaint_actions'] != "reload") {
    ?>
    <script> alert("You must input a reply if you use an action!") </script>
    <?php
  }
  else {
    switch($_POST['complaint_actions']) {
      case "reload": break;
      case "close": {
        $con->query("UPDATE panel_faction_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
        break;
      }
      case "fw": {
        $sql = $con->query("SELECT accuser FROM `panel_faction_complaints` WHERE id = '$fcomplaint_id'");
        if($sql->num_rows != 0) {
          $row = $sql->fetch_assoc();
          $uid = $row['accuser'];
          $sql2 = $con->query("SELECT FWarn FROM users WHERE id = '$uid'");
          if($sql2->num_rows != 0) {
            $row2 = $sql2->fetch_assoc();
            $fwarns = $row2['FWarn'] + 1;
            $con->query("UPDATE users SET FWarn = '$fwarns' WHERE id = '$uid'");
          }
        }

        break;
      }
      case "mverbala": {

        break;
      }
    }
  }
}

?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <!-- About Me Box -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Complaint info</h3>
                </div>
                <?php
                $sql = $con->query("SELECT * FROM `panel_faction_complaints` WHERE id = '$fcomplaint_id'");
                if($sql->num_rows != 0) {
                    $row = $sql->fetch_assoc();
                    
                    ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <strong><i class="fas fa-user mr-1"></i> Complainer</strong>

                    <p class="text-muted">
                    <?=GetUserNameByID($row['complainer'])?>
                    </p>
                    <hr>

                    <strong><i class="fas fa-hammer mr-1"></i> Accuser</strong>

                    <p class="text-muted"><?=GetUserNameByID($row['accuser'])?></p>
                    <?php
                    $accuser = $row['accuser'];
                    $sql2 = $con->query("SELECT * FROM `users` WHERE id = '$accuser'");
                    if($sql2->num_rows != 0) {
                        $row2 = $sql2->fetch_assoc();
                        ?>
                        <p class="text-muted">Level: <?=$row2['Level']?></p>
                        <p class="text-muted">Hours: <?=$row2['ConnectedTime']?></p>
                        <p class="text-muted">Warns: <?=$row2['Warnings']?>/3</p>
                        <?php
                    }
                    ?>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Details</strong>

                    <p class="text-muted"><?=$row['complaint_string_text']?></p>

                    <hr>

                    <strong><i class="fas fa-camera mr-1"></i> Proof</strong>

                    <p class="text-muted"><?=$row['complaint_string_proof']?></p>

                    <?php
                    
                }
                else
                {
                  return header("Location: index.php");
                }
              ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
          <div class="col-md-5">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#comments" data-toggle="tab">Comments</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content no-padding">
                  <div class="active tab-pane" id="comments">
                    <!-- Post -->
                    <?php
                    $sql = $con->query("SELECT * FROM `complaint_comments` WHERE comm_complaint_type = '1' AND comm_complaint_id = '$fcomplaint_id' ORDER BY id ASC");
                    if($sql->num_rows != 0) {
                        while($row = $sql->fetch_assoc()) 
                        {
                            ?>
                            <div class="post">
                            <div class="user-block">
                            <?php
                            $reply_man = $row['comm_author'];
                            $comm_timestamp = $current_timestamp - $row['date'];
                            $sql2 = $con->query("SELECT * FROM `users` WHERE id = '$reply_man'");
                            if($sql2->num_rows != 0) 
                            {
                                while($row2 = $sql2->fetch_assoc()) 
                                {
                                    $ACTUAL_skin_id = explode("|", $row2['Skin']);
                                      ?>
                                      <img class="img-circle img-bordered-sm" src="dist/img/avatars/40/<?=$ACTUAL_skin_id[0]?>.png" alt="user image">
                                      <span class="username">
                                        <a href="#"><?=GetUserNameByID($row['comm_author'])?></a>
                                      </span>
                                      <span class="description"><?=howLongAgo($comm_timestamp)?></span>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                              <!-- /.user-block -->
                              <p>
                              <?=$row['comm_complaint_text']?>
                              </p>
                              </div>
                            <?php
                        }
                    }
                    ?>
                    <!-- /.post -->
                    <?php
                        $sql = $con->query("SELECT * FROM `panel_faction_complaints` WHERE id = '$fcomplaint_id'");
                        if($sql->num_rows != 0) {
                            while($row = $sql->fetch_assoc()) 
                            {
                                if($row["status"] != 0) {
                                  $faction_leader = GetGroupLeaderID($row['faction_id']);
                                  $faction_co_leader = GetGroupCoLeaderID($row['faction_id']);
                                  if($acc_id == $row['complainer'] || $acc_id == $row['accuser'] || $acc_id == $faction_leader || $acc_id == $faction_co_leader)
                                  {
                                    ?>
                                    <form method="post">
                                        <div class="form-horizontal">
                                            <div class="input-group input-group-sm mb-0">
                                              <input class="form-control form-control-sm" onfocus="this.value=''" placeholder="Reply" name="reply_input">
                                            </div>
                                            <div class="form-group">
                                            <br>
                                            <select class="custom-select rounded-1" name="complaint_actions">
                                            <option value="reload">After action: Reload Page</option>
                                            <?php
                                            $sql = $con->query("SELECT * FROM `panel_faction_complaints` WHERE id = '$fcomplaint_id'");
                                            if($sql->num_rows != 0) {
                                            while($row = $sql->fetch_assoc()) 
                                            {
                                                $faction_leader = GetGroupLeaderID($row['faction_id']);
                                                if($acc_id == $row['complainer'])
                                                {
                                                  ?>
                                                    <option value='close'>After action: Close complaint</option>
                                                  <?php
                                                }
                                                else if($acc_id == $faction_leader)
                                                {
                                                  ?>
                                                    <option value='close'>After action: Close complaint</option>
                                                    <option value='fw'>After action: Faction warn</option>
                                                    <option value='mverbala'>After action: Mustrare verbala</option>
                                                  <?php
                                                }
                                              }
                                            }
                                            ?>
                                            </select>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-danger">Post</button>
                                        </div>
                                        </div>
                                    </form>
                                    <?php
                                  }
                                  else
                                  {
                                    ?>
                                    <form class="form-horizontal">
                                    <div class="alert alert-danger alert-dismissible">
                                        <h5><i class="icon fas fa-ban"></i></h5>
                                        You cannot reply to this complaint because you are not the faction leader, the accuser or the complainer.
                                        </div>
                                    </form>
                                    <?php
                                  }
                                }
                                else {
                                  ?>
                                  <form class="form-horizontal">
                                  <div class="alert alert-danger alert-dismissible">
                                      <h5><i class="icon fas fa-ban"></i></h5>
                                      You cannot reply to this complaint because this is closed.
                                      </div>
                                  </form>
                                  <?php
                                }
                            }
                        }
                   ?>
                    </form>
                  </div>
                  </div>
                  </div>  
                  </div>
                <!-- /.tab-content --><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<?php 
require_once("footer.php");
?>