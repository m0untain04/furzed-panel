<?php 
require_once("scripts/functions.php")
?>
<?php
$notification_id = $_GET['id'] ? $_GET['id'] : 0;
if(!$notification_id || $_COOKIE['login_user'] == 0)
{
    header("Location: index.php");
}
else
{
    $sql = $con->query("SELECT * FROM `panel_notifications` WHERE id = '$notification_id'");
    if($sql->num_rows == 0) {
        header("Location: index.php");
    }
    else {
        $row = mysqli_fetch_assoc($sql);
        if($row['notification_read'] == 1)
        {
            header("Location: index.php");
        }
        else
        {
            if($acc_id != $row['notification_receiver'])
            {
                header("Location: index.php");
            }
            else
            {
                $href = $row['notification_href'];
                $con->query("UPDATE `panel_notifications` SET `notification_read`='1' WHERE `id` = '$notification_id'") or die(mysqli_error());
                header("Location: $href");
            }
        }
    }
}
?>

