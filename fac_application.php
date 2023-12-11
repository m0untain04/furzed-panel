<?php require_once("header.php");
$fcomplaint_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fcomplaint_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");

if(isset($_POST['reply_input']) || isset($_POST['complaint_actions'])) {
  $reply_msg = $_POST['reply_input'];
  /*
  if (!empty($reply_msg)) {
      $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
      $row = mysqli_fetch_assoc($sql);
      $faction_leader = GetGroupLeaderID($row['faction_id']);
      if($acc_id == $faction_leader) //prevent from entering comments user that is not leader, accuser or complainer
      {
        header("Location: fac_application.php?id=$fcomplaint_id");
      }
      else
      {
        return header("Location: index.php");
      }
  }
*/
    switch($_POST['complaint_actions']) {
      case "reject": {
        if (!empty($reply_msg)) {
            $con->query("UPDATE panel_faction_applications SET status = '0', reason = '$reply_msg' WHERE id = '$fcomplaint_id'");
            $sql2 = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
            $row2 = $sql2->fetch_assoc();
            $uid2 = $row2['user_id'];
            $ACTUAL22_skin_id = explode("|", $acc_skin_id);
            if($sql2->num_rows != 0) {
            mysqli_query($con, "INSERT INTO panel_notifications(notification_receiver, notification_title, notification_short_text, notification_timestamp, notification_image, notification_read, notification_href) VALUES ('$uid2', 'Faction application', 'Your application for...', '$current_timestamp', 'dist/img/avatars/40/$ACTUAL22_skin_id.png', '0', 'fac_application.php?id=$fcomplaint_id')");
            header("Location: fac_application.php?id=$fcomplaint_id");
            }
            break;
        }
        else
        {
            ?>
            <script>alert("Reason message is empty !");</script>
            <?php
        }
        break;
      }
      case "accept": {
        $con->query("UPDATE panel_faction_applications SET status = '2', reason = '$reply_msg' WHERE id = '$fcomplaint_id'");
        $sql2 = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
        $row2 = $sql2->fetch_assoc();
        $uid2 = $row2['user_id'];
        $ACTUAL22_skin_id = explode("|", $acc_skin_id);
        if($sql2->num_rows != 0) {
        mysqli_query($con, "INSERT INTO panel_notifications(notification_receiver, notification_title, notification_short_text, notification_timestamp, notification_image, notification_read, notification_href) VALUES ('$uid2', 'Faction application', 'Your application for...', '$current_timestamp', 'dist/img/avatars/40/$ACTUAL22_skin_id.png', '0', 'fac_application.php?id=$fcomplaint_id')");
        header("Location: fac_application.php?id=$fcomplaint_id");
        }
        break;
      }
    }
  }

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6 center">
                <!-- About Me Box -->
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Application info</h3>
                </div>
                <?php
                $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
                if($sql->num_rows != 0) {
                    $row = $sql->fetch_assoc();
                    
                    ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <strong><i class="fas fa-user mr-1"></i> User</strong>

                    <p class="text-muted">
                    <?=GetUserNameByID($row['user_id'])?>
                    </p>
                    <?php
                    $accuser = $row['user_id'];
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

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Questions</strong>
                    <?php
                    $sql3 = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
                     if($sql3->num_rows != 0) {
                     $row3 = $sql3->fetch_assoc();
                            $factionn_id = $row['faction_id'];
                            $sql5 = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$fcomplaint_id'"); 
                            if($sql5->num_rows > 0) 
                            { 
                                while($row5 = $sql5->fetch_assoc()) 
                                { 
                                    $total_questions++; 
                                $what_to_select = "question".$total_questions."_text";
                            } 
                        }
                            if($row3[$what_to_select] != "none")
                            {
                                $sql4 = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$factionn_id' ORDER BY id ASC");
                                $row4 = $sql4->fetch_assoc();
                                while($row4 = $sql4->fetch_assoc()) 
                                {
                            ?>
                            <hr>
                            <p class="text"><?=$row4['question_text']?></p> <p class="text-muted"><?=$row3[$what_to_select]?></p>
                            <hr>
                            <?php
                        }
                    }
                }
                ?>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Faction History</strong>
                <?php
                        $aidd = $row['user_id'];
                      $sql5 = $con->query("SELECT * FROM factionlog WHERE player = '$aidd'");
                          if($sql5->num_rows != 0) {
                              $row5 = $sql5->fetch_assoc();
                              ?>
                              <p class="text"><?=$row5['action']?></p>
                              <?php
                ?>
                <hr>
                <?php
                    }
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
          <div class="col-md-4">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content no-padding">
                  <div class="active tab-pane" id="settings">
                    <?php
                        $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
                        if($sql->num_rows != 0) {
                            while($row = $sql->fetch_assoc()) 
                            {
                                if($row["status"] == 1) {
                                  if($acc_leader == $row['faction_id'])
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
                                            <?php
                                            $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE id = '$fcomplaint_id'");
                                            if($sql->num_rows != 0) {
                                            while($row = $sql->fetch_assoc()) 
                                            {
                                                 if($acc_admin > 5)
                                                {
                                                  ?>
                                                    <option value='accept'>After action: Accept application</option>
                                                    <option value='reject'>After action: Reject application</option>
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
                                        Options not available.
                                        </div>
                                    </form>
                                    <?php
                                  }
                                }
                                else if($row["status"] == 0) {
                                  ?>
                                  <form class="form-horizontal">
                                  <div class="alert alert-danger alert-dismissible">
                                      <h5><i class="icon fas fa-ban"></i></h5>
                                      Application rejected. Reason: <?=$row["reason"]?>
                                      </div>
                                  </form>
                                  <?php
                                }
                                else if($row["status"] == 3 || $row["status"] == 2) {
                                    ?>
                                    <form class="form-horizontal">
                                    <div class="alert alert-success alert-dismissible">
                                        <h5><i class="icon fas fa-check"></i></h5>
                                        Application accepted !
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<?php 
require_once("footer.php");
?>