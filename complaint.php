<?php require_once("header.php");
$fcomplaint_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fcomplaint_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");


if(isset($_POST['reply_input']) || isset($_POST['complaint_actions']) || isset($_POST['input_time']) || isset($_POST['input_reason'])) {
  $reply_msg = $_POST['reply_input'];
  $input_Timee = $_POST['input_time'];
  $input_reasoon = $_POST['input_reason'];
  if(strlen($input_reasoon) < 1) $input_reasoon = "No reason specified.";
  if (!empty($reply_msg)) {
      $sql = $con->query("SELECT * FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
      $row = mysqli_fetch_assoc($sql);
      if($acc_id == $row['complainer'] || $acc_id == $row['accuser'] || $acc_admin > 5) 
      {
        header("Location: fac_complaint.php?id=$fcomplaint_id");
        mysqli_query($con, "INSERT INTO complaint_comments(comm_author, comm_complaint_type, comm_complaint_id, comm_complaint_text, date) VALUES ('$acc_id', '0', '$fcomplaint_id', '$reply_msg', '$current_timestamp')");
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
        if($acc_id == $row['complainer'] || $acc_admin > 5)
        {
          $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
          break;
        }
        else
        {
          return header("Location: index.php");
        }
      }
      case "ban_accuser": {
        if($acc_admin > 5) 
        {
          if(!empty($input_Timee) && is_numeric($input_Timee) && $input_Timee <= 90)
          {
            $sql = $con->query("SELECT accuser FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
            if($sql->num_rows != 0) {
              $row = $sql->fetch_assoc();
              $uid = $row['accuser'];
              $playernameeeee = GetUserNameByID($uid);
              $givernameeeee = GetUserNameByID($acc_id);
              $ban_panel_time = $current_timestamp + 86400 * $input_Timee;
              if($input_Timee == 0)
              {
                mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('2', '0', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
              }
              else
              {
                mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('1', '$ban_panel_time', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
              }
              $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
            }
          }
          else
          {
            ?>
            <script> alert("ERROR: Maybe the Time input is empty, or it's not numeric.") </script>
            <?php
          }
        }
        else
        {
          break;
          return header("Location: index.php");
        }
        break;
      }
      case "warn_accuser": {
        if($acc_admin > 5) 
        {
          $sql = $con->query("SELECT accuser FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
          if($sql->num_rows != 0) {
            $row = $sql->fetch_assoc();
            $uid = $row['accuser'];
            $playernameeeee = GetUserNameByID($uid);
            $givernameeeee = GetUserNameByID($acc_id);
            mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('4', '0', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
            $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
          }
        }
        else
        {
          break;
          return header("Location: index.php");
        }
        break;
      }
      case "mute_accuser": {
        if($acc_admin > 5) 
        {
          if(!empty($input_Timee) && is_numeric($input_Timee) && $input_Timee <= 60)
          {
            $sql = $con->query("SELECT accuser FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
            if($sql->num_rows != 0) {
              $row = $sql->fetch_assoc();
              $uid = $row['accuser'];
              $playernameeeee = GetUserNameByID($uid);
              $givernameeeee = GetUserNameByID($acc_id);
              mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('5', '$input_Timee', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
              $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
            }
          }
          else
          {
            ?>
            <script> alert("ERROR: Maybe the Time input is empty, or it's not numeric.") </script>
            <?php
          }
        }
        else
        {
          break;
          return header("Location: index.php");
        }
        break;
      }
      case "jail_accuser": {
        if($acc_admin > 5) 
        {
          if(!empty($input_Timee) && is_numeric($input_Timee) && $input_Timee <= 60)
          {
            $sql = $con->query("SELECT accuser FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
            if($sql->num_rows != 0) {
              $row = $sql->fetch_assoc();
              $uid = $row['accuser'];
              $playernameeeee = GetUserNameByID($uid);
              $givernameeeee = GetUserNameByID($acc_id);
              mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('3', '$input_Timee', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
              $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
            }
          }
          else
          {
            ?>
            <script> alert("ERROR: Maybe the Time input is empty, or it's not numeric.") </script>
            <?php
          }
        }
        else
        {
          break;
          return header("Location: index.php");
        }
        break;
      }
      case "suspend_accuser": {
        if($acc_admin > 5) 
        {
          if(!empty($input_Timee) && is_numeric($input_Timee) && $input_Timee <= 60)
          {
            ?>
            <script> alert("ERROR: Maybe the Time input is empty, or it's not numeric.") </script>
            <?php
            /*
            $sql = $con->query("SELECT accuser FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
            if($sql->num_rows != 0) {
              $row = $sql->fetch_assoc();
              $uid = $row['accuser'];
              $playernameeeee = GetUserNameByID($uid);
              $givernameeeee = GetUserNameByID($acc_id);
              mysqli_query($con, "INSERT INTO panelactions(actionid, actiontime, complaintid, playerid, giverid, playername, givername, reason) VALUES ('3', '$input_Timee', '$fcomplaint_id', '$uid', '$acc_id', '$playernameeeee', '$givernameeeee', '$input_reasoon')");
              $con->query("UPDATE panel_normal_complaints SET status = '0' WHERE id = '$fcomplaint_id'");
            }
            */
          }
          else
          {
            ?>
            <script> alert("ERROR: Maybe the Time input is empty, or it's not numeric.") </script>
            <?php
          }
        }
        else
        {
          break;
          return header("Location: index.php");
        }
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
                $sql = $con->query("SELECT * FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
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
                    $sql = $con->query("SELECT * FROM `complaint_comments` WHERE comm_complaint_type = '0' AND comm_complaint_id = '$fcomplaint_id' ORDER BY id ASC");
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
                        $sql = $con->query("SELECT * FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
                        if($sql->num_rows != 0) {
                            while($row = $sql->fetch_assoc()) 
                            {
                                if($row["status"] != 0) {
                                  if($acc_id == $row['complainer'] || $acc_id == $row['accuser'] || $acc_admin > 5)
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
                                            $sql = $con->query("SELECT * FROM `panel_normal_complaints` WHERE id = '$fcomplaint_id'");
                                            if($sql->num_rows != 0) {
                                            while($row = $sql->fetch_assoc()) 
                                            {
                                                if($acc_id == $row['complainer'])
                                                {
                                                  ?>
                                                    <option value='close'>After action: Close complaint</option>
                                                  <?php
                                                }
                                                else if($acc_admin > 5)
                                                {
                                                  ?>
                                                    <option value='close'>After action: Close complaint</option>
                                                    <option value='ban_accuser'>After action: Ban accuser</option>
                                                    <option value='warn_accuser'>After action: Warn accuser</option>
                                                    <option value='mute_accuser'>After action: Mute accuser</option>
                                                    <option value='jail_accuser'>After action: Jail accuser</option>
                                                    <option value='suspend_accuser'>After action: Suspend accuser</option>
                                                    </select>
                                                    </br>
                                                    <input class="form-control form-control-sm" onfocus="this.value=''" placeholder="Ban days, jail minutes, suspend days, mute minutes (If selected BAN, MUTE, JAIL, SUSPEND)" name="input_time">
                                                    <p></p>
                                                    <input class="form-control form-control-sm" onfocus="this.value=''" placeholder="Reason (EXCEPT CLOSE COMPLAINT AND RELOAD PAGE)" name="input_reason">
                                                  <?php
                                                }
                                              }
                                            }
                                            ?>
                                                                                                </div>
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
                                        You cannot reply to this complaint because you are not a admin, the accuser or the complainer.
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