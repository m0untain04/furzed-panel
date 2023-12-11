<?php require_once("header.php");
if($_COOKIE['login_user']) {
    setcookie('login_user', '', time() - 3600, '', $domain);
    header("Location: index.php");
    $con->query("DELETE FROM sessions WHERE sess_id = '$sess_id'");
    $_COOKIE['login_user'] = 0;
}
else {
    header("Location: index.php");
}