

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Sweet-O-Clock</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="#000" data-image="assets/img/sidebar-5.jpg">

            <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


            <?php require "includes/side_wrapper.php";
            require "includes/db.php";
            require "includes/functions.php";
            $limit = $db->query("SELECT * FROM limi");
            $limit = $limit->fetch_assoc();
            $limit = $limit['lim']; ?>

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
                            <a class="navbar-brand" href="#" style="color: #fff;">Manage Table Limit</a>
                        </div>
                        <div class="collapse navbar-collapse">

                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="logout.php" style="color: #fff;">
                                        Log out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Table limit</h4>
                                    </div>
                                   
                                    <div class="content">
                                        <form method="post" action="set_limit.php" enctype="multipart/form-data">
                                           

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label style="color: #333">Set Tables Limit</label>
                                                        <input type="number" autofocus name="limit" id="limit" class="form-control" value="<?php echo $limit ?>" required />
                                                    </div>
                                                </div>
                            
                                            </div>
                                            <div id="errorlog" style="visibility:hidden"></div>  
                                        </div>

                                           

                                            <input type="submit" name="submit" style="background: #e91e63; border: 1px solid #e91e63" value="Update" class="btn btn-info btn-fill pull-right" />
                                            <div class="clearfix"></div>
                                              
                                        </form>
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

            </div>
        </div>


</body>
<?php
                                            if (isset($_GET['res'])) {
                                                $errString;
       
                                                if($_GET['res'] == 1){
                                                    $errString = 'Limit set successfully';
                                                }
                                               
                                                echo "<script>
                                                $(function() {
                                                    $('#errorlog').text('" . $errString . "').css('background-color','#e91e63').css('visibility','visible');
                                                    $('#errorlog').delay(2000);
                                                });
                                             </script>";

                                            } 
                                            ?>
<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>