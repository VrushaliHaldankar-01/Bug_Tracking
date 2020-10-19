<?php
    include_once '../includes\db.php';
    session_start();

    if(isset($_POST['add-issue']))
    {   
        $selectedproject = $_POST['selected'];
        //GET THE PROJECT ID OF SELECTED PROJECT
        $sql1 = "SELECT * FROM projects WHERE ProjectName = '$selectedproject';";
        $result1 = mysqli_query($con,$sql1);
        $row = mysqli_fetch_assoc($result1);
        $project_id = $row['ProjectId'];
        
        //GET CURRENT USER ID
        $created_by =$_SESSION['uid'];

        //SET TIMEZONE AND GET CURRENT DATE AND TIME
        date_default_timezone_set("Asia/Kolkata");
        $dateTime = date("Y-m-d h:i:sa");
        
        //DEFECT DETAILS
        $d_title = $_POST['defect-title'];
        $d_description = $_POST['defect-description'];
        $steps = $_POST['steps-to-reproduce'];
        $d_type = $_POST['defect-type'];

        if($d_type === "Bug")
        {
            $d_type =  'B';
        }

        if($d_type === "Task")
        {
            $d_type = 'T';
        }

        //DEFECT PRIORITY
        $d_priority = $_POST['defect-priority'];

        if($d_priority === "High")
        {
            $d_priority = 'H';
        }

        if($d_priority === "Medium")
        {
            $d_priority = 'M';
        }

        if($d_priority === "Low")
        {
            $d_priority = 'L';
        }

        $d_version = $_POST['defect-version'];

        //USERNAME
        $d_assigned_to = $_POST['assign-defect']; 

        //GET USER ID 
        $sql2 = "SELECT * FROM users WHERE FullName='$d_assigned_to';";
        $result2 = mysqli_query($con,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $d_assigned_to_id = $row2['UserId'];

        //SET DEFECT STATUS TO NEW WHEN CREATED
        $status = 'O';
        $isdeleted = '0';
        
        //STORE DEFECT DETAILS IN ISSUES TABLE
        $sql = "INSERT INTO issues (ProjectId,CreatedByUser,CreateDateTime,Title,Description,Steps,DefectType,Priority,Version,AssignedTo,Status,IsDeleted)
                VALUES ($project_id,$created_by,'$dateTime','$d_title','$d_description','$steps','$d_type', '$d_priority','$d_version',$d_assigned_to_id, '$status','$isdeleted');";
        $result = mysqli_query($con,$sql);

        //GET LAST ISSUE ID
        $last_issue_id = mysqli_insert_id($con);
        $current_issue_id =  $last_issue_id + 1;

         //ADD FILES IF ANY 
        $file = $_FILES['attachments'];
        $fileSize = $file['size'][0];

        //IF filesize == 0, NO FILE IS SELECTED
        if($fileSize != 0)
        {
            //FILE TYPES ALLOWED
            $ext_allowed = array('png','jpeg','jpg','pdf','xlsx','mp4');
        
            //TOTAL FILES SELECTED BY THE USER 
            $file_count = count($file['name']);

            //LOOP THROUGH EACH FILE IN file[] ARRAY
            for ($i=0; $i<$file_count; $i++)
            {
                //GET FILE EXTENSION
                $split_file = explode('.',$file['name'][$i]);
                $file_ext = $split_file[1];
                $file_ext_lowercase = strtolower($file_ext);

                //IF EXTENSION IS ALLOWED
                if(in_array($file_ext_lowercase,$ext_allowed))
                {
                    //CHECK FILE SIZE(<10mb)
                    $max_size = 10 * 1024 * 1024;
                    if($file['size'][$i] < $max_size)
                    {
                    //GIVE UNIQUE FILE NAMES TO AVOID CONFUSION
                    $unique_file_name = uniqid('',true) ."." .$file_ext_lowercase;

                    //STORE THE FILENAME TO issuefiles TABLE AND STORE THE FILES TO issueFiles FOLDER

                    //GET THE TEMPERORY LOCATION OF FILE
                    $file_temp_loc = $file['tmp_name'][$i];

                    //SET FILE DESTINATION PATH
                    $file_dest = '../issueFiles/' .$unique_file_name;

                    //MOVE THE FILES TO issueFiles FOLDER
                    move_uploaded_file($file_temp_loc,$file_dest);

                    //GET ACTIVE userid
                    $activeid = $_SESSION['uid'];

                    //STORE THE FILE NAMES IN issue_files TABLE                    
                    $sql3 ="INSERT INTO issue_files (IssueId,FileName,LinkedTo) 
                    VALUES ($last_issue_id,'$unique_file_name', $activeid);";
                    $result3 = mysqli_query($con,$sql3);
                    header("Location: ../tester-dashboard.php");
                    }
                    else
                    {
                    header("Location: ../create-issue.php?file=large");
                    }
                }
                else
                {
                header("Location: ../create-issue.php?file=ext");
                }
            }
        }
        header("Location: ../tester-dashboard.php");       
    }
?>