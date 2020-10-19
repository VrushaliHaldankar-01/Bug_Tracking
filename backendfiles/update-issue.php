<?php

include_once '../includes\db.php';
session_start();

if(isset($_POST['add-issue']))
{   
    $iid =  $_SESSION['iid'] ;
    $d_title = $_POST['defect-title'];
    $d_description = $_POST['defect-description'];
    $steps = $_POST['steps-to-reproduce'];

    $sql4 = "SELECT * FROM issues WHERE IssueId = $iid;";
    $result4 = mysqli_query($con,$sql4);
    $row4 = mysqli_fetch_assoc($result4);
    //GET PROJECTID
    $project_id = $row4['ProjectId'];

    //DEFECT TYPE
    if(isset($_POST['defect-type']))
    {
        $d_type = $_POST['defect-type'];
    }
    else{
        $d_type = $row4['DefectType'];
    }

    //DEFECT PRIORITY    
    if(isset($_POST['defect-priority']))
    {
        $d_priority = $_POST['defect-priority'];
    }
    else{
        $d_priority = $row4['Priority'];
    }

    //DEFECT VERSION
    if(isset($_POST['defect-version']))
    {
        $d_version = $_POST['defect-version'];
    }
    else{
        $d_version = $row4['Version'];
    }

    //DEFECT STATUS
    if(isset($_POST['stat']))
    {
        $status_selected = $_POST['stat'];
        switch($status_selected)
        {
            case 'New' : $status = 'N';
        break;
            case 'Reopen' : $status = 'E';
        break;
            case 'Close' : $status = 'C';
        break;
            case 'Fixed' : $status = 'F';
        break;
            case 'Reject' : $status = 'R';
        break;
            case 'Defer' : $status = 'D';
        break;
            case 'Retest' : $status = 'T';
        break;
        }
    }
    else{
        $status = $row4['Status'];
    }

    //ASSIGN DEFECT
    if(isset($_POST['assign-defect']))
    {
        $d_assigned_to = $_POST['assign-defect'];
        $sql1 = "SELECT * FROM users WHERE FullName='$d_assigned_to';";
        $result1 = mysqli_query($con,$sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $d_assigned_to_id = $row1['UserId'];
    }
    else{
        $d_assigned_to_id = $row4['AssignedTo'];
    }

    //UPDATE THE ISSUE TABLE
    $sql2 = "UPDATE issues 
            SET Title = '$d_title',
                Description ='$d_description',
                Steps = '$steps',
                DefectType = '$d_type',
                Priority = '$d_priority',
                Version = '$d_version',
                AssignedTo = $d_assigned_to_id,
                Status = '$status'
            WHERE IssueId=$iid;";
    mysqli_query($con,$sql2);
    

    //ADD FILES IF ANY 
    $file = $_FILES['attachments'];
    $fileSize = $file['size'][0];

    //IF FILESIZE == 0, NO FILE HAS BEEN SELECTED
    if($fileSize != 0)
    {
        //FILE TYPES ALLOWED
        $ext_allowed = array('png','jpeg','jpg','pdf','xlsx','mp4');
        
        //TOTAL FILES UPLOADED: 
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
                //CHECK FILE SIZE (<10mb)
                $max_size = 10 * 1024 * 1024;
                if($file['size'][$i] < $max_size)
                {
                    //GIVE UNIQUE FILE NAME
                    $unique_file_name = uniqid('',true) ."." .$file_ext_lowercase;

                    //GET TEMPERORY LOCATION OF THE FILE
                    $file_temp_loc = $file['tmp_name'][$i];

                    //SET FILE DESTINATION PATH
                    $file_dest = '../issueFiles/' .$unique_file_name;

                    //MOVE FILES TO DESTINATION FOLDER
                    move_uploaded_file($file_temp_loc,$file_dest);
 
                    //GET ACTIVE USERID
                    $activeid = $_SESSION['uid'];

                    //STORE THE NEW FILE NAME IN issue_files TABLE                    
                    $sql3 ="INSERT INTO issue_files (IssueId,FileName,LinkedTo) 
                    VALUES ($iid,'$unique_file_name', $activeid);";
                    $result3 = mysqli_query($con,$sql3);
                    header("Location: ../tester-dashboard.php");
                }
                else
                {
                    header("Location: ../edit-issue.php?file=large");
                }
            }
            else
            {
                header("Location: ../edit-issue.php?file=ext");
            }
        }
    }
    header("Location: ../tester-dashboard.php");
}
?>
