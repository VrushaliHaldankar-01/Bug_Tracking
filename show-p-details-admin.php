<?php
    include_once 'includes\db.php';
    session_start();
    $uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Project Details</title>

            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\p-details.css">

            <!-- STARTER TEMPLATES -->
            <?php
                include_once 'starterTemplates\starters.php';
            ?>

            <!-- FONTAWESOME ICON -->
            <script src="https://kit.fontawesome.com/aad2bd4516.js" crossorigin="anonymous"></script>
        </head>
        
        <body>
            <?php
                include 'navbar/nav.php'
            ?>

            <!-- Back Button -->
            <form action="admin-dashboard.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>

            <div class="container projectDetails">
                <div class="row">
                    <?php        
                        if(isset($_POST['projectid']))
                        {
                            //COLUMN 1
                            echo '<div class="col-sm-12 col-lg-6">';
                                //GET CLICKED PROJECT ID
                                $pid = $_POST['projectid'];
                                $_SESSION['pid'] = $pid;
                                $pid =  $_SESSION['pid'];

                                //PROJECT DETAILS
                                $sql1 = "SELECT * FROM projects WHERE ProjectId=$pid";
                                $result1 = mysqli_query($con,$sql1);
                                $row1 = mysqli_fetch_assoc($result1);

                                //PROJECT NAME
                                $pname = $row1['ProjectName'];
                                $_SESSION['current-project-name'] = $pname;
                                $pname = $_SESSION['current-project-name'];
                                echo '<h2 class="projectName">' .$pname .'</h2>';

                                //REMEMBER PROJECT ID
                                $_SESSION['current-project-id'] = $pid;

                                //PROJECT DESCRIPTION
                                $p_desc = $row1['Description'];
                                $_SESSION['current-project-desc'] = $p_desc;


                                echo '<div class="desc">';
                                    echo '<p class="labels">Description: </p>';
                                    echo '<p>' .$p_desc .'</p>';
                                echo '</div>';
                            echo '</div>';


                            //COLUMN 2
                            echo '<div class="col-sm-12 col-lg-6">';
                                $platform = $row1['Platform'];
                                $_SESSION['current-project-platform'] = $platform;
                                $datetime = $row1['CreateDateTime'];

                                echo '<div class="otherInfo">';
                                    if($platform == "w")
                                    {
                                        echo '<p class="labels" style="margin-top: 60px;">Platform: WEB</p>';
                                    }
                                    else
                                    {
                                        if($platform == "m")
                                        {
                                            echo '<p class="labels" style="margin-top: 60px;">Platform: MOBILE</p>';
                                        }
                                        else
                                        {
                                            echo '<p class="labels" style="margin-top: 60px;">Platform: BACKEND</p>';
                                        }
                                    }
                                
                                    echo '<p class="labels" style="margin-top: 30px;">Created on: ' .$datetime .'</p>';

                                    echo '<p class="labels" style="margin-top: 30px;">Team members:</p><br>';

                                    //GET TEAM MEMBER'S ID
                                    $sql2 = "SELECT * FROM project_user WHERE projectid=$pid;";
                                    $result2 = mysqli_query($con,$sql2);
                                    while($row2 = mysqli_fetch_assoc($result2))
                                    {
                                        $uid = $row2 ['userid'];
                                        //GET TEAM MEMBERS USERNAME
                                        $sql3 = "SELECT * FROM users WHERE UserId=$uid;";
                                        $result3 = mysqli_query($con,$sql3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $username = $row3['FullName'];
                                        echo '<h5>' .$username .'</h5><br>';
                                    }
                                        echo '<br>';
                                echo '</div>';
                            echo '</div>';
                        }
                        else
                        {
                            echo '<div class="col-sm-12 col-lg-6">';
                                $pid =  $_SESSION['pid'];

                                //PROJECT DETAILS
                                $sql1 = "SELECT * FROM projects WHERE ProjectId=$pid";
                                $result1 = mysqli_query($con,$sql1);
                                $row1 = mysqli_fetch_assoc($result1);

                                //PROJECT NAME
                                $pname = $row1['ProjectName'];
                                $_SESSION['current-project-name'] = $pname;
                                $pname = $_SESSION['current-project-name'];
                                echo '<h2 class="projectName">' .$pname .'</h2>';

                                //REMEMBER PROJECT ID
                                $_SESSION['current-project-id'] = $pid;

                                //PROJECT DESCRIPTION
                                $p_desc = $row1['Description'];
                                $_SESSION['current-project-desc'] = $p_desc;

                                echo '<div class="desc">';
                                    echo '<p class="labels">Description: </p>';
                                    echo '<p>' .$p_desc .'</p>';
                                echo '</div>';
                            echo '</div>';

                            //COLUMN 2
                            echo '<div class="col-sm-12 col-lg-6">';
                                $platform = $row1['Platform'];
                                $_SESSION['current-project-platform'] = $platform;
                                $datetime = $row1['CreateDateTime'];

                                echo '<div class="otherInfo">';
                                    if($platform == "w")
                                    {
                                        echo '<p class="labels" style="margin-top: 60px;">Platform: WEB</p>';
                                    }
                                    else
                                    {
                                        if($platform == "m")
                                        {
                                            echo '<p class="labels" style="margin-top: 60px;">Platform: MOBILE</p>';
                                        }
                                        else
                                        {
                                            echo '<p class="labels" style="margin-top: 60px;">Platform: BACKEND</p>';
                                        }
                                    }
                                
                                    echo '<p class="labels" style="margin-top: 30px;">Created on: ' .$datetime .'</p>';
                                    echo '<p class="labels" style="margin-top: 30px;">Team members:</p><br>';

                                    //GET TEAM MEMBERS ID
                                    $sql2 = "SELECT * FROM project_user WHERE projectid=$pid;";
                                    $result2 = mysqli_query($con,$sql2);
                                    while($row2 = mysqli_fetch_assoc($result2))
                                    {
                                        $uid = $row2 ['userid'];
                                        //GET TEAM MEMBERS USERNAME
                                        $sql3 = "SELECT * FROM users WHERE UserId=$uid;";
                                        $result3 = mysqli_query($con,$sql3);
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $username = $row3['FullName'];
                                        echo '<h5>' .$username .'</h5><br>';
                                    }
                                        echo '<br>';
                                echo '</div>';
                            echo '</div>';
                        }
                    ?> 
                </div>

                <form action="see-issues-admin.php" method="POST">
                <button type="submit" class="btn btn-danger" name="see-issues">See All issues</button>
                </form>
                <br><br><hr>
            </div>
        </body>
    </html>