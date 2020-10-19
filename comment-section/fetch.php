<?php
  include '../includes/db.php';
  session_start(); 
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
      <!-- CSS STYLESHEET -->
      <link rel="stylesheet" href="styles\comment-style.css">
      
      <!-- GOOGLE FONTS -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
      
      <!-- FONTAWESOME -->
      <script src="https://kit.fontawesome.com/aad2bd4516.js" crossorigin="anonymous"></script>
    </head>

    <body>
      <?php
        $issueid = $_POST['issueid'];
        $sql = "SELECT * FROM comments WHERE IssueId=$issueid;";
        $result = mysqli_query($con,$sql);
        $total = mysqli_num_rows($result);

        if($total < 1)
        {
          echo '<div class="cmt-box">';
          echo '<h5>No comments</h5>';
          echo '</div>';
        }
        else
        {
          while($row = mysqli_fetch_assoc($result))
          {
            $messagerid = $row['UserId'];
            $dateTime = $row['CommentDateTime'];

            $sql2 = "SELECT * FROM users WHERE UserId=$messagerid;";
            $result2 = mysqli_query($con,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $messagerName = $row2['FullName'];

            echo '<div class="cmt-box">';
            echo '<h6 class="uname"> <i class="fas fa-user"></i> ' .strtoupper($messagerName) .'</h6>';
            echo '<h6 class="datetime">' .$dateTime .'</h6><br>';
            echo '<h7>' .$row['CommentText'] .'</h7>';
            echo '</div><br>';
          }
        }
      ?>
    </body>
  </html>