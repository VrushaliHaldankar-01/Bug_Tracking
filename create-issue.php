<?php
    include_once 'includes\db.php';
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create Issue</title>

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
            <form action="select-project.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <form action="backendfiles/store-issue.php" method="POST" enctype="multipart/form-data">
                            <?php
                                //GET SELECTED PROJECT FROM select_project.php
                                if(isset($_GET['select-project']))
                                {
                                    $selected_project = $_GET['select-project'];
                                    echo '<label>Project:</label><br>';
                                    echo ' <input class="input-project" type="text" name="selected" readonly value ="' .$selected_project .'">';
                                }
                            ?>
                                
                            <!-- DEFECT DESCRIPTION -->
                            <br><br>
                            <label for="defect-description"><span>*</span>Defect description:</label>
                            <br>
                            <textarea name="defect-description"cols="60" rows="15" required></textarea>
                            <br><br>

                            <!-- STEPS TO REPRODUCE -->
                            <label for="steps-to-reproduce"><span>*</span>Steps to reproduce:</label>
                            <br>
                            <textarea name="steps-to-reproduce" cols="60" rows="15" required></textarea>
                            <br><br><br>

                            <!-- ADD ISSUE BUTTON-->
                            <button class="btn btn-danger" name="add-issue">Add issue</button>
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
                        <input class="input-style" type="text" name="defect-title" required>
                        <br><br>

                        <!-- DEFECT VERSION -->
                        <label for="defect-version"><span>*</span>Version:</label>
                        <br>
                        <input class="input-style" type="text" name="defect-version" required>
                        <br><br>

                        <!-- DEFECT ATTACHMENTS -->
                        <label for="attachments">Attachments(if any):</label>
                        <br>
                        <input class="input-file" type="file" name="attachments[]" multiple>
                        <br><br>

                        <!-- ASSIGN DEFECT TO -->
                        <label for="assign-defect"><span>*</span>Assign to:</label><br>
                        <select name="assign-defect" class="select-dev">
                            <?php
                                //GET SELECTED PROJECT NAME
                                $project = $_GET['select-project'];

                                //GET PROJECT ID
                                $sql1 = "SELECT * FROM projects WHERE ProjectName = '$project';";
                                $result1 = mysqli_query($con,$sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                                $project_id = $row1['ProjectId'];
                                        
                                //GO IN project_user TABLE GET ALL THE USER IDS LINKED TO THIS PROJECT
                                $sql2 = "SELECT * FROM project_user WHERE projectid = $project_id;";
                                $result2 = mysqli_query($con,$sql2);
                                while($row2 = mysqli_fetch_assoc($result2))
                                {
                                    //GET USERNAME FOR EACH USERID
                                    $uid = $row2['userid'];
                                    $sql3 = "SELECT * FROM users WHERE UserId = $uid;";
                                    $result3 = mysqli_query($con,$sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    $username = $row3['FullName'];
                                    echo '<option>' .$username  .'</option>';
                                }    
                            ?>    
                        </select>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>