<?php
include_once 'includes\db.php';
//include_once 'starterTemplates\starters.php';
extract($_POST);


if(isset($_POST['readrecord'])){
   $data='<table class="table table-bordered table-striped">
         <tr>
		   <th>No</th>
		   <th>Full Name</th>
		   <th>Email</th>
		   <th>Edit</th>
		   <th>Delete</th>
		 </tr>';
    $display="select * from users where IsDeleted!='1'";
	$result=mysqli_query($con,$display);
	if(mysqli_num_rows($result)>0){
	
	    $number=1;
		while($row=mysqli_fetch_array($result)){
	    $data .='<tr>
		<td>'.$number.'</td>
		<td>'.$row['FullName'].'</td>
		<td>'.$row['Email'].'</td>
		<td><button onclick="GetUserDetails('.$row['UserId'].')"
		class="btn btn-primary">Edit</button></td>
			<td><button onclick="DeleteUser('.$row['UserId'].')"
		class="btn btn-danger">Delete</button></td>
		</tr>';
		$number++;
		
		
		
		
		}
	
	
	
	}
    $data.='</table>';
	echo $data;





}

if(isset($_POST['UN'])&& isset($_POST['email'])&&isset($_POST['Pass1']) &&isset($_POST['Active']) &&isset($_POST['UserType']) &&isset($_POST['IsDeleted']))
{

     $Active=(isset($_POST['Active']));
 if($Active=='1')
 {
     $Active='1';
	 
 }
 else
 {    
     $Active='0';
 }
echo $Active;

	//$pass1=password_hash($Pass1,PASSWORD_BCRYPT);


	$q1="INSERT INTO users(FullName,Email,Password,IsActive,UserType,Isdeleted) values ('$UN','$email','$Pass1','$Active','$UserType','$IsDeleted')";
	$ri=mysqli_query($con,$q1);
		if(!$ri)
		{
			 echo '<script type="text/javascript">alert("Not Inserted!");window.location.href="signup1.php";</script>'; 
			//echo "Not inserted";
		}
		else
		{
			 //echo '<script type="text/javascript">alert("Inserted!");window.location.href="login.php";</script>'; 
			// header('location:login.php');
		}



}

//delete user record
if(isset($_POST['deleteid'])){
  $userid=$_POST['deleteid'];
  //	$q12="UPDATE users SET IsDeleted='1' WHERE UserId='$userid' ";
	$q12="UPDATE users SET IsDeleted='1',IsActive='0' WHERE UserId='$userid' ";
	$ri=mysqli_query($con,$q12);
		if(!$ri)
		{
			 echo '<script type="text/javascript">alert("Not Inserted!");window.location.href="signup1.php";</script>'; 
			//echo "Not inserted";
		}
		else
		{
			 //echo '<script type="text/javascript">alert("Inserted!");window.location.href="login.php";</script>'; 
			// header('location:login.php');
		}

}


///get userId
if(isset($_POST['UserId'])&&isset($_POST['UserId']) != ""){

  $User_Id=$_POST['UserId'];
  $query="select * from Users where UserId='$User_Id'";
  if(!$result=mysqli_query($con,$query)){
  
    exit(mysqli_error());
  
  }
  $response=array();
  if(mysqli_num_rows($result)>0){
   while($row=mysqli_fetch_assoc($result)){
      $response=$row;
   
   }
  
  
  
  
  }
  else{
  $response['status']=200;
  $response['message']="Data not found";
  
  
  
  }

  echo json_encode($response);




}
 else{
  $response['status']=200;
  $response['message']="Invalid";
  
  
  
  }


if(isset($_POST['hidden_UserId']))
{
$hidden_UserId=$_POST['hidden_UserId'];
 $FirstName=$_POST['FirstName'];
	   $Email=$_POST['Email'];
	   $Password=$_POST['Password'];
	   $UserType=$_POST['UserType'];
	   // $Active=$_POST['Active'];
	 $IsDeleted=$_POST['IsDeleted'];
	   $Active=(isset($_POST['Active']));
 if($Active=='1')
 {
     $Active='1';
 }
 else
 {
     $Active='0';
 }
echo $Active;

	$q1="UPDATE `users` SET `FullName`='$FirstName',`Email`=' $Email',`Password`= '$Password',`IsActive`='1',`IsDeleted`= '$IsDeleted',`UserType`='$UserType' WHERE UserId='$hidden_UserId'";
	$ri=mysqli_query($con,$q1);
		if(!$ri)
		{
			 echo '<script type="text/javascript">alert("Not Inserted!");window.location.href="signup1.php";</script>'; 
			//echo "Not inserted";
		}
		else
		{
			 //echo '<script type="text/javascript">alert("Inserted!");window.location.href="login.php";</script>'; 
			// header('location:login.php');
		}



}




?>
