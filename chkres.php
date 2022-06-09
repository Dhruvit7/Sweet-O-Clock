<?php 
	
	
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	session_start();

    $res = $db->query("SELECT * FROM reservation");
    $nrev = $res->num_rows;
    $resp = $res->fetch_assoc();
    $lim = $resp['lim'];
    if($nrev <= $lim){
        echo '<script>alert("Restaurant full")</script>';
        echo "<script>document.location = 'welcome.php'</script>";
    }
    else{
        header('Location: reservation.php');
    }
    
    ?>