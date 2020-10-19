<?php
  include_once 'includes\db.php';
  session_start();
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tester Dashboard</title>
        
        <!-- css stylesheet -->
        <link rel="stylesheet" href="styles\tester-dashboard.css">

        <!-- starter templates -->
        <?php
          include_once 'starterTemplates\starters.php';
        ?>
    </head>

    <body>
      <!-- NAVIGATION BAR -->
      <?php
      include 'navbar/nav.php'
      ?>
     
        <?php 
          $name =  $_SESSION['uname'];
        ?>

      <div class="container cont">
        <div class="row">
          <div class="col-sm-12 col-lg-6">
          <br><br>
            <form action="create-project.php" method="POST">
              <button type="submit" class="btn btn-danger"> Create project</button>
            </form>
            <br><br>
            
            <h4 class="headers">Projects assigned by me:</h4>
            <div class="projects-box">
              <form action="show-p-details.php" method="POST">
                <?php
                  //SHOW ALL PROJECTS CREATED BY CURRENT USER (T/A)
                  $uid = $_SESSION['uid'];
                  $sql1 = "SELECT * FROM projects WHERE CreatedByUser=$uid;";
                  $result1 = mysqli_query($con,$sql1);
                  $total1 = mysqli_num_rows($result1);
                  if($total1 > 0)
                  {
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                      //PROJECT NAME
                      $p_name = $row1['ProjectName'];

                      //PROJECT ID
                      $p_id = $row1['ProjectId'];

                      echo '<div class="project-list-box" name="' .$p_name .'">';
                      echo '<h5 class="my-project-heading">' .strtoupper($p_name) .'</h5><br>';

                      //TEAM
                      echo '<h5 class="team"><i class="fas fa-users"></i> Team</h5>';

                      $sql2 = "SELECT * FROM project_user WHERE projectid=$p_id;";
                      $result2 = mysqli_query($con,$sql2);
                      while($row2 = mysqli_fetch_assoc($result2))
                      {
                        $uid = $row2['userid'];
                    
                        //GET USERNAME
                        $sql3 = "SELECT * FROM users WHERE UserId=$uid;";
                        $result3 = mysqli_query($con,$sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $username = $row3['FullName'];
                        echo '<h6 class="mem">' .$username .'</h6>';
                      }
                        echo '<br>';
                        echo '<button class="btn" type="submit" name="p-id" value="' .$p_id  .'"><h6>View more details</h6></button>';
              
                        //GET CREATED DATE AND TIME
                        $datetime = $row1['CreateDateTime'];
                        echo '<h6>CREATED ON: ' .$datetime .'</h6>';
                        echo ' </div> ';
                        echo '<br>';
                    }
                  }
                  else
                  {
                    echo '<h3>No projects created!';
                  }
                ?>          
              </form>
            </div>
          </div>

          <div class="col-sm-12 col-lg-6">
          <br><br>
            <form action="select-project.php" method="POST">
              <button type="submit" class="btn btn-danger"> Create issue</button>
            </form>
            <br><br>
            <h4 class="headers">All projects:</h4>
            
            <form action="show-p-details.php" method="POST">
              <div class="projects-box">
                <?php
                  //PROJECT DETAILS
                  $sql1 = "SELECT * FROM projects;";
                  $result1 = mysqli_query($con,$sql1);
                  $total1 = mysqli_num_rows($result1);
                  if($total1 > 0)
                  {
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                      //PROJECT NAME
                      $p_name = $row1['ProjectName'];

                      //PROJECT ID
                      $p_id = $row1['ProjectId'];

                      echo '<div class="project-list-box" name="' .$p_name .'">';
                      echo '<h5 class="my-project-heading">' .strtoupper($p_name) .'</h5><br>';

                      //TEAM
                      echo '<h5 class="team"><i class="fas fa-users"></i> Team</h5>';

                      $sql2 = "SELECT * FROM project_user WHERE projectid=$p_id;";
                      $result2 = mysqli_query($con,$sql2);
                      while($row2 = mysqli_fetch_assoc($result2))
                      {
                        $uid = $row2['userid'];

                        //GET USERNAME
                        $sql3 = "SELECT * FROM users WHERE UserId=$uid;";
                        $result3 = mysqli_query($con,$sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $username = $row3['FullName'];
                        echo '<h6 class="mem">' .$username .'</h6>';
                      }
                        echo '<br>';
                        echo '<button class="btn" type="submit" name="p-id" value="' .$p_id  .'"><h6>View more details</h6></button>';
                      
                        //GET CREATED DATE AND TIME
                        $datetime = $row1['CreateDateTime'];
                        echo '<h6>CREATED ON: ' .$datetime .'</h6>';
                        echo ' </div> ';
                        echo '<br>';
                    }
                  }
                  else
                  {
                    echo '<h3>No projects created!';
                  }
                ?>
              </div>
            </form>
          </div>
        </div>
        <br><br>
      </div>
    </body>
  </html>
