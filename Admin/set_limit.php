<?php
     require "includes/db.php";
     require "includes/functions.php";
     $limit = $_POST['limit'];
     if($limit > 0){
         $lim = $db->query("UPDATE limi SET lim = $limit");
         header("Location: limit.php?res=1");
     }
     else{
         echo '<scrit>alert("Error");</script>';
     }
?>