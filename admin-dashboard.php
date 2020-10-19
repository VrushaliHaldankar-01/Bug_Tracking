<?php
  include_once 'includes\db.php';
  session_start();
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <!-- CSS STYLESHEET    -->
        <link rel="stylesheet" href="styles\admin-dashboard-style.css">

        <!-- STARTER FILES -->
        <?php
          include 'starterTemplates\starters.php'; 
        ?>
    </head>

    <body>
      <!-- NAVIGATION BAR -->
      <?php
        include 'navbar\nav.php';
      ?>
    
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-6">
            <form action="create-project.php" method="POST">
              <button class="btn btn-lg btn-danger">Create project</button>
            </form>
          </div>

          <div class="col-sm-12 col-lg-6">
            <form action="manage-users.php" method="POST">
                <button class="btn btn-lg btn-danger">Manage users</button>
            </form>
          </div>
        </div>

        <h3 class="header">All projects</h3>
        <div class="projects-box">
          
            <?php

              $sql = "SELECT * FROM projects;";
              $result = mysqli_query($con,$sql);
              $total = mysqli_num_rows($result);
              if($total < 1)
              {
                echo '<div class="project">';
                  echo '<h4 class="subheader">No Projects created !</h4>'; 
                echo '</div>';
              }else{
                while($row = mysqli_fetch_assoc($result))
                {
                  //GET PROJECT DETAILS
                  $p_name = $row['ProjectName'];
                  $p_id = $row['ProjectId'];
                  $creator = $row['CreatedByUser'];
                  
                  $sql2 = "SELECT * FROM users WHERE UserId = $creator;";
                  $result2 = mysqli_query($con,$sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  $creatorName = $row2['FullName'];

                  echo '<div class="project">';
                    echo '<h4 class="subheader">' .$p_name .'</h4><br>';
                    echo '<h5 class="subheader">Created by: </h5>'; 
                      echo '<div class="creator">';
                        echo '<h5 class="subheader">' .$creatorName .'</h5>';
                      echo '</div>';

                      echo '<form action="show-p-details-admin.php" method="POST">';
                        echo '<div class="viewmore">';
                          echo '<button type="submit" name="projectid" value="' .$p_id .'" class="btn btn-lg" style="margin-top:0px;"><h5>View more details</h5>'  .'</button>';
                        echo '</div>';
                      echo '</form>';
                  echo '</div><hr>';
                }
              }
            ?>
      </div>
    </body>
  </html>
