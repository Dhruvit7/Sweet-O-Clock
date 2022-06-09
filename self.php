<div class="container" style="padding-top:50px">
    <div class="row">
        <div
            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="profile_form" action="#" method="post">
                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Username</td>
                                        <td><input type="text" name="username" id="username"
                                                   value= <?php echo $data['username']; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>First Name</td>
                                        <td><input type="text" name="firstName" id="firstname"
                                                   value= <?php echo $data['first_name']; ?>></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td><input type="text" name="lastName" id="lastname"
                                                   value= <?php echo $data['last_name']; ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td><input type="text" name="dob" id="dob"
                                                   value= <?php echo $data['birthdate']; ?>>
                                        </td>
                                    </tr>

                                    <tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><input type="email" name="email" id="email"
                                                   value= <?php echo $data['email']; ?>>
                                        </td>
                                    </tbody>
                                </table>
                                   <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
  									<div class="btn-group" >
                                      <button id="submit" name="submit" class="btn btn-primary" required>Update My Info</button>
                                    </div>
                                    <?php
                                            if (isset($_GET['res'])) {
                                                $errString;
       
                                                if($_GET['res'] == 1){
                                                    $errString = 'Updated Successfully';
                                                }
                                                echo "<script>
                                                $(function() {
                                                    $('#errorlog').text('" . $errString . "').css('background-color','#e91e63').css('visibility','visible');
                                                    $('#errorlog').delay(2000);
                                                });
                                             </script>";

                                            } 
                                            ?>
                                        </div>
                                        <div id="errorlog" style="visibility:hidden"></div>
                                </div>
                                </a>
                            </div>
                        </form>
                        <!--                                Need to get this to work and only available when in edit mode-->
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

