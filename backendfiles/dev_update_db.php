<?php
session_start();
include '../includes/db.php';


$vid= $_SESSION['vid'];
if(isset($_POST["insert"]))
{
    $q1="UPDATE `issues` SET `Status` = '".$_POST["insert"]."' WHERE `issues`.`IssueId` = $vid";
    $result = mysqli_query($con, $q1); 
 
 }

?>