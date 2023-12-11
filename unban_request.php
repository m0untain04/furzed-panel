<?php require_once("header.php");
if($_COOKIE['login_user'] == 0) return header("Location: index.php");

if(isset($_POST['report_details'])) {
  $details = $_POST['report_details'];

  if(empty($details)) {
    ?>
    <script> alert("ERROR: Details not entered.") </script>
    <?php
    return header("Location: unban_request.php");
  }
  else
  {
    $sql4 = $con->query("SELECT * FROM `bans` WHERE Name = '$acc_name' LIMIT 1");
    $row4 = $sql4->fetch_assoc();
    $reason_ban = $row4['Reason'];
    $player_id = GetUserIDbyName($row4['AdminName']);
    $con->query("INSERT INTO panel_unbans(user, admin, reason, status, proof, string_text) VALUES ('$acc_id', '$player_id', '$reason_ban','1', '0', '$details')");
    return header("Location: unbans.php");
  }
}
?>
<section class="content">
      <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Unban info</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">You have been banned by:</label>
                    <hr>
                    <?php
                    $sql2 = $con->query("SELECT * FROM `bans` WHERE Name = '$acc_name' LIMIT 1");
                    if($sql2->num_rows != 0) {
                        $row2 = $sql2->fetch_assoc();
                        ?>
                        <p class="text-muted">Name: <?=$row2['AdminName']?></p>
                        <p class="text-muted">Reason: <?=$row2['Reason']?></p>
                        <p class="text-muted">Days: <?=$row2['Days']?></p>
                        <p class="text-muted">Date: <?=$row2['Date']?></p>
                        <?php
                    }
                    else
                    {
                        ?>
                        <script> alert("ERROR: No ban detected on your account.") </script>
                        <?php
                        return header("Location: index.php");
                    }
                    ?>
              </div>
              <div class="form-group">

              </div>
              <div class="form-group">

              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
          <div class="col-md-6">
          <form method="post">
          <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">General</h3>
              </div>
              <div class="card-body">
              <div class="form-group">
                </div>
                <div class="form-group">
                  <label for="inputDescription">Details</label>
                  <textarea id="inputDescription" class="form-control" rows="4" name="report_details"></textarea>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" value="Request unban" class="btn btn-success float-right">
          </div>
          </form>
        </div>
    </section>
<?php require_once("footer.php")?>