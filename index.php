<?php 
	require_once("dbConnection.php");
    $msg = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="image/favicon.ico">

    <title>Sweet-O-Clock</title>
    <!-- <link rel="icon" type="image/x-icon" href="./img/favicon.ico"> -->

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/loginregister.css" rel="stylesheet">

    <script src="js/jquery.js"></script>

    <script src="js/loginregister.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        <a class="navbar-brand" href="#">Sweet-O'Clock</a>
                    </div>
            </nav>
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Register</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="login.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                   
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <a href="resetpwd.php" class="reset-pwd">Forget Password?</a>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="signup.php" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="firstname" id="firstname" tabindex="2" class="form-control" placeholder="First Name" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="lastname" id="lastname" tabindex="3" class="form-control" placeholder="Last Name" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" tabindex="4" class="form-control" placeholder="Email Address" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="dob" id="dob" tabindex="5" class="form-control" placeholder="Date of Birth" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="6" class="form-control" placeholder="Password" required>
                                    </div>
                                   
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="7" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="seq"> Choose Security Question(Keep It Safe and remember):</label>
                                        <select class="form-control" name="seq">
                                            <option selected="selected" value="0">What high school did you attend?</option>
                                            <option value="1">What was your favorite food as a child?</option>
                                            <option value="2">What is the name of your first school?</option>
                                            <option value="3">What is your favorite movie?</option>
                                            <option value="4">In what city or town did your parents meet?</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="sque" id="sque" tabindex="8" class="form-control" placeholder="Enter Your Answer" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" >
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="errorlog" style="visibility:hidden"></div>

    <?php
    if (isset($_GET['val'])) {
        $errString;
       
        if($_GET['val'] == 5){
            $errString = 'Username not entered';
        } else if($_GET['val'] == 6){
            $errString = 'Password not entered';
        } else if($_GET['val'] == 7){
            $errString = 'Username or password not correct!';
        } else if($_GET['val'] == 8){
            $errString = 'You have been blocked.';
        } elseif($_GET['val'] == 9){
            $errString = "Password reset successfully.";
        }
            echo "<script>
                        $(function() {
                            $('#errorlog').text('" . $errString . "').css('background-color','#e91e63').css('visibility','visible');
                            $('#errorlog').delay(2000);
                        });
                     </script>";
        }
    
        
        else if(isset($_GET['valr'])){
            $errString;
            if ($_GET['valr'] == 1) {
                $errString = 'Passwords do not match!';
            } else if ($_GET['valr'] == 2) {
                $errString = 'Missing inputs!';
            } else if($_GET['valr'] == 4){
                $errString = 'Username or email already exists!';
            }else if($_GET['valr'] == 3){
                $errString = 'Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.';
            }

            echo "<script>  
                        $(function() {
                            $('#errorlog').text('" . $errString . "').css('background-color','#e91e63').css('visibility','visible');
                            $('#errorlog').delay(2000);
                            $('#login-form').fadeOut(8);
                            $('#register-form').fadeIn(10);
                            $('#login-form-link').removeClass('active');
                            $('#register-form-link').addClass('active');
                        });
                     </script>";
        }

        else if(isset($_GET['valre'])){
         if($_GET['valre'] == "success") {
            $errString = 'Registration successfull';
            echo "<script>
            $(function() {
                $('#errorlog').text('" . $errString . "').css('background-color','#e91e63').css('visibility','visible');
                $('#errorlog').delay(2000);
            });
         </script>";
        }
        }




    ?>
</body>


</html>