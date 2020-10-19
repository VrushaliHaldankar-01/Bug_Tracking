<?php
session_start();
 include 'includes/db.php';
 $uid = $_SESSION['uid'];

 $sql = "select b.IssueId, a.FullName as Createdby, d.ProjectName as projectname, b.Title, b.DefectType, b.Priority, b.AssignedTo , b.Status
 from Issues b
 inner join users a on a.UserId = b.CreatedByUser
 inner join projects d on d.ProjectId = b.ProjectId
 where $uid=AssignedTo";

 $result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table</title>
    <!-- STARTER FILES -->
    <?php
    include 'starterTemplates/starters.php';
    ?>
    <link rel="stylesheet" href="styles/table_detail.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>

 <!-- NAVIGATION BAR -->
 <?php
    include 'navbar/nav.php';
 ?>    
 <br>

<div class="container">
<!-- table display -->
<h3>Issues assigned to you:</h3>

<br>
<table class="table header" id="myTable">
  <thead>
    <tr>
      <th scope="col">IssueID</th>
      <th scope="col">Reporter</th>
      <th scope="col">Project Name</th>
      <th scope="col">Defect Title</th>
      <th scope="col">DefectType</th>
      <th scope="col">Priority</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<!-- inserting data from database into the table -->

  <?php
    
    while($row=mysqli_fetch_assoc($result)) 
    {
        
        ?>
       
        <tr>
       
        <td><?php
        $iid = $row['IssueId'];
        echo $iid;
        ?></td>
          
        <td><?php echo $row['Createdby'];  ?></td>
        <td><?php echo $row['projectname']; ?></td>
        <td><?php echo $row['Title']; ?></td>
       
        <td><?php 
            switch ($row['DefectType'])
            {
                case "B" : //new
             
                   
                  echo '<div class="type">Bug</div>';
                    echo '</div>';
                break;
            
                case "T" : //rejected
             
                   
                  echo '<div class="type">Task</div>';
                    echo '</div>';
                break;
            
               
            }
        ?></td>
        <td><?php 
              switch ($row['Priority'])
              {
                  case "H" : //new
               
                      echo '<div class="red status">';
                      echo '<div class="st-msg">High</div>';
                      echo '</div>';
                  break;
              
                  case "M" : //rejected
               
                      echo '<div class="yellow status">';
                      echo '<div class="st-msg">Medium </div>';
                      echo '</div>';
                  break;
              
                  case "L" : //open
               
                      echo '<div class="green status">';
                      echo '<div class="st-msg">Low </div>';
                      echo '</div>';
                  break;
              }
        ?></td>
      
        <td><?php 
                 switch ($row['Status'])
                 {
                     case "N" : //new
                  
                         echo '<div class="purple status">';
                         echo '<div class="st-msg">New </div>';
                         echo '</div>';
                     break;

                     case "R" : //rejected
                  
                         echo '<div class="red status">';
                         echo '<div class="st-msg">Rejected </div>';
                         echo '</div>';
                     break;

                     case "O" : //open
                  
                         echo '<div class="pink status">';
                         echo '<div class="st-msg">Open </div>';
                         echo '</div>';
                     break;

                     case "D" : //deferred
                  
                         echo '<div class="orange status">';
                         echo '<div class="st-msg">Deffered </div>';
                         echo '</div>';
                     break;

                     case "T" : //retest
                  
                         echo '<div class="brown status">';
                         echo '<div class="st-msg">Retest </div>';
                         echo '</div>';
                     break;

                     case "E" : //reopen
                  
                         echo '<div class="blue status">';
                         echo '<div class="st-msg">Reopen </div>';
                         echo '</div>';
                     break;

                     case "C" : //closed
                  
                         echo '<div class="green status">';
                         echo '<div class="st-msg">Closed </div>';
                         echo '</div>';
                     break;
                     case "F" : //fixed
                  
                        echo '<div class="grey status">';
                        echo '<div class="st-msg">Fixed </div>';
                        echo '</div>';
                    break;
                 } 
        ?></td>

        <?php
        // echo '<form action="show-i-details-dev.php" method="POST">';
        // echo '<td><button name="issueid" value="' .$iid .'" class="btn btn-sm btn-primary">View more</button></td>';
        // echo '</form>';
        ?>
         <td><a href="show-i-details-dev.php?detail=<?= $row['IssueId']; ?>" class="badge badge-primary p-2">View Details</a>   </td>

      </tr>
     
<?php    
}

 ?>
  
  </tbody>
</table>
</div>

<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>


<script>
    $(document).ready( function ()
     {
    $('#myTable').DataTable();
    } );
</script>
</body>
</html>

 