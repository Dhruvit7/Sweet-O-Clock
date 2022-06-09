<?php
require("dbConnection.php");
session_start();
$_SESSION['uname'] = $_POST["username1"];
if (isset($_POST["username1"])) {

    $resp = $db->prepare('SELECT user_id FROM users WHERE email = :username1');
    $resp->bindParam(':username1', $_POST["username1"]);
    $uname = $_POST["username1"];
    $resp->execute();
    if ($resp->rowCount() == 0) {
      
        header("Location: resetpwd.php?res=1",true,303);
    }
    else {
        header("Location: security.php");
    }

}
