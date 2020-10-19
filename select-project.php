<?php
    include_once 'includes\db.php';
    session_start();
?>


<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Select project</title>

            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\select-project.css">

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

            <!-- BACK BUTTON -->
            <form  action ="tester-dashboard.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>


            <form action="create-issue.php" method="GET">
                <div class="container">
                    <h4 class="header" for="select-project">SELECT PROJECT</h4>
                    <br><br>
                    <h2><select name="select-project" id="select-project"    style=" font-size: x-large;">
                        <?php
                            $sql = "SELECT * FROM projects;";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo '<option value="' .$row['ProjectName'] .'"><h6>' .$row['ProjectName']  .'</h6></option>';
                            }
                        ?>
                    </select></h2>
                    
                    <button class="btn btn-danger">Add project</button>
                </div>
            </form>
        </body>
    </html>