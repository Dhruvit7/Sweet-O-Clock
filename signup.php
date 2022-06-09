<?php
require_once("dbConnection.php");
$error_bool = false;
$required = array('username', 'password', 'confirm-password', 'email', 'firstname', 'lastname', 'dob', 'seq', 'sque');
$error_tabs = array();
$un = htmlspecialchars($_POST["username"]);
$email = htmlspecialchars($_POST["email"]);
$fname =  htmlspecialchars($_POST["firstname"]);
$lname = htmlspecialchars($_POST["lastname"]);
$dob = htmlspecialchars($_POST["dob"]);
$seq = htmlspecialchars($_POST["seq"]);
$sque = htmlspecialchars($_POST["sque"]);
$password = htmlspecialchars($_POST['password']);
$stat = 'active';
foreach ($required as $field)
 {
	if (empty($_POST[$field]))
	{
		$error_bool = true;
		array_push($error_tabs, $field);
	}
}

if (isset($_POST["username"], $_POST["password"], $_POST["confirm-password"], $_POST["email"], $_POST["dob"], $_POST["firstname"], $_POST["lastname"], $_POST["seq"], $_POST["sque"]) && !$error_bool) 
{
	if ($_POST["confirm-password"] != $_POST["password"]) 
	{
		header('Location: index.php?valr=1');
	}
	elseif(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password))
	{
		header('Location:index.php?valr=3');
	}
	else 
	{
		// Check if entry does not exists already
		$resp = $db->prepare('SELECT username,email FROM users WHERE username = :username OR email = :email');
		$resp->bindParam(':username', $_POST["username"]);
		$resp->bindParam(':email', $_POST["email"]);
		
		$resp->execute();
		
			if ($resp->rowCount() == 0) 
			{
                try
					{
				$ins = $db->prepare('INSERT INTO users VALUES (NULL,:username,:password,:first_name,:last_name,:email,:dob,:seq,:sque,:stat)');
				$hashedPass = sha1($_POST["password"], false);
				$ins->bindParam(':username', $un);
				$ins->bindParam(':email', $email);
				$ins->bindParam(':password', $hashedPass);
				$ins->bindParam(':first_name', $fname);
				$ins->bindParam(':last_name', $lname);
				$ins->bindParam(':dob', $dob);
				$ins->bindParam(':seq', $seq);
				$ins->bindParam(':sque', $sque);
				$ins->bindParam(':stat', $stat);
			

				//Other validations
                $ins->execute();
						header('Location: index.php?valre=success');
                    }
					catch (PDOException $e) 
					{
						echo $e->getMessage();
					}
			}
			if ($resp->rowCount() > 0){
				header('Location: index.php?valr=4');
                echo $resp->rowCount();
			}
		
	}
}
else{
	header('Location: index.php?valr=2');
}
