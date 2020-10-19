<?php
    include_once 'includes\db.php';
    session_start();
    $uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
    <html lang="">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>All issues</title>

            <!-- CSS STYLESHEETS -->
            <link rel="stylesheet" href="styles\see-issues.css">
            
            <!-- STARTER FILES -->
            <?php
                include 'starterTemplates\starters.php';
            ?>

            <!-- FONTAWESOME ICON -->
            <script src="https://kit.fontawesome.com/aad2bd4516.js" crossorigin="anonymous"></script>
        </head>

        <body>
        <!-- NAVIGATION BAR -->
            <?php
            include 'navbar/nav.php'
            ?>

        <!-- BACK BUTTON -->
            <form action="show-p-details-admin.php" method="POST">
                <button type="submit" name="back" class="btn  btn-danger" style="margin-left: 30px; margin-top: 20px;">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>

            <div class="container">
            <br>
            <h3 class="header">All issues:</h3>
            
            <?php
            $pname = $_SESSION['current-project-name'];
            $pid = $_SESSION['current-project-id'];
            echo '<h5>For: ' .$pname .'</h5>';
            
            //GET ALL ISSUES LINKED TO PROJECT ID

            $sql1 = "SELECT * FROM issues WHERE ProjectId = $pid;";
            $result1 = mysqli_query($con,$sql1);
            if($total = mysqli_num_rows($result1) == 0)
            {   
                echo '<br><h6 class="subheader"> No issues for this project </h6>';
            }
            while($row1 = mysqli_fetch_assoc($result1))
            {
                echo '<div class="issue-box">';
                    $i_label = $row1['Title'];
                    echo '<h5 class="subheader"><i class="fas fa-bug"></i> ' .$i_label .'</h5><br>';

                    //GET ISSUEID
                    $i_id = $row1['IssueId'];
                    
                    //GET USERID
                    $reported_by_uid = $row1['CreatedByUser'];
                
                    //GET USERNAME
                    $sql2 = "SELECT * FROM users where UserId =$reported_by_uid;";
                    $result2 = mysqli_query($con,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $reported_by_uname = $row2['FullName'];

                    echo '<div class="reporter">';
                    echo '<h5>Reported by: ' .$reported_by_uname .'</h5>';
                    echo '</div><br>';

                    //GET PRIORITY
                    echo '<div class="prio">';
                    $priority =  $row1['Priority'];
                    if($priority == "H")
                    {
                        $priority = "HIGH";
                        echo '<br><h5>Defect priority: ' .$priority .'</h5>';
                    }
                    else
                    {
                        if($priority == "M")
                        {
                            $priority = "MEDIUM";
                            echo '<br><h5>Defect priority: ' .$priority .'</h5>';
                        }
                        else
                        {
                            $priority = "LOW";
                            echo '<br><h5>Defect priority: ' .$priority .'</h5>';
                        }
                    }
                echo '</div>';

                // ISSUE TYPE
                echo '<div class="type">';
                    $type =  $row1['DefectType'];
                    if($priority == "B")
                    {
                        $type = "BUG";
                    }else{
                        $type = "TASK";
                    }
                    echo '<br><h5>Defect type: ' .$type .'</h5>';
                echo '</div>';

                //SEE MORE DETAILS BUTTON
                echo '<form action="show-i-details-admin.php" method="POST">';
                echo '<button type="submit" class="btn" name="issue-id" value="' .$i_id .'">See more details</button><br>';
                echo '</form>';

            echo '</div>';
            }
        ?>
    </div>
</body>
</html>
