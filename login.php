<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Bug Tracking software</title>
            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\login.css">

            <!-- STARTER TEMPLATES -->
            <?php 
                include 'starterTemplates\starters.php';
            ?>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col"></div>

                    <div class="col-sm-12 col-lg-6 btn-box">
                        <h2>Bug tracker</h2>
                        <!-- BUTTON TRIGGER MODAL -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">
                            Log in
                        </button>

                        <!-- LOGIN MODAL -->
                        <div class="modal" id="login-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <h3 class="modal-header">Login</h3>
                                        <div class="modal-body">
                                            <form action="backendfiles\loginVerify.php" method="POST">
                                                <div class="form-group">
                                                    <i class="far fa-user"> </i> 
                                                    <label for="login_email"> Email</label>
                                                    <input type="email" name="login_email" class="form-control"/> <br>

                                                    <i class="fas fa-lock"> </i> 
                                                    <label for="login_pwd"> Password  </label>
                                                    <input type="password" name="login_pwd" class="form-control"/><br><br>
                                                    
                                                    <button type="submit" name="submit_login" class="btn btn-secondary form-control">Log in</button>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($_GET['login']))
                            {
                                $errmsg = $_GET['login'];
                                echo '<br>';
                                if($errmsg == "incorrectpwd")
                                {
                                    echo '<br><h5 class="err">Please enter correct password</h5>';
                                }
                                if($errmsg == "deactivated")
                                {
                                    echo '<br><h5 class="err">This account has been deactivated by the Admin</h5>';
                                }
                                if($errmsg == "nouserfound")
                                {
                                    echo '<br><h5 class="err">No such user found</h5>';
                                }
                                if($errmsg == "empty")
                                {
                                    echo '<br><h5 class="err">Please fill all the details</h5>';
                                }
                                
                            }
                        ?>
                    </div>
                </div>
            </div>
    </body>
</html>