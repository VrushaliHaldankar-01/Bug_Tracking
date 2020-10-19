<?php
    include_once '../includes\db.php';
    session_start();

    //GET ACTIVE USER ID
    $uid = $_SESSION['uid'];

    //CHECK IF CHANGE PASSWORD BUTTON IS CLICKED
    if(isset($_POST['change-password']))
    {
        //GET ENTERED OLD PASSWORD
        $old_password = $_POST['old_password'];

        //GET ENTERED NEW PASSWORD
        $new_password = $_POST['new_password'];

        //CHECK IF THE FIELDS ARE NOT EMPTY
        if(empty($old_password) || empty($new_password))
        {
            header("Location: ../manage-account.php?err=empty");
        }else{
            //GET ACTUAL PASSWORD
            $sql = "SELECT * FROM users WHERE UserId = $uid;";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_assoc($result);
            $actual_password = $row['Password'];
            
            //CHECK IF ENTERED OLD PASSWORD MATCHES THE ACTUAL PASSWORD
            if($actual_password == $old_password)
            {
                //CHANGE THE PASSWORD
                $sql2 = "UPDATE users
                         SET Password = '$new_password'
                         WHERE UserId = $uid;";
                mysqli_query($con,$sql2);
                header("Location: ../manage-account.php?err=changed");

            }else{
                header("Location: ../manage-account.php?err=incorrpwd");
            }
        }
    }











?>