<?php 
require_once("scripts/functions.php");
$question_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$question_id || $_COOKIE['login_user'] == 0) echo'acces denied ! #1';
if($acc_leader == 0) echo'acces denied ! #2';
$sql = $con->query("SELECT * FROM panel_faction_questions WHERE id = '$question_id'");
if($sql->num_rows > 0) 
{ 
    while($row = $sql->fetch_assoc()) 
    {
        if($acc_leader != $row['faction_id']) echo'acces denied ! #3';
        mysqli_query($con, "DELETE FROM `panel_faction_questions` WHERE id = '$question_id'");
        return header("Location: set_questions.php");
    }
}
else
{
    echo'acces denied ! #4';
}
?>