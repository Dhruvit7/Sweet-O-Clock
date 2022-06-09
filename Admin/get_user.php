<?php 
	
	session_start();
	require "includes/functions.php";
	require "includes/db.php";
    if(!isset($_SESSION['user'])) {
        header("location: logout.php");
    }
	
	$result = "";
	$info = "";
	$items = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['order_id'])) {
			
			$order_id = htmlentities($_POST['order_id'], ENT_QUOTES, 'UTF-8');
			
			if($order_id != "") {
				
				$arr_id = explode("_", $order_id);
				
				$id = $arr_id[0];
				
				$order = $db->query("SELECT * FROM users WHERE user_id='".$id."' LIMIT 1"); 
				
				if($order->num_rows) {
					
					$row = $order->fetch_assoc();
					
					$info .= "<table class='table table-hover'>
						<thead>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Birth Date</th>
						</thead>
						<tbody>";
						
				
						
					$info .= "<tr>
                    <td>$id</td>
                    <td>".$row['username']."</td>
                    <td>".$row['first_name']."</td>
                    <td>".$row['last_name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['birthdate']."</td>
							</tr>";
							
				
					
					if($row['status'] == "active") {
						
						$items .= "<tr>
									<th>Status</th>
									<td>
										<select onChange=\"change_stat('".$id."')\" name='status' id='".$id."' class='form-control'>
											<option value='active' selected>Active</option>
											<option value='block'>Block</option>
										</select>
									</td>
									
								</tr>";
						
					}else{
						
						$items .= "<tr>
									<th>Status</th>
									<td>
										<select onChange=\"change_stat('".$id."')\" name='status' id='".$id."' class='form-control'>
                                        <option value='active' >Active</option>
                                        <option value='block' selected>Block</option>
										</select>
									</td>
									
								</tr>";
						
					}
					
					$result = $info ."".$items;
					
					 echo $result;
					
				}
				
			}
			
		}elseif(isset($_POST['status'])) {
			
			$status = htmlentities($_POST['status'], ENT_QUOTES, 'UTF-8');
			
			if($status != "") {
                $stat_arr = explode("_", $status);
				$stat_id = $stat_arr[0];
                $get_data = $db->query("SELECT * FROM users WHERE user_id='".$stat_id."'");
                $data = $get_data->fetch_assoc();
                $sts = $data['status'];
                

				if($sts == "active"){
                    $stat_name = "block";
                }
                else{
                    $stat_name = "active";
                }
				
				$update = $db->query("UPDATE users SET status='".$stat_name."' WHERE user_id='".$stat_id."' LIMIT 1");
				
				if($update) {
					
					echo "Status updated to: $stat_name";
					
				}
				
			}
			
		}
		
	}
	
?>