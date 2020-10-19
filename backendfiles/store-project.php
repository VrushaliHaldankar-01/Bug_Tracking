<?php
    include_once '../includes\db.php';
    session_start();

    //CREATE NEW PROJECT
    if(isset($_POST['add-project']))
    {
        $p_name = $_POST['project-name'];
        $p_desc = $_POST['project-desc'];
        $p_platform = $_POST['platform'];
    
        if(empty($p_name) || empty($p_desc))
        {
            header("Location: ../create-project.php?err=empty");
        }
        else
        {
            if(isset($_POST['select-users']))
            {
                if(isset($_POST['platform']))
                {
                    //STORE THE PROJECT DETAILS IN "projects" TABLE
                    
                    //GET ACTIVE USERID
                    $uid = $_SESSION['uid']; 
                    date_default_timezone_set("Asia/Kolkata");
                    $dateTime = date("Y-m-d h:i:sa");
                    $is_deleted = '0';
                    $project_status = 'P';

                    //CREATE TEMPLATE
                    $sql = "INSERT INTO projects (ProjectName,CreatedByUser,CreateDateTime,IsDeleted,ProjectStatus,Description,Platform)
                            VALUES (?,?,?,?,?,?,?);";

                    //CREATE PREPARED STATEMENT
                    $stmt = mysqli_stmt_init($con);

                    //PREPARE THE PREPARED STATEMENT
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        echo 'Error in prepared statement';
                    }
                    else
                    {
                        //BIND THE PARAMETERS TO THE PLACEHOLDER
                        mysqli_stmt_bind_param($stmt,"sisssss", $p_name, $uid, $dateTime,$is_deleted, $project_status,$p_desc,$p_platform);
                        
                        //RUN THE STATEMENT
                        mysqli_stmt_execute($stmt);
                    }

                    //GET PROJECT ID
                    $sql2 = "SELECT * FROM projects WHERE ProjectName='$p_name';";
                    $result2 = mysqli_query($con,$sql2);
                    while($row = mysqli_fetch_assoc($result2))
                    {
                        $p_id = $row['ProjectId'];
                        $_SESSION['pid'] = $p_id; //THIS WILL BE USED TO DISPLAY/EDIT PROJECT DETAILS AFTER THE PROJECT IS ADDED.

                        // GET USERNAMES FOR EACH USERID 
                        $allusers = $_POST['select-users'];
                        foreach($allusers as $user)
                        {
                            $sql3 = "SELECT * FROM users WHERE FullName='$user';";
                            $result3 = mysqli_query($con,$sql3);
                            while($row2 = mysqli_fetch_assoc($result3))
                            {
                                $u_id = $row2['UserId'];
                                $sql4 = "INSERT INTO project_user (projectid,userid) VALUES( $p_id,$u_id);";
                                mysqli_query($con,$sql4);
                            }
                        }
                    }
                    header("Location: ../review-project.php?");
                }
                else
                {
                        header("Location: ../create-project.php?err=plt");
                }
            }
            else
            {
                header("Location: ../create-project.php?err=usrs");
            }
        }
    }

    //UPDATE PROJECT
    if(isset($_POST['update-project']))
    {
        $pid =  $_SESSION['current-project-id'];
        $p_name = $_POST['project-name'];
        $p_desc = $_POST['project-desc'];

        //CHECK IF ANY INPUT FIELDS ARE LEFT EMPTY
        if(empty($p_name) || empty($p_desc))
        {
            header("Location: ../create-project.php?err=empty");
        }
        else
        {
            if(isset($_POST['platform']))
            { 
                $p_platform = $_POST['platform'];
                //UPDATE projects TABLE
                $sql = "UPDATE projects
                        SET ProjectName = '$p_name',
                            Description = '$p_desc',
                            Platform = '$p_platform'
                            WHERE ProjectId = $pid;";
                mysqli_query($con,$sql);

                $allusers = $_POST['update-users'];
                if(!empty($allusers))
                {
                    $sql5 = "DELETE FROM project_user WHERE projectid = $pid;";
                    mysqli_query($con,$sql5);    
                    foreach($allusers as $user)
                    {
                        $sql3 = "SELECT * FROM users WHERE FullName='$user';";
                        $result3 = mysqli_query($con,$sql3);        
                        while($row2 = mysqli_fetch_assoc($result3))
                        {
                            $u_id = $row2['UserId'];
                            $sql4 = "INSERT INTO project_user (projectid,userid) VALUES($pid,$u_id)";
                            mysqli_query($con,$sql4);
                        }
                    }
                }
                header("Location: ../review-project.php?");
            }
            else
            {
                $p_platform =$_SESSION['current-project-platform'];
                $sql = "UPDATE projects
                        SET ProjectName = '$p_name',
                            Description = '$p_desc',
                            Platform = '$p_platform'
                            WHERE ProjectId = $pid;";
                mysqli_query($con,$sql);

                $allusers = $_POST['update-users'];
                if(!empty($allusers))
                {
                    $sql5 = "DELETE FROM project_user WHERE projectid = $pid;";
                    mysqli_query($con,$sql5);
                    foreach($allusers as $user)
                    {
                        $sql3 = "SELECT * FROM users WHERE FullName='$user';";
                        $result3 = mysqli_query($con,$sql3);        
                        while($row2 = mysqli_fetch_assoc($result3))
                        {
                            $u_id = $row2['UserId'];
                            $sql4 = "INSERT INTO project_user (projectid,userid) VALUES($pid,$u_id)";
                            mysqli_query($con,$sql4);
                        }
                    }
                }
                header("Location: ../review-project.php?");
            }
        }
    }
?>