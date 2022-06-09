<?php 
	
	$msg = "";
  
    session_start();
    $id  = $_SESSION['edit_id'];
	require "includes/db.php";
	require "includes/functions.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit']) && isset($_FILES['file'])) {
			
			$cat = htmlentities($_POST['category'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
			$price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
			$desc = htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8');
			$file = $_FILES['file'];
			$allowed_ext = array("jpg", "jpeg", "JPG", "JPEG", "png", "PNG");
			
			if($cat != "" && $name != "" && $price != "" && $desc != "" && empty($file) == false) {
				
				$ext = explode(".", $_FILES['file']['name']);
				
				if(in_array($ext[1], $allowed_ext)) {
					
					$check = $db->query("SELECT * FROM food WHERE id='".$name."' LIMIT 1");
					
					if($check->num_rows) {
						
						$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>No duplicate  food name allowed. Try again!!!</p>";
						
					}else{
					
						$upadte = $db->query("UPDATE food set food_name='".$name."' , food_category = '".$cat."' , food_price = '".$price."' ,food_description =  '".$desc."' WHERE id = '".$id."'");
						if($upadte) {
							
							$ins_id = $db->insert_id;
							
							$image_url = "../image/FoodPics/$ins_id.jpg";
							
							if(move_uploaded_file($_FILES['file']['tmp_name'], $image_url)) {
								
								$msg = "Food record successfully saved";
                                echo $msg;
								header('Location: food_list.php');
							}else{
								
								$msg = "Could not insert record, try again";
								echo $msg;
                                header('Location: food_list.php');
							}
							
						}
						
					}
					
				}else{
					
					$msg = "Invalid image file format";
					echo $msg;
                    header('Location: food_list.php');
				}
				
			}else{
				
				$msg = "Incomplete form data";
				echo $msg;
                header('Location: food_list.php');
			}
			
		}
		
	}
	
?>