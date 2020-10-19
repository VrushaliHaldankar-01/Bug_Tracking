<?php
  include_once 'includes\db.php';
  session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Track issues</title>

            <!-- CSS STYLESHEETS -->
            <link rel="stylesheet" href="styles\my-issues.css">

            <!-- STARTER TEMPLATES -->
            <?php
            include_once 'starterTemplates\starters.php';
            ?>
        </head>
        
        <body>
            <?php
            include 'navbar/nav.php'
            ?>
  
            <form action="tester-dashboard.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>

            <div class="container">
                <br>
                <h4 class="header">Issues reported by you:</h4>
                <?php
                    $name =  $_SESSION['uname'];
                    $uid = $_SESSION['uid'];
                    
                    //GET ALL ISSUES ASSIGNED BY ACTIVE USER
                    $sql1 = "SELECT * FROM issues WHERE CreatedbyUser=$uid;";
                    $result1 = mysqli_query($con,$sql1);
                    $total = mysqli_num_rows($result1);
                    if($total == 0)
                    {   
                        echo '<div style="text-align:center; background-color:rgb(247, 245, 245); padding:10px;">';
                        echo '<h5>No issues assigned by you!</h5>';
                        echo '</div>';
                    }
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                        $i_id = $row1['IssueId'];
                        $i_title = $row1['Title'];
                        $i_type = $row1['DefectType'];
                        $i_priority = $row1['Priority'];
                        $i_status = $row1['Status'];
                        echo '<div class="issue-box">';
                            echo '<h5 class="subheader"><i class="fas fa-bug"></i> ' .$i_title .'</h5>';

                                if($i_type == "B")
                                {
                                    echo  '<h6 class="type">Defect type: Bug </h6>'; 
                                }else{
                                    echo  '<h6 class="type">Defect type: Task</h6>'; 
                                }

                                if($i_priority == "H")
                                {
                                    echo  '<h6 class="prio">Defect type: High </h6>'; 
                                }
                                else
                                {
                                    if($i_priority == "M")
                                    {
                                        echo  '<h6 class="prio">Defect type: Medium </h6>'; 
                                    }
                                    else
                                    {
                                        echo  '<h6 class="prio">Defect type: Low </h6>'; 
                                    }
                                }

                                echo '<form action="show-i-details.php" method="POST">';
                                echo '<button class="btn" type="submit" name="my-issue-id" value="' .$i_id .'"><h6 class="seemore">See more details</h6></button>';
                                echo '</form>';
                        echo '</div>';
                    }
                ?>
            </div>
        </body>
    </html>