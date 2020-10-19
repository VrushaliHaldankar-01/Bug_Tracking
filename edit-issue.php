<?php
    include_once 'includes\db.php';
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit issue</title>
        
            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\create-issue.css">

            <!-- STARTER FILES -->
            <?php
                include 'starterTemplates\starters.php';
            ?>
        </head>

        <body>
            <?php
                include 'navbar/nav.php'
            ?>
            <!-- BACK BUTTON -->
            <form action="tester-dashboard.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                <i class="fas fa-arrow-left" aria-hidden="true"></i></button>       
            </form>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <form action="backendfiles/update-issue.php" method="POST" enctype="multipart/form-data">
                            <?php    
                                $iid =  $_SESSION['iid'] ; //SESSION WAS SET IN show-i-details PAGE
                                $sql="SELECT * FROM issues WHERE IssueId=$iid;";
                                $result = mysqli_query($con,$sql);
                                $row = mysqli_fetch_assoc($result);

                                $title = $row['Title'];
                                $desc = $row['Description'];
                                $steps = $row['Steps'];
                                $pid = $row['ProjectId'];
                                $version = $row['Version'];
                            ?>

                            <!-- CHANGE STATUS -->
                            <?php
                                //ACTIVE USER ID
                                $uid = $_SESSION['uid']; 
                                $sql4 = "SELECT * FROM users WHERE UserId = $uid;";
                                $result4 = mysqli_query($con,$sql4);
                                $row4 = mysqli_fetch_assoc($result4);
                                $utype = $row4['UserType'];
                            
                                //ADMIN CANNOT CHANGE DEFECT STATUS
                                if($utype != "A") 
                                {
                                    echo '<label> Change status:</label><br>';
                                    echo '<select name="stat" style="padding:5px;" class="selectpicker">';
                                    if($utype == "T")
                                    {
                                        echo '<option><b> Reopen </b></option>';
                                        echo '<option><b> Close </b></option>';
                                    }
                                    else
                                    {
                                        if($utype == "D")
                                        {
                                            echo '<option> Fixed </option>';
                                            echo '<option> Reject </option>';
                                            echo '<option> Defer </option>';
                                        }
                                    }
                                    echo '</select>';
                                }
                            ?>

                            <!-- DEFECT DESCRIPTION -->
                            <br><br>
                            <label for="defect-description"><span>*</span>Defect description:</label>
                            <br>
                            <?php 
                                echo '<textarea name="defect-description"cols="60" rows="15" required>' .$desc .'</textarea>';
                            ?>
                            <br><br>

                            <!-- STEPS TO REPRODUCE -->
                            <label for="steps-to-reproduce"><span>*</span>Steps to reproduce:</label>
                            <br>
                            <?php
                                echo '<textarea name="steps-to-reproduce" cols="60" rows="15" required>' .$steps .'</textarea>';
                            ?>
                            <br><br><br>

                            <!-- ADD ISSUE BUTTON -->
                            <button class="btn btn-lg btn-danger" name="add-issue">Save changes</button>
                            <br><br><br><br>
                    </div>


                    <div class="col-sm-12 col-lg-6">
                        <!-- DEFECT TYPE -->
                        <label for="defect-type"><span>*</span>Defect type:</label>
                        <div class="box">
                            <select name="defect-type">
                                <option value="Bug">Bug</option>
                                <option value="Task">Task</option>
                            </select>
                        </div>
                        <br><br>

                        <!-- DEFECT PRIORITY -->
                        <label for="defect-priority" style="margin-top:50px;"><span>*</span>Select priority:</label>
                            <div class="box">
                                <select name="defect-priority">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        <br><br>

                        <!-- DEFECT TITLE -->
                        <label for="defect-title" style="margin-top:50px;"><span>*</span>Title:</label>
                        <br>
                        <?php
                            echo '<input class="input-style" type="text" name="defect-title" required value="' .$title .'">';
                        ?>
                        <br><br>

                        <!-- DEFECT VERSION -->
                        <label for="defect-version"><span>*</span>Version:</label>
                        <br>
                        <?php
                        echo '<input class="input-style" type="text" name="defect-version" required value="' .$version   .'">;'
                        ?>
                        <br><br>

                        <!-- ASSIGN DEFECT TO -->
                        <label for="assign-defect"><span>*</span>Assign to:</label><br>
                        <select name="assign-defect" class="select-dev">
                            <?php         
                                //GET TEAM MEMBERS
                                $sql = "SELECT * FROM project_user WHERE projectid = $pid;";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    //GET USERNAME
                                    $userid = $row['userid'];
                                    $sql2 = "SELECT * FROM users WHERE UserId = $userid;";
                                    $result2 = mysqli_query($con,$sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $userFullName = $row2['FullName'];
                                    
                                    echo '<option>' .$userFullName .'</option>';
                                }
                            ?>
                        </select>

                        <!-- DEFECT ATTACHMENTS -->
                        <br><br>
                        <label for="attachments">Attachments(if any):</label>
                        <br>
                        <input style="margin-left: 0px;" class="input-file" type="file" name="attachments[]" multiple>
                        <br><br>
                    </div>    
                </form>
            </div>
        </div>
    </body>
</html>