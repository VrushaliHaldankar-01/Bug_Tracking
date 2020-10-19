<?php
    include_once 'includes\db.php';
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>show issue details</title>

            <!-- CSS STYLESHEET -->
            <link rel="stylesheet" href="styles\show-i-details.css">

            <!-- BOOTSTRAP CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

            <!--BOOTSTRA JS, POPPER.JS, AND JQUERY -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

            <!-- Favicon icons -->
            <script src="https://kit.fontawesome.com/aad2bd4516.js" crossorigin="anonymous"></script>

            <!-- JQUERY -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        </head>
        
        <body>
            <!-- NAVIGATION BAR -->
            <?php
                include 'navbar/nav.php'
            ?>
            <br>

            <!-- BACK BUTTON -->
            <form action="my-issues.php" method="POST">
                <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
                <i class="fas fa-arrow-left" aria-hidden="true"></i></button>       
            </form>
            <br>
            
            <div class="container">
                <form action="edit-issue.php" method="POST">
                    <button type="submit" name="edit-issue" class="btn btn-danger">Edit Issue</button>
                </form>

                <?php
                    //IF USER IS COMING FROM MY-ISSUES PAGE
                    if(isset($_POST['my-issue-id']))
                    {
                        $i_id = $_POST['my-issue-id'];
                        $uid = $_SESSION['uid'];

                        $sql = "SELECT * FROM issues WHERE IssueId = $i_id;";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $p_id = $row['ProjectId'];

                        $sql3 = "SELECT * FROM projects WHERE ProjectId = $p_id;";
                        $result3 = mysqli_query($con,$sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $p_name = $row3['ProjectName'];  
                    }
                    else 
                    {
                        //IF USER IS COMING FROM SHOW-P-DETAILS PAGE
                        //PROJECT ID
                        $p_id =$_SESSION['current-project-id'];

                        //PROJECT NAME
                        $p_name =  $_SESSION['current-project-name'];

                        //ISSUE ID
                        $i_id = $_POST['issue-id'];

                        //ACTIVE USER ID(T)
                        $uid = $_SESSION['uid'];
                    }

                    //REMEMBER ISSUE ID
                    $_SESSION['iid'] = $i_id;

                    echo '<div>';
                        echo '<br><h4 class="header">DEFECT FOR :' .strtoupper($p_name) .'</h4>';
                    echo '</div>';
                    echo '<br><h5 class="subheader">Defect Details:</h5><br><br>';

                    echo '<div class="row">';
                        echo '<div class="col-sm-12 col-lg-6">';
                            //FROM ISSUES TABLE GET ALL DEFECT DETAILS CORRESPONDING TO PROJECT ID
                            $sql1 = "SELECT * FROM issues WHERE IssueId=$i_id AND ProjectId=$p_id;";
                            $result1 = mysqli_query($con,$sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $defect_type = $row1['DefectType'];
                            $status = $row1['Status'];
                            $datetime = $row1['CreateDateTime'];
                            $priority = $row1['Priority'];
                            $version =$row1['Version'];
                            $reporter_id = $row1['CreatedByUser'];
                            $defect_title = $row1['Title'];
                            $defect_desc = $row1['Description'];
                            $defect_steps = $row1['Steps'];

                            //REPORTED USRNAME
                            $sql2 = "SELECT * FROM users WHERE UserId=$reporter_id;";
                            $result2 = mysqli_query($con,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $reporter_uname = $row2['FullName'];

                            if($defect_type =="B")
                            {
                                echo '<label> Defect type: </label>';
                                echo '<h4 class="type">Bug</h4>';
                            }
                            else{
                                echo '<label> Defect type: </label>';
                                echo '<h4 class="type">Task</h4>';
                            }

                            echo '<br><br><br><br>';
                            switch ($status)
                            {
                                case "N" : //NEW
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="purple status">';
                                    echo '<h6 class="st-msg">NEW </h6>';
                                    echo '</div>';
                                break;

                                case "R" : //REJECTED
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="red status">';
                                    echo '<h6 class="st-msg">REJECTED </h6>';
                                    echo '</div>';
                                break;

                                case "O" : //OPEN
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="pink status">';
                                    echo '<h6 class="st-msg">OPEN </h6>';
                                    echo '</div>';
                                break;

                                case "D" : //DEFFERED
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="orange status">';
                                    echo '<h6 class="st-msg">DEFERRED </h6>';
                                    echo '</div>';
                                break;

                                case "T" : //RETEST
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="brown status">';
                                    echo '<h6 class="st-msg">RETEST </h6>';
                                    echo '</div>';
                                break;

                                case "E" : //REOPEN
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="blue status">';
                                    echo '<h6 class="st-msg">Reopen </h6>';
                                    echo '</div>';
                                break;

                                case "C" : //CLOSED
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="green status">';
                                    echo '<h6 class="st-msg">CLOSED </h6>';
                                    echo '</div>';
                                break;

                                case "F" : //FIXED
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="grey status">';
                                    echo '<h6 class="st-msg">FIXED </h6>';
                                    echo '</div>';
                                break;
                            }

                            echo '<br><br><br><br>';
                            echo '<label> Created on:</label>';
                            echo '<h4 class="datetime">' .$datetime .'</h4>';
                        echo '</div>';


                        echo '<div class="col-sm-12 col-lg-6">';
                            echo '<label> Priority:</label>';
                            if($priority == "H"){
                                echo '<h4 class="priority">HIGH</h4>';
                            }else{
                                if($priority == "M")
                                {
                                    echo '<h4 class="priority">MEDIUM</h4>';
                                }else{
                                    echo '<h4 class="priority">LOW</h4>';
                                }
                            }
                            echo '<br><br><br><br>';

                            echo '<label> Reported by:</label>';
                            echo '<h4 class="reporter">' .$reporter_uname .'</h4>';
                            echo '<br><br><br><br>';

                            echo '<label> Version:</label>';
                            echo '<h4 class="version">' .$version .'</h4>';
                            echo '<br><br><br><br>';
                        echo '</div>';
                    echo '</row>';
                echo '</div><hr>';

                //DEFECT TITLE
                echo '<h5 class="subheader">Other Details:</h2><br><br>';
                echo '<label> Defect Title:</label>';
                echo '<h5 class="paras">' .$defect_title .'</h5>';

                //DEFECT DESCRIPTION
                echo '<br><br><br><br>';
                echo '<label> Defect Description:</label>';
                echo '<h5 class="paras">' .$defect_desc .'</h5>';

                //STEPS TO REPRODUCE
                echo '<br><br><br><br>';
                echo '<label> Steps to reproduce:</label>';
                echo '<h5 class="paras">' .$defect_steps .'</h5>';

                echo '<br><br><br><br><hr>';
                echo '<h5 class="subheader">Issue Attachments:</h2><br><br>';
            ?>    

            <div class="container">
                <?php
                    $sql = "SELECT * FROM issue_files WHERE IssueId=$i_id;";
                    $result = mysqli_query($con,$sql);
                    $total = mysqli_num_rows($result);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $allext = array('png', 'jpeg', 'jpg');
                            $filename = $row['FileName'];
                            $getext = explode('.',$filename); //ARRAY
                            $ext = end($getext);
                            //GET AUTHOR
                            $uid = $row['LinkedTo'];
                            //USERNAME
                            $sql2 = "SELECT * FROM users WHERE UserId=$uid;";
                            $result2 = mysqli_query($con,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $username = $row2['FullName']; 

                            if(in_array($ext,$allext))
                            {
                                echo '<div>';
                                echo '<a download><img src="issueFiles/' .$filename .'" alt="" height="200px" width="200px"></a><br>';
                                echo '<a href="issueFiles/' .$filename .'" download><h3>Download</h3></a>';
                                echo '<h5>Uploaded by: ' .$username .'</h5>';
                                echo '</div><br><br>';
                            }

                            $doc_ext = array('pdf','xlsx','mp4');
                            if(in_array($ext,$doc_ext))
                            {
                                echo '<div style="padding:10px; background-color: #f8f9fa;">';
                                echo '<a href="issueFiles/' .$filename .'" download><h3>' .$filename .'</h3></a>';
                                echo '<h5>Uploaded by: ' .$username .'</h5>';
                                echo '</div><br><br>';
                            }
                        }
                        if($total < 1)
                        {
                            echo '<label>No attachments for this project</label>';
                        }                            
                ?>          
                
                <br><br><br>
                <hr>

            <!-- DISCUSSIONS -->
            <h5 class="subheader">Discussions: </h2><br><br>
            <?php
                $i_id = $_SESSION['iid'];
                $uid = $_SESSION['uid'];
                    echo '<p name="issueid" class="issueid" value="' .$i_id .'"></p>';
                    echo '<p name="userid" class="userid" value="' .$uid .'"></p>';
            ?>

            <!-- BUTTON TRIGGER MODAL -->
            <button type="button" class="discuss btn btn-danger" data-toggle="modal" data-target="#exampleModal">
            View discussions
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Discussions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- All comments will come here -->
                            <!-- We must know for which issueid we are fetching the discussions -->

                            <script>
                            $(document).ready(function(){
                                var iid = $("p").attr("value");
                                var uid = $(".userid").attr("value"); 
                                $(".discuss").click(function(){
                                    $(".modal-body").load("comment-section/fetch.php",{
                                        issueid: iid
                                    });
                                });
                            });
                            </script>
                        </div>

                        <div class="modal-footer">
                            <input id="type-msg" type="text" class="form-control" value="" placeholder="Type a message">
                            <button type="button" class="msg btn btn-danger">Add comment</button>

                            <script>
                                $(document).ready(function(){
                                    //When the user wants to add a comment
                                    $(".msg").click(function(){
                                    $("#type-msg").attr("value","Type a message");
                                    var msg = $("#type-msg").val();
                                    var activeuid = 1;
                                    var iid = $(".issueid").attr("value");
                                    var uid = $(".userid").attr("value");
                                    $.post("comment-section/store-comments.php",{comment: msg, issueid: iid, userid:uid });
                                    $(".modal-body").load("comment-section/fetch.php",{
                                        issueid: iid
                                    });
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>