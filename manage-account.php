<?php
    include_once 'includes\db.php';
    include 'starterTemplates\starters.php';
    session_start();
?>
<html lang="en">
    <head>
        <!-- CSS LINK -->
        <link rel="stylesheet" href="styles\manage-account.css">

        <!-- STARTER FILES -->
        <?php
            include 'starterTemplates\starters.php';
        ?>
    </head>


    <body>
    <!-- NAVIGATION BAR -->
    <?php
        include 'navbar/nav.php'
    ?>

        <?php
            
            $utype = $_SESSION['utype'];
            if($utype == 'T')
            {
                echo '<form action="tester-dashboard.php" method="POST">
                        <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </button>       
                    </form>';
            }

            if($utype == 'A')
            {
                echo '<form action="admin-dashboard.php" method="POST">
                        <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </button>       
                    </form>';
            }

            if($utype == 'D')
            {
                echo '<form action="developer-dashboard.php" method="POST">
                        <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </button>       
                    </form>';
            }

            ?>


   <form action="backendfiles\change-password.php" method="POST">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                <br><br>		
				    <img src="circle-clipart-peach.png" height="200px" width="200px" class="img-circle" alt="Cinque Terre" ></br></br>
						<h4 class="subheader"> Change Profile </h4>
				</div>
						
			    <div class="col-sm-12 col-lg-6">
				    <?php			
				        $uid=  $_SESSION['uid'];	 
						$uname=  $_SESSION['uname'];
						$q1="select * from users where UserId='$uid'";
	                    $result=mysqli_query($con,$q1);
						while($row = mysqli_fetch_assoc($result))
                        {
							$username = $row['FullName'];
                            echo '<br><br><h4> '.$username .'</h4>';
					        $row1= $row['UserType'];
		    				if($row1 == "A")
                            {
                                echo '<label style="margin-top: 5px;"><span></span></> ADMIN</label>';
                            }
                            else
                            {
                                if($row1 == "T")
                                {
                                    echo '<label style="margin-top: 10px;"><span></span></> TESTER</label><br>';
                                }
                                else
                                {
                                    echo '<label style="margin-top: 10px;"><span></span></br>DEVLOPER</label><br>';
                                }
                            }

							 
							 
							 echo '<h5 class="subheader">Change Password</h5>';
							 
                             echo '<input type="password" name="old_password" placeholder="Old Password"><br>';
							 echo '<input type="password" name="new_password" placeholder="New Password"><br>';
							 }
							?> 
							</br>
							<button class="btn btn-danger" type="submit" name="change-password">Change password</button><br><br>
                            <?php
                                if(isset($_GET['err']))
                                {
                                    $errmsg = $_GET['err'];
                                    if($errmsg == "changed")
                                    {
                                        echo '<h6 style="color: green;">Password changed <i class="fas fa-check" style="color:green;"></i></h6>';
                                    }

                                    if($errmsg == "empty")
                                    {
                                        echo '<h6 style="color: red;">Please fill both fields</h6>';
                                    }

                                    if($errmsg == "incorrpwd")
                                    {
                                        echo '<h6 style="color: red;">Please enter correct password</h6>';
                                    }
                                }
                            
                            ?>

                            </div>
							</form>

                           
							
</body>
</html>
