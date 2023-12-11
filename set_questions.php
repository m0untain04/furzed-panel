<?php require_once("header.php");
if($_COOKIE['login_user'] == 0) return header("Location: index.php");
if($acc_leader <= 0) return header("Location: index.php");
$total_questions = 0; $sql = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$acc_leader'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_questions++; } }
if(isset($_POST['reply_input'])) {
    $reply_msg = $_POST['reply_input'];
    if (!empty($reply_msg)) {
        if($total_questions >= 10) 
        {
            ?>
            <script> alert("You are over the question limit !") </script>
            <?php
        }
        else
        {
            mysqli_query($con, "INSERT INTO panel_faction_questions(faction_id, question_text) VALUES ('$acc_leader', '$reply_msg')");
        }

    }
    if(empty($reply_msg)) {
      ?>
      <script> alert("You must enter a question!") </script>
      <?php
    }
}
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><a class="fas fa-people-arrows"></a> Questions</h3>
            </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p></p>
                <span class="badge badge-success"></span>
                <?php
                    $sql = $con->query("SELECT * FROM `panel_faction_questions` WHERE faction_id = '$acc_leader' ORDER BY id ASC");
                    if($sql->num_rows > 0) 
                    { 
                        while($row = $sql->fetch_assoc()) {
                ?>
                <li><?=$row['question_text']?></li><a href="delete_question.php?id=<?=$row['id']?>">Delete question</a>
                <?php
                        }
                    }
                ?>
                <p>
</p>
                <form method="post">
                    <input class="form-control form-control-sm" onfocus="this.value=''" placeholder="Enter question here (10 QUESTIONS MAX)" name="reply_input">
                        <br>
                        <button type="submit" class="btn btn-danger">Post</button>
                </form>
              </div>
              <!-- /.mailbox-read-message -->
        </div>
    </div>
    </div>
<?php require_once("footer.php");?>