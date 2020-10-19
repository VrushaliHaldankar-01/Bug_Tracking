<?php
    include_once 'includes\db.php';
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>

            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\reviewProject.css">

            <!-- STARTER FILES -->
            <?php
                include 'starterTemplates\starters.php';
            ?>
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

            <div class="container">
            <br>

            <?php
                $projectid =$_SESSION['pid'];
                echo '<h4 class="header"> Project added successfully</h4>';

                //GET ALL PROJECT DETAILS
                $sql = "SELECT * FROM projects WHERE ProjectId = $projectid";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $pname = $row['ProjectName'];
                    $pdesc = $row['Description'];
                    $platform = $row['Platform'];
                    if($platform == "D")
                    {
                        $platform = "Desktop";
                    }

                    echo '<div class="row">';
                        echo '<div class="col-sm-12 col-lg-6">';
                            echo '<br><h5 class="subheader">' .$pname .'</h5>';
                            echo '<br><br>';
                            echo '<h5 class="subheader">' .$pdesc .'</h5>';           
                        echo '</div>';

                        echo '<div class="col-sm-12 col-lg-6"><br>';
                        echo '<h5 class="subheader">Platform: ' .$platform .'</h5><br><br>';
                }

                $sql2 = "SELECT * FROM project_user WHERE projectid=$projectid;";
                $result2 = mysqli_query($con,$sql2);
                echo '<h5 class="subheader">Team: <h4>';
                while($row2 = mysqli_fetch_assoc($result2))
                {
                    $uid = $row2['userid'];
                    $sql3 = "SELECT * FROM users WHERE UserId=$uid;";
                    $result3 = mysqli_query($con,$sql3);
                    while($row3 = mysqli_fetch_assoc($result3))
                    {
                        $name = $row3['FullName'];
                        echo '<h5 class="subheader">' .$name .'<h4>';
                    }      
                }
                   echo '</div>';
                echo '</div>';
            ?>
        </div>
    </body>
</html>