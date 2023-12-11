<?php require_once("header.php");
$fac_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$fac_id || $_COOKIE['login_user'] == 0) return header("Location: index.php");
/*
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
*/
?>
<section class="content">
      <div class="row">
          <div class="col-md-7" style="display:inline">
          <form method="post">
          <div class="card card-secondary text-center">
              <div class="card-header">
                <h3 class="card-title">General</h3>
              </div>
              <div class="card-body">
              <div class="form-group">
                </div>
                <label for="inputDescription">Questions</label>
                <?php
                    $sql5 = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$fac_id'"); 
                     if($sql5->num_rows > 0) 
                        { 
                            while($row5 = $sql5->fetch_assoc()) 
                            { 
                                $total_questions++; 
                                $what_to_select = "question".$total_questions."_text";
                            } 
                        }
                            $sql4 = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$fac_id' ORDER BY id ASC");
                            $row4 = $sql4->fetch_assoc();
                            while($row4 = $sql4->fetch_assoc()) 
                            {
                            ?>
                            <hr>
                            <div class="form-group">
                            <p class="text"><?=$row4['question_text']?></p> <p class="text-muted"><?=$row3[$what_to_select]?></p>
                            <textarea id="inputDescription" class="form-control" rows="3" name="text_<?=$row4['id']?>"></textarea>
                            </div>
                            <hr>
                            <?php
                        }
                ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
          <div class="col-12">
            <input type="submit" value="Application" class="btn btn-success float-right">
          </div>
          </form>
        </div>
    </section>
<?php require_once("footer.php")?>