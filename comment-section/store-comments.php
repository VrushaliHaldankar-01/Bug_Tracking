<?php 
  include '../includes/db.php';
  session_start();

  $msg = $_POST['comment'];
  $iid = $_POST['issueid'];
  $uid = $_POST['userid'];

  date_default_timezone_set("Asia/Kolkata");
  $dateTime = date("Y-m-d h:i:sa");
  $isdeleted= 0;
  
  if(!empty($msg))
  {
    $sql = "INSERT INTO comments (IssueId, UserId,CommentText,CommentDateTime,IsDeleted) VALUES ($iid, $uid, '$msg','$dateTime',$isdeleted);";
    mysqli_query($con,$sql);
  }
?>