<?php
   include 'includes/db.php';
    session_start();
    error_reporting(0);
 
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>show issue details</title>
            <link rel="stylesheet" href="styles\show-i-details.css">
     <!-- STARTER FILES -->
           <!-- Google fonts -->
           <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

            <!--BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

           <!-- font awesome -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- JQUERY -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

       </head>
        
        <body>
        <?php
         include 'navbar/nav.php';
        ?>    
        <br>
        <form action="developer-dashboard.php" method="POST">
                <button type="submit" name="back" class="btn  btn-danger" style="margin-left: 30px; margin-top: 20px;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>       
            </form>
            <br>
            <div class="container">
                <?php
                            //go in issue table, fetch all the defect details corresponding to pid
                     
                            
                            if(isset($_GET['detail']))
                               {
                                    $IssueId=$_GET['detail'];
		
	                              	$query="SELECT b.IssueId, d.ProjectName AS projectname , a.Fullname AS Createdby, b.CreateDateTime, b.Title, b.Description, b.Steps, b.DefectType, b.Priority, b.Version, c.FullName AS Assignedto , b.Status
		                            FROM Issues b
		                            inner join users a on a.UserId = b.CreatedByUser
	                            	inner join users c on c.UserId = b.AssignedTo 
                                    inner join projects d on d.ProjectId =  b.ProjectId
	                            	WHERE IssueId=$IssueId";

		                            $result2 = mysqli_query($con, $query);
         
                                    while($row1=mysqli_fetch_assoc($result2)){
                                    //assigning variables
                                    
                                
	       
                                    $_SESSION['vid']=$row1['IssueId']; 
                                    $vid= $_SESSION['vid'];

		                            $vp=$row1['projectname'];
		
	                            	$vCreatedByUser= $row1['Createdby'];

	                            	$vdatetime=$row1['CreateDateTime'];

	                             	$vTitle=$row1['Title'];
		
	                              	$vDescription=$row1['Description'];

	                            	$vsteps=$row1['Steps'];

                             		$vDefectType=$row1['DefectType'];
		 
                             		$vPriority=$row1['Priority'];
 
	                              	$vVersion=$row1['Version'];

                            		$vAssignedTo= $row1['Assignedto'];
 	
                              		$vstatus=$row1['Status'];

                                  
                                      echo '<h3 class="header"><b>DEFECT FOR : '.$vp.' </b></h3>';
                                      echo '<h5 class="subheader">DEFECT DETAILS:</h4><br><br>';
  
                                      echo '<div class="row">';
                                      echo '<div class="col-sm-12 col-lg-6">';                          
                          

                            if($vDefectType =="B")
                            {
                                echo '<label> Defect type: </label>';
                                echo '<div class="type">Bug</div>';
                            }
                            else{
                                echo '<label> Defect type: </label>';
                                echo '<div class="type">Task</div>';
                            }

                            echo '<br><br><br><br>';
                          
                           

                            switch ($vstatus)
                            {
                                case "N" : //new
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="purple status">';
                                    echo '<div class="st-msg">NEW </div>';
                                    echo '</div>';
                                break;

                                case "R" : //rejected
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="red status">';
                                    echo '<div class="st-msg">REJECTED </div>';
                                    echo '</div>';
                                break;

                                case "O" : //open
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="pink status">';
                                    echo '<div class="st-msg">OPEN </div>';
                                    echo '</div>';
                                break;

                                case "D" : //deferred
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="orange status">';
                                    echo '<div class="st-msg">DEFERRED </div>';
                                    echo '</div>';
                                break;

                                case "T" : //retest
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="brown status">';
                                    echo '<div class="st-msg">RETEST </div>';
                                    echo '</div>';
                                break;

                                case "E" : //reopen
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="blue status">';
                                    echo '<div class="st-msg">Reopen </div>';
                                    echo '</div>';
                                break;

                                case "C" : //closed
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="green status">';
                                    echo '<div class="st-msg">CLOSED </div>';
                                    echo '</div>';
                                break;
                                case "F" : //closed
                                    echo '<label> Defect status:</label>';
                                    echo '<div class="grey status">';
                                    echo '<div class="st-msg">FIXED </div>';
                                    echo '</div>';
                                break;
                            }
                            echo '<br><br>';
                            include 'backendfiles/dev-update-status.php';
                          
                            
                                 echo '<br><br>';
                        
                            echo '<label> Created on:</label>';
                            echo '<h5 class="datetime">' .$vdatetime.'</h5>';

                            echo '</div>';


                        echo '<div class="col-sm-12 col-lg-6">';
                            echo '<label> Priority:</label>';
                            if($vPriority== "H"){
                                echo '<h5 class="priority">HIGH</h5>';
                            }else{
                                if($vPriority == "M")
                                {
                                    echo '<h5 class="priority">MEDIUM</h5>';
                                }else{
                                    echo '<h5 class="priority">LOW</h5>';
                                }
                            }
                            echo '<br><br><br><br>';
                           

                            echo '<label> Reported by:</label>';
                            echo '<h5 class="reporter">' .$vCreatedByUser .'</h5>';
                            echo '<br><br><br><br>';


                            echo '<label> Version:</label>';
                            echo '<h5 class="version">' .$vVersion.'</h5>';
                            echo '<br><br><br><br>';
                        echo '</div>';
                    echo '</row>';
                echo '</div><hr>';

                //Defect title
                echo '<h4 class="subheader">Other Details:</h4><br><br>';
                echo '<label> Defect Title:</label>';
                echo '<h5 class="paras">' .$vTitle .'</h5>';

                //Defect description
                echo '<br><br><br><br>';
                echo '<label> Defect Description:</label>';
                echo '<h5 class="paras">' .	$vDescription .'</h5>';

                //Steps to reproduce
                echo '<br><br><br><br>';
                echo '<label> Steps to reproduce:</label>';
                echo '<h5 class="paras">' .	$vsteps .'</h5>';

                echo '<br><br><br><br><hr>';
                echo '<h4 class="subheader">Issue Attachments:</h4><br><br>';
              } 	
    ?>
        <!-- show issue attachments froms issue_files table -->
        <div class="container">
                <?php
                    $sql = "SELECT * FROM issue_files WHERE IssueId=$vid";
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
                            $sql2 = "SELECT * FROM users WHERE UserId=$uid";
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
               
                    }
               ?>          
                
                <br><br><br>
                <hr>

            <!-- DISCUSSIONS -->
            <h5 class="subheader">Discussions: </h4><br><br>
            <?php
                   $uid = $_SESSION['uid'];
                    echo '<p name="issueid" class="issueid" value="' . $vid .'"></p>';
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
