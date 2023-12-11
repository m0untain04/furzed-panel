<?php
ob_start();
session_start();
require_once("mysql.php");

$current_timestamp = time();

$total_admins = 0; $sql = $con->query("SELECT * FROM `users` WHERE Admin > 0"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_admins++; } }
$total_players_online = 0; $sql = $con->query("SELECT * FROM users WHERE Status = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_players_online++; } }
$total_registred_players = 0; $sql = $con->query("SELECT * FROM users"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_registred_players++; } }
$total_banned_players = 0; $sql = $con->query("SELECT * FROM bans"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_banned_players++; } }
$total_houses_owned = 0; $sql = $con->query("SELECT * FROM houses WHERE Owner != 'AdmBot'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_houses_owned++; } }
$total_houses_not_owned = 0; $sql = $con->query("SELECT * FROM houses WHERE Owner = 'AdmBot'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_houses_not_owned++; } }
$total_biz_not_owned = 0; $sql = $con->query("SELECT * FROM bizz WHERE Owner = 'AdmBot'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_biz_not_owned++; } }
$total_biz_owned = 0; $sql = $con->query("SELECT * FROM bizz WHERE Owner != 'AdmBot'"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_biz_owned++; } }
$total_vehicles_owned = 0; $sql = $con->query("SELECT * FROM cars WHERE VIP = 0"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_vehicles_owned++; } }
$total_vehicles_vip = 0; $sql = $con->query("SELECT * FROM cars WHERE VIP = 1"); if($sql->num_rows > 0) { while($row = $sql->fetch_assoc()) { $total_vehicles_vip++; } }

// -> Configs
$domain = "panel.furzed.eu";
$url = "http://panel.furzed.eu/";
$default_logo = "$url/favicon.ico";
$date = date("F j, Y") . " at " . date("H:i");


// -> Cookies
if($_COOKIE['login_user'] != 0) {
    $sess_id = $_COOKIE['login_user'];
    $sql = $con->query("SELECT * FROM sessions WHERE sess_id = '$sess_id'");
    if($sql->num_rows == 0) {
        setcookie('login_user', '', time() - 3600, '', $domain);
    }
    else {
        $row = mysqli_fetch_assoc($sql);
        $acc_id = $row['acc_id'];
        $sql = $con->query("SELECT * FROM users WHERE id = '$acc_id'");
        $row = mysqli_fetch_assoc($sql);
        if($sql->num_rows != 0) {
            $acc_name = $row['name'];
            $acc_level = $row['Level'];
            $acc_skin_id = $row['Skin'];
            $acc_admin = $row['Admin'];
            $acc_leader = $row['Leader'];
            $acc_faction = $row['Member'];
            $acc_rank = $row['Rank'];
        }
        else {
            setcookie('login_user', '', time() - 3600, '', $domain);
        }
    }
}
/*
$offer_url = current_url();
if($acc_admin >= 6 || $offer_url == "$url" . "login.php")
{

}
else
{
    return header("Location: blocked-panel.php");
}
*/
// -> Functions
function GetDateAndTime() { return date("F j, Y") . " at " . date("g:i"); }

function current_url()
{
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp;", $url);
    return $validURL;
}
function IsSQLInjection($string) {
    if(strpos($string, "'") !== false) return true;
    else return false;
}

function GetUserBadges($id) {
    require("mysql.php");
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql) or die("Query Failed");
    $row = mysqli_fetch_assoc($result);
    $badges = "";
    if($row['id'] == 1) $badges = "$badges <span class='badge bg-black'><font style='font-family:verdana;'><i class='fas fa-code'></i> <strong> scripter </strong> </font></span>";
    if($row['id'] == 1 || $row['id'] == 2) $badges = "$badges <span class='badge bg-danger'><font style='font-family:verdana;'><i class='fas fa-crown'></i> <strong> owner </strong> </font></span>";
    if($row['id'] == 54) $badges = "$badges <span class='badge bg-purple'><font style='font-family:verdana;'><i class='fas fa-code'></i> <strong> panel developer </strong> </font></span>";
    if($row['Admin'] > 0) $badges = "$badges <span class='badge bg-blue'><font style='font-family:verdana;'><i class='fas fa-user-shield'></i> <strong> admin </strong> </font></span>";
    if($row['Leader'] > 0) $badges = "$badges <span class='badge bg-purple'><font style='font-family:verdana;'><i class='fas fa-users'></i> <strong> faction leader </strong> </font></span>";
    if($row['Premium'] == 1) $badges = "$badges <span class='badge bg-green'><font style='font-family:verdana;'><i class='fas fa-atom'></i> <strong> premium account </strong> </font></span>";
    if($row['VIP'] == 1) $badges = "$badges <span class='badge bg-green'><font style='font-family:verdana;'><i class='fas fa-star'></i> <strong> vip </strong> </font></span>";
    if($row['Youtuber'] == 1) $badges = "$badges <span class='badge bg-red'><font style='font-family:verdana;'><i class='fas fa-youtube'></i> <strong> Youtuber </strong> </font></span>";
    return $badges;
}

function GetImportantUserBadges($id) {
    require("mysql.php");
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql) or die("Query Failed");
    $row = mysqli_fetch_assoc($result);
    $badges = "";
    if($row['id'] == 1 || $row['id'] == 2) $badges = "$badges <span class='badge bg-danger'><font style='font-family:verdana;'><i class='fas fa-crown'></i> <strong> owner </strong> </font></span>";
    if($row['id'] == 1) $badges = "$badges <span class='badge bg-black'><font style='font-family:verdana;'><i class='fas fa-code'></i> <strong> scripter </strong> </font></span>";
    if($row['id'] == 2) $badges = "$badges <span class='badge bg-black'><font style='font-family:verdana;'><i class='fas fa-crosshairs'></i> <strong> sparg buci </strong> </font></span>";
    if($row['id'] == 54) $badges = "$badges <span class='badge bg-purple'><font style='font-family:verdana;'><i class='fas fa-code'></i> <strong> panel developer </strong> </font></span>";
    return $badges;
}

function howDaysAgo($time_difference)
{
        $string = " day";
        $divider = 86400;
        if ($divider) {
            $diff = round($time_difference / $divider);
        } else {
            $diff = round($time_difference);
        }

        if ($diff != 1) {
            $pluralize = "s";
        }

        $final = $diff.$string.$pluralize.
        " ago";
        return $final;
}

function GetGroupLeaderID($group_id)
{
    require("mysql.php");
    $sql = $con->query("SELECT * FROM `users` WHERE Leader = '$group_id'");
    if($sql->num_rows != 0) 
    {
        $row = mysqli_fetch_assoc($sql);
        $name_faction = $row['id'];
        return $name_faction;
    }
    else
    {
         return 'Unknown';
    }
}

function GetGroupCoLeaderID($group_id) {
    require("mysql.php");
    
    $sql = $con->query("SELECT * FROM `users` WHERE Member = '$group_id' AND rank = '6'");
    if($sql->num_rows != 0) 
    {
        $row = mysqli_fetch_assoc($sql);
        $name_faction = $row['id'];
        return $name_faction;
    }
    else
    {
         return 'Unknown';
    }
}

function GetGroupNameByID($group_id)
{
    require("mysql.php");
    if($group_id == 0)
    {
        return 'Civilian';
    }
    $sql = $con->query("SELECT * FROM `factions` WHERE ID = '$group_id'");
    if($sql->num_rows != 0) 
    {
        $row = mysqli_fetch_assoc($sql);
        $name_faction = $row['Name'];
        return $name_faction;
    }
    else
    {
         return 'Unknown';
    }
}
function GetUserNameByID($user_id)
{
    require("mysql.php");
    $sql = $con->query("SELECT * FROM `users` WHERE id = '$user_id'");
    if($sql->num_rows != 0) 
    {
        $row = mysqli_fetch_assoc($sql);
        $name_faction = $row['name'];
        return $name_faction;
    }
    else
    {
         return 'Unknown';
    }
}
function GetUserIDbyName($user_name)
{
    require("mysql.php");
    $sql = $con->query("SELECT * FROM `users` WHERE name = '$user_name'");
    if($sql->num_rows != 0) 
    {
        $row = mysqli_fetch_assoc($sql);
        $name_faction = $row['id'];
        return $name_faction;
    }
    else
    {
         return 'Unknown';
    }
}

function howLongAgo($time_difference) {

    // Swtich logic based on the time difference passed to this function, sets the english string and what number the difference needs to be divided by
    switch ($time_difference) {
       case ($time_difference < 60):
          $string = " second";
          break;
       case ($time_difference >= 60 && $time_difference < 3600):
          $string = " minute";
          $divider = 60;
          break;
       case ($time_difference >= 3600 && $time_difference < 86400):
          $string = " hour";
          $divider = 3600;
          break;
       case ($time_difference >= 86400 && $time_difference < 2629743):
          $string = " day";
          $divider = 86400;
          break;
       case ($time_difference >= 2629743 && $time_difference < 31556926):
          $string = " month";
          $divider = 2629743;
          break;
       case ($time_difference >= 31556926):
          $string = " year";
          $divider = 31556926;
          break;
    }
 
    // If a divider value is set during the switch, use it to get the actual difference
    if ($divider) {
       $diff = round($time_difference / $divider);
    } else {
       $diff = round($time_difference);
    }
    // If the difference does not equal 1, pluralize the final result EG: hours, minutes, seconds
    if ($diff != 1) {
       $pluralize = "s";
    }
    // Concatenate all variables together and return them
    $final = $diff.$string.$pluralize.
    " ago";
    return $final;
 
 }
?>