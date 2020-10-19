<?php
    include_once '../includes\db.php';
    session_start();

    //IF USER SUBMITS LOG IN DATA
    if(isset($_POST['submit_login']))
    {
        $uemail = $_POST['login_email'];
        $upwd = $_POST['login_pwd'];
        
        //CHECK IF INPUT FIELDS ARE EMPTY
        if(empty($uemail) || empty($upwd))
        {
            header("Location: ../login.php?login=empty");
        }
        else
        {
            $sql = "SELECT * FROM users where Email='$uemail';";
            $result = mysqli_query($con,$sql);
            $total = mysqli_num_rows($result);
            if($total > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $isactivated = $row['IsDeleted'];
                    if($isactivated == 0)
                    {
                        //GET USER TYPE
                        $user_type = $row['UserType'];
                        $actualpwd = $row['Password'];
                        if($actualpwd == $upwd)
                        {
                            $_SESSION['uname']=$row['FullName'];
                            $_SESSION['uid']=$row['UserId'];
                            $_SESSION['utype'] = $user_type;
                            if($user_type == 'T')
                            {
                                header("Location: ../tester-dashboard.php?");
                            }else{
                                if($user_type == 'A')
                                {
                                    header("Location: ../admin-dashboard.php?");
                                }else{
                                    header("Location: ../developer-dashboard.php?");
                                }
                            }
                            
                        } 
                        else
                        {
                            header("Location: ../login.php?login=incorrectpwd");
                        }
                    }else{
                        header("Location: ../login.php?login=deactivated");
                    }
                }
            }
            else
            {
                header("Location: ../login.php?login=nouserfound");
            }
        }
    }
?>