<?php 
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	
	$result = "";
	$info = "";
	$items = "";
	$pagenum = "";
	$per_page = 10;
	session_start();
		$uname = $_SESSION['first_name'];
		$count = $db->query("SELECT * FROM basket WHERE customer_name = '".$uname."'");
		
		$pages = ceil((mysqli_num_rows($count)) / $per_page);
		
		if(isset($_GET['page'])) {
			
			$page = $_GET['page'];
			
		}else{
			
			$page = 1;
			
		}
						
		$start = ($page - 1) * $per_page;
		
		$orders = $db->query("SELECT * FROM basket WHERE customer_name = '".$uname."' LIMIT $start, $per_page");
		
		if($orders->num_rows) {
			
			$x = 1;
			
			$info .= "<table class='table table-hover'>
						<thead>
							<th>Order_id</th>
							<th>name</th>
							<th>address</th>
							<th>Email</th>
							<th>Phone</th>
						</thead>
						<tbody>";
						
			$items .= "<table class='table table-hover'>
						<tbody>
						<tr>
							<th>Name</th>
							<th>Qty</th>
							<td></td>
						</tr>";
			
			while($row = $orders->fetch_assoc()) {
				
				$oid    = $row['id'];
				$id    = $row['id']."_ord";
				
				if($x == 1) {
					
					$result .=  "<input type='hidden' value='".$id."' 	id='".$id."'><a href='#' style='display: block; background: #efefef; color: #333; border-bottom: 1px solid #ccc; padding: 10px 0px;' onClick=\"func_call('".$id."'); return false\" >ORD_$oid</a>";
					
					$info .= "<tr>
								<td>ORD_$oid</td>
								<td>".$row['customer_name']."</td>
								<td>".$row['address']."</td>
								<td>".$row['email']."</td>
								<td>".$row['contact_number']."</td>
							</tr>";
					
					$get_data = $db->query("SELECT * FROM items WHERE order_id='".$oid."'");
					
					while($data = $get_data->fetch_assoc()) {
						
						$items .= "<tr>
										<td>".$data['food']."</td>
										<td>".$data['qty']."</td>
										<td></td>
									</tr>";
						
					}
					
					$items .= "<tr>
									<th>Total Price</th>
									<th>$".$row['total']."</th>
									<th></th>
								</tr>
								";
					
		
						
						$items .= "<tr>
									<th>Status</th>
									<th>".$row['status']."</th>
									<th></th>
								</tr>";
					
					
					
				}else{
					
					$result .=  "<input type='hidden' value='".$id."' 	id='".$id."'><a href='#' style='display: block; background: #efefef; color: #333; border-bottom: 1px solid #ccc; padding: 10px 0px;' onClick=\"func_call('".$id."'); return false\" >ORD_$oid</a>";
					
				}
																
									
				$x++;
			}
			
			$info .= "</tbody>
						</table>";
						
			$items .= "</tbody>
						</table>";
			
		}else{
			
			$result = "No Orders available yet";
			
			$info = "";
						
			$items = "";
			
		}
	
	
?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
<link rel="icon" type="image/png" href="image/favicon.ico">
	
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
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="text-align: center">Order List</h4>
                            </div>
                            
							<div class="row">
								
								<div class="col-md-12" >
									
									<br/>	
									
									<div class="col-md-3" style="text-align: center; background: #e91e63; color: #fff; border-right: 1px solid #fff;">
									
										<h5>ORDER ID</h5>
										
									</div>
									
									<div class="col-md-9" style="background: #e91e63; color: #fff;">
									
										<h5>ORDER DETAILS</h5>
										
									</div>
									
								</div>
								
								<div class="col-md-3" style="text-align: center;">
									
									<?php echo $result; ?>
									
								</div>
								
								<div id="details_display" class="col-md-8 table-responsive" style="padding: 10px;">
									
									<?php echo $info; ?>
									
									<?php echo $items; ?>
									
								</div>
								
							</div>
							
							<div class="content table-responsive table-full-width">
                                
								<p style="padding: 0px 20px;"><?php if($pages >= 1 && $page <= $pages) {
									for($i = 1; $i <= $pages; $i++) {
										echo ($i == $page) ? "<a href='orders.php?page=".$i."' style='margin-left:5px; font-weight: bold; text-decoration: none; color: #e91e63;' >$i</a>  "  : " <a href='orders.php?page=".$i."' class='btn'>$i</a> ";
									}
								} ?></p>

                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>

      
</body>
</html>