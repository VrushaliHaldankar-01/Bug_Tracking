<?php
    include_once 'includes\db.php';
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create project</title>

            <!-- CSS FILE -->
            <link rel="stylesheet" href="styles\createproject.css">

            <!-- STARTER FILES -->
            <?php
                include 'starterTemplates\starters.php';
            ?>

            <!-- BOOTSTRAP SELECT PLUGIN -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        
        </head>

        <body>
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
            ?>
           
            <?php
                //CHECK FOR ERRORS
               if(isset($_GET['err']))
                {
                    echo '<div class="errbox">';
                    $errmsg = $_GET['err'];
                    if($errmsg === "empty")
                    {
                        echo '<h3>Please fill all the fields!</h3>';
                    }
                        
                    if($errmsg === "plt")
                    {
                        echo '<h3>Please select platform for this project!</h3>';
                    }
                        
                    if($errmsg === "usrs")
                    {
                        echo '<h3>Please select team members!</h3>';
                    }
                        echo '</div>';
                }
            ?>

            <form action="backendfiles\store-project.php" method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                            if(isset($_POST['edit-project']))
                            {
                                $pid =  $_SESSION['current-project-id'];
                                $pname = $_SESSION['current-project-name'];
                                $p_desc =  $_SESSION['current-project-desc'];
                                $p_platform =$_SESSION['current-project-platform'];

                                //COLUMN 1
                                echo '<div class="col-sm-12 col-lg-6">';   
                                    //PROJECT NAME
                                    echo ' <!-- Project name -->
                                    <label for="project-name"><span class="reqd">*</span> Project name:</label><br>';
                                    echo '<input type="text" name="project-name" class="p-name" value="' .$pname .'"><br><br>';

                                    //PROJECT DESCRIPTION
                                    echo '<label for="project-desc"><span class="reqd">*</span> Project description:</label><br>';
                                    echo '<textarea name="project-desc" class="p-desc">' .$p_desc .'</textarea><br><br>';

                                    //UPDATE PROJECT BUTTON
                                    echo '<button class="btn btn-danger" type="submit" name="update-project">Save changes</button><br><br>'; 
                                echo ' </div>';


                                //COLUMN 2
                                echo '<div class="col-sm-12 col-lg-6">';
                                    //PROJECT STATUS
                                    echo '<label>Project status:</label><br>';
                                    echo ' <div class="status">PENDING</div>
                                    <br><br><br><br> ';
 
                                    //TEAM MEMBERS
                                    echo '<label><span class="reqd">*</span>Team members:</label><br>';

                                    $sql1 = "SELECT * FROM project_user WHERE projectid=$pid;";
                                    $result1 = mysqli_query($con,$sql1);
                                    while($row1 = mysqli_fetch_assoc($result1))
                                    {
                                        $uid = $row1['userid'];
                                        //GET USERNAME
                                        $sql2 = "SELECT * FROM users WHERE UserId=$uid;";
                                        $result2 = mysqli_query($con,$sql2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $username = $row2['FullName'];
                                        echo '<h5>' .$username .'</h5><br>';
                                    }
                                    echo '<br>';

                                    echo '<select name="update-users[]" id="update-users" class="selectpicker" data-live-search="true" multiple>';
                                        $sql4 = "SELECT * FROM users WHERE UserType='D';";
                                        $result = mysqli_query($con,$sql4);
                                        while($row = mysqli_fetch_assoc($result))
                                        {
                                            $username = $row['FullName'];
                                            echo '<option value="' .$username .'">' .$username .'</option> ';
                                        }
                                    echo '</select><br>';
                            
                                    //PROJECT PLATFORM
                                    if($p_platform == "w")
                                    {
                                        echo '<label style="margin-top: 60px;"><span class="reqd">*</span>Platform: WEB</label><br>';
                                    }
                                    else
                                    {
                                        if($p_platform == "m")
                                        {
                                            echo '<label style="margin-top: 60px;"><span class="reqd">*</span>Platform: MOBILE</label><br>';
                                        }
                                        else
                                        {
                                            echo '<label style="margin-top: 60px;"><span class="reqd">*</span>Platform: BACKEND</label><br>';
                                        }
                                    }

                                    //PROJECT PLATFORM
                                    echo '<input type="radio" class="plt" name="platform" value="Mobile">
                                        <label for="Mobile">Mobile</label><br><br>
                                        <input type="radio" class="plt" name="platform" value="Web">
                                        <label for="Web">Web</label><br><br>
                                        <input type="radio" class="plt" name="platform" value="Desktop">
                                        <label for="Desktop">Desktop</label><br><br>
                                        <input type="radio" class="plt" name="platform" value="Backend">
                                        <label for="Backend">Backend</label><br><br> ';
                                    echo '</div>';
                            }
                            else
                            {
                                //COLUMN 1
                                echo '<div class="col-sm-12 col-lg-6">';
                                    //PROJECT NAME
                                    echo ' <!-- Project name -->
                                    <label for="project-name"><span class="reqd">*</span> Project name:</label><br>';
                                    echo ' <input type="text" name="project-name" class="p-name">
                                    <br><br> ';

                                    //PROJECT DESCRIPTION
                                    echo '<label for="project-desc"><span class="reqd">*</span> Project description:</label><br>';
                                    echo '<textarea name="project-desc" class="p-desc"></textarea><br><br>';

                                    //ADD PROJECT BUTTON
                                    echo '<button class="btn btn-danger" type="submit" name="add-project">Add project</button><br><br>';
                                echo ' </div>';


                                //COLUMN 2
                                echo '<div class="col-sm-12 col-lg-6">';
                                    //PROJECT STATUS
                                    echo '<label>Project status:</label><br>';
                                    echo ' <div class="status">PENDING</div>
                                    <br><br><br><br> ';

                                    //ASSIGN TEAM MEMBERS
                                    echo '<label for="select-users[]"><span class="reqd">*</span> Assign team members:</label><br>';
                                    echo '<select class="selectpicker" name="select-users[]" id="select-users" data-live-search="true" multiple>';

                                    $sql = "SELECT FullName FROM users WHERE UserType='D';";
                                    $result = mysqli_query($con,$sql);
                                    $total = mysqli_num_rows($result);
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo '<option value="' .$row['FullName']  .'">' .$row['FullName'] .'</option>';
                                    }
                                    echo '</select><br><br><br><br>';

                                    //PROJECT PLATFORM
                                    echo '<label for="project-platform"><span class="reqd">*</span> Project platform:</label><br>';
                                    echo '<input type="radio" name="platform" value="Mobile">
                                    <label for="Mobile">Mobile</label><br><br>
                                    <input type="radio" name="platform" value="Web">
                                    <label for="Web">Web</label><br><br>
                                    <input type="radio" name="platform" value="Desktop">
                                    <label for="Desktop">Desktop</label><br><br>
                                    <input type="radio" name="platform" value="Backend">
                                    <label for="Backend">Backend</label><br><br> ';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </form>
        </body>
    </html>