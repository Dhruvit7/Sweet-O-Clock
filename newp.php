<?php
session_start();
require("dbConnection.php");
$password = $_POST['pwd1'];
        $password2 = $_POST['pwd2'];
        $hpass = sha1($_POST['pwd1'],false);
    if($_POST["pwd1"]==$_POST["pwd2"] ){

        if(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password))
            {
                header('Location:newpass.php?res=1',true,303);
            }
            elseif($password == "" || $password2 == ""){
                header('Location:newpass.php?res=2',true,303);
            }
            else{
                $resp = $db->prepare('UPDATE Users SET passwd = :passwd WHERE username = :username1');
                $resp->bindParam(':passwd',$hpass);
                $resp->bindParam(':username1',$_SESSION['uname']);
                $resp->execute();
                if($resp->rowCount() == 0){
                    header('Location:index.php?val=9');
                }else{
                    echo "Error";
                }
            }
    }
    else{
        header('Location:newpass.php?res=3');
    }
