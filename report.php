<?php require_once("header.php");
$player_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$player_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");

if(isset($_POST['report_details']) || isset($_POST['report_proof']) || isset($_POST['actions_report']) || isset($_POST['report_reason'])) {
  $details = $_POST['report_details'];
  $proof = $_POST['report_proof'];
  $reason = $_POST['report_reason'];

  if(empty($details) || $_POST['actions_report'] == "reload" || empty($proof) || empty($reason)) {
    ?>
    <script> alert("ERROR: Report type not selected, details not entered, proof not entered or reason not entered.") </script>
    <?php
    return header("Location: report.php?id=$player_id");
  }
  else {
    switch($_POST['actions_report']) {
      case "reload": break;
      case "normalcomplaint": {
        if(IsSQLInjection($details) == true || IsSQLInjection($proof) == true || IsSQLInjection($reason) == true)
        {
          break;
          return header("Location: index.php");
        }
        else
        {
          $con->query("INSERT INTO panel_normal_complaints(complainer, accuser, reason, status, complaint_string_text, complaint_string_proof) VALUES ('$acc_id', '$player_id', '$reason', '1', '$details', '$proof')");
          break;
          return header("Location: complaints.php");
        }
      }
      case "fcomplaint": {
        if(IsSQLInjection($details) == true || IsSQLInjection($proof) == true || IsSQLInjection($reason) == true)
        {
          break;
          return header("Location: index.php");
        }
        else
        {
          $sql = $con->query("SELECT * FROM `users` WHERE id = '$player_id'");
          $row = $sql->fetch_assoc();
          $se_misca_brr_brr = $row['Member'];
          if($row['Member'] > 0)
          {
            $con->query("INSERT INTO panel_faction_complaints(faction_id, complainer, accuser, reason, status, complaint_string_text, complaint_string_proof) VALUES ('$se_misca_brr_brr', '$acc_id', '$player_id', '$reason', '1', '$details', '$proof')");
            return header("Location: fac_complaints.php?id=$se_misca_brr_brr");
          }
          else
          {
            ?>
            <script> alert("ERROR: Player not in faction.") </script>
            <?php
          }
        }

        break;
      }
    }
  }
}
?>
<section class="content">
      <div class="row">
        <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Report info</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">You are about to report:</label>
                    <hr>
                    <?php
                    $sql2 = $con->query("SELECT * FROM `users` WHERE id = '$player_id'");
                    if($sql2->num_rows != 0) {
                        $row2 = $sql2->fetch_assoc();
                        ?>
                        <p class="text-muted">Name: <?=$row2['name']?></p>
                        <p class="text-muted">Level: <?=$row2['Level']?></p>
                        <p class="text-muted">Hours: <?=$row2['ConnectedTime']?></p>
                        <p class="text-muted">Warns: <?=$row2['Warnings']?>/3</p>
                        <p class="text-muted">FWarn: <?=$row2['FWarn']?>/3</p>
                        <?php
                    }
                    else
                    {
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
                  <label for="inputStatus">Report type</label>
                  <select id="inputStatus" class="form-control custom-select" name="actions_report">
                    <option selected="" disabled="" value='reload'>Select one</option>
                    <?php
                          $sql = $con->query("SELECT * FROM `users` WHERE id = '$player_id'");
                          $row = $sql->fetch_assoc();
                          if($row['Member'] > 0)
                          {
                    ?>
                    <option value='fcomplaint'>Faction complaint</option>
                    <?php
                          }
                  ?>
                    <option value='normalcomplaint'>Normal complaint</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputDescription">Details</label>
                  <textarea id="inputDescription" class="form-control" rows="4" name="report_details"></textarea>
                </div>
                <div class="form-group">
                  <label for="inputClientCompany">Proof</label>
                  <input type="text" id="inputClientCompany" class="form-control" name="report_proof">
                </div>
                <div class="form-group">
                  <label for="inputClientCompany">Reason</label>
                  <input type="text" id="inputClientCompany" class="form-control" name="report_reason">
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" value="Report player" class="btn btn-success float-right">
          </div>
          </form>
        </div>
    </section>
<?php require_once("footer.php")?>