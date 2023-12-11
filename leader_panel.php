<?php require_once("header.php");
if($_COOKIE['login_user'] == 0) return header("Location: index.php");
if($acc_leader <= 0) return header("Location: index.php");
$total_new_applications = 0; $sql = $con->query("SELECT * FROM `panel_faction_applications` WHERE faction_id = '$acc_leader' AND status = '1'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_new_applications++; } }
$total_new_complaints = 0; $sql = $con->query("SELECT * FROM `panel_faction_complaints` WHERE faction_id = '$acc_leader' AND status = '1'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_new_complaints++; } }
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><a class="fas fa-people-arrows"></a> Leader panel</h3>
            </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p></p>
                <span class="badge badge-success"></span>
                <li><a href="f_applications.php?id=<?=$acc_leader?>">New applications (<?=$total_new_applications?>)</a></li>
                <li><a href="f_complaints.php?id=<?=$acc_leader?>">New complaints (<?=$total_new_complaints?>)</a></li>
                <li><a href="set_questions.php">Set application questions.</a></li>
                <p>
</p>
              </div>
              <!-- /.mailbox-read-message -->
        </div>
    </div>
    </div>
<?php require_once("footer.php");?>