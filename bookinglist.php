<?php 
	
	session_start();
	require "includes/functions.php";
	require "includes/db.php";
	
	
	$result = "";
	$pagenum = "";
	$per_page = 20;
		$uname = $_SESSION['first_name'];
		$usermail = $db->query("SELECT email FROM users WHERE username = '".$uname."'");
        $res = $usermail->fetch_assoc();
        $email = $res['email'];
		$count = $db->query("SELECT * FROM reservation WHERE email = '".$email."'");
		
		$pages = ceil((mysqli_num_rows($count)) / $per_page);
		
		if(isset($_GET['page'])) {
			
			$page = $_GET['page'];
			
		}else{
			
			$page = 1;
			
		}
						
		$start = ($page - 1) * $per_page;
		
		$reserve = $db->query("SELECT * FROM reservation WHERE email = '".$email."' LIMIT $start, $per_page");
		
		if($reserve->num_rows) {
			
			$result = "<table class='table table-hover'>
						<thead>
							<th>S/N</th>
							<th>No of Guests</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Date</th>
							<th>Time</th>
							<th>Suggestions</th>
						</thead>
						<tbody>";
			
			$x = 1;
			
			while($row = $reserve->fetch_assoc()) {
				
				$reserve_id = $row['reserve_id'];
				$no_of_guest = $row['no_of_guest'];
				$email = $row['email'];
				$phone = $row['phone'];
				$date_res = $row['date_res'];
				$time = $row['time'];
				$suggestions = $row['suggestions'];
				
				
				$result .=  "<tr>
								<td>$x</td>
								<td>$no_of_guest</td>
								<td>$email</td>
								<td>$phone</td>
								<td>$date_res</td>
								<td>$time</td>
								<td>$suggestions</td>
								
							</tr>";
																
									
				$x++;
			}
			
			$result .= "</tbody>
						</table>";
			
		}else{
			
			$result = "<p style='color:red; padding: 10px; background: #ffeeee;'>No Table reservations available yet</p>";
			
		}
	
	if(isset($_GET['delete'])) {
		
		$delete = preg_replace("#[^0-9]#", "", $_GET['delete']);
		
		if($delete != "") {
			
			$sql = $db->query("DELETE FROM reservation WHERE reserve_id='".$delete."'");
		
			if($sql) {
				
				echo "<script>alert('Successfully deleted')</script>";
				
			}else{
				
				echo "<script>alert('Operation Unsuccessful. Please try again')</script>";
				
			}
			
		}
		
		
	}
	
?>

<!doctype html>
<html lang="en">
<head>
	
<title>Sweet-O'Clock</title>

<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	
    <link href="css/style.css" rel="stylesheet" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
<script>
function func_call(id) {
			
			var value = document.getElementById(id).value;
			
			if(value != "") {
				
				$.ajax({
					
					url: 'get_item.php',
					type: 'post',
					data: {order_id : value},
					success: function(data) {
						//alert(data);
						$("#details_display").html(data);
					}
				});
				
			}
			
		}
        </script>

<style>
    img[src*="https://cloud.githubusercontent.com/assets/23024110/20663010/9968df22-b55e-11e6-941d-edbc894c2b78.png"] {
    display: none;}
</style>

</head>
<body>

<?php require "includes/header.php"; ?>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" style="background: #e91e63;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="color: #fff;">TABLE RESERVATIONS</a>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Reservation List</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                
								<?php echo $result; ?>

                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                
                <p class="copyright pull-right">
                </p>
            </div>
        </footer>

    


</body>

    <!--   Core JS Files   -->
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>

	
	

</html>
