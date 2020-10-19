<?php

session_start();

?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>MANAGE USERS</title>

      <!-- CSS STYLESHEET -->
      <link rel="stylesheet" href="styles\manage-users.css">

      <?php
        include_once 'starterTemplates\starters.php';
      ?>
    </head>


    <body>

    <!-- NAVIGATION BAR -->
    <?php
      include 'navbar/nav.php'
    ?>
    <br>

    <!-- BACK BUTTON -->
    <form action="admin-dashboard.php" method="POST">
      <button type="submit" name="back" class="btn btn-danger" style="margin-left: 30px; margin-top: 20px;">
        <i class="fas fa-arrow-left" aria-hidden="true"></i>
      </button>       
    </form>
    <br>

    <div class="container">
      <div>
        <h2 class="header">All Users</h2><br>
        <div>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Add User</button>
        </div>
        <br>


        <div id="records_contant"></div>
      </div>

      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Insert User</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <div class="Form-group">
                <label>Username</label>
                <input type="text" placeholder="Username" name="username" id="username" class="form-control" required>
              </div>
            
              <div class="Form-group"> 
                <label>Email</label>
                <input type="email" placeholder="Email" name="email" id="email" class="form-control" required>
              </div>
        
              <div class="Form-group">   
                <label>Password</label>
                <input type="password" placeholder="password" name="psw" id="psw" class="form-control" required>
              </div>


              <div class="Form-group">
                <label for="Access Level">Access Level:</label>
                <select id="UserType" name="UserType">
                  <option value="A">Admin</option>
                  <option value="T">tester</option>
                  <option value="D">Devloper</option>
                </select>
              </div>
              <br>

            <div class="Form-group">   
              <label>Is Active</label>
              <!-- <input type="checkbox"  checked/>-->
              <input type="checkbox"  name="Active" id="Active" checked>
            </div>

            <div class="Form-group">   
                <input type="hidden"  name="delete" id="IsDeleted" value="0">        
            </div>
          </div>
                <br>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Update user details -->
  <div class="modal" id="Update_Modal">
    <div class="modal-dialog">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <div class="Form-group">
          <label>Username</label>
         <input type="text" placeholder="Username" name="username" id="update_username" class="form-control" required>
       </div>
      <div class="Form-group"> 
      <label>Email</label>
          <input type="email" placeholder="Email" name="email" id="update_email" class="form-control" required>
      </div>
  
      <div class="Form-group">   
      <label>Password</label>
          <input type="password" placeholder="password" name="psw" id="update_psw" class="form-control" required>
      </div>
</br>

      <div class="Form-group">
        <label for="Access Level">Access Level:</label>
        <select id="update_UserType" name="UserType">
          <option value="A">Admin</option>
          <option value="T">Tester</option>
          <option value="D">Devloper</option>
        
        </select>
      </div>
<br>
      <!--<div class="Form-group">   
      <label>Is Active</label>
              <input type="checkbox"  checked/>
          <input type="checkbox"  name="Active" id="update_Active" value="1" checked>
              
      </div>-->
      <div class="Form-group">   

                <input type="hidden"  name="delete" id="IsDeleted" value="0">
              
      </div>
</div>
          <br>
  <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		    <input type="hidden" name="" id="hidden_UserId">
      </div>

   
  </div>
</div>
</div>


    <script type="text/javascript">
    $(document).ready(function(){
    readRecords();
    });

    function readRecords(){
        var readrecord = "readrecord";
      $.ajax({
          url:"ADDUSER1.php",
        type:"post",
        data:{ readrecord : readrecord},
        success:function(data,success){
        $('#records_contant').html(data);
        }
      });
    }

    function addRecord(){
        var UN=$('#username').val();
        var email=$('#email').val();
        var Pass1=$('#psw').val();
        var UserType=$('#UserType').val();
        var Active=$('#Active').val();
        console.log(Active);
        var IsDeleted=$('#IsDeleted').val();

        $.ajax({
          url:"ADDUSER1.php",
          type:'post',
          data:{ UN:UN,
              email:email,
              Pass1:Pass1,
              UserType:UserType,
              Active:Active,
          IsDeleted:IsDeleted
              },
              success:function(data,status){
              readRecords();
              }
        });
    }

    function DeleteUser(deleteid){
    var conf=confirm("Are You sure");
    if(conf==true){
    $.ajax({
        url:"ADDUSER1.php",
          type:'post',
        data:{deleteid:deleteid},
        success:function(data,status){
          readRecords();
        }
    });
    }
    }

    function GetUserDetails(UserId){
    $('#hidden_UserId').val(UserId);
    $.post("ADDUSER1.php",{
    UserId:UserId

    },function(data,status){
      //var user = jQuery.parseJSON(data);
      var user=JSON.parse(data);
      $('#update_username').val(user.FullName);
      $('#update_email').val(user.Email);
      $('#update_psw').val(user.Password);
	  $('#update_UserType').val(user.UserType);
        $('#update_Active').val(user.Active);
      $('#IsDeleted').val(user.IsDeleted
    );
    }
    );

    $("#Update_Modal").modal("show"); 
    //$('#Update_Modal').modal("show");
    }

    function UpdateRecord(){ 
    var FirstName=$('#update_username').val();
    var Email=$('#update_email').val();
    var Password=$('#update_psw').val();
    var UserType=$('#update_UserType').val();
    var Active=$('#update_Active').val();
      console.log(Active);
      var IsDeleted=$('#IsDeleted').val();
      var hidden_UserId=$('#hidden_UserId').val();
      $.post("ADDUSER1.php",{
      hidden_UserId:hidden_UserId,
        FirstName:FirstName,
        Email:Email,
        Password:Password,
        UserType:UserType,
        Active:Active,
        IsDeleted:IsDeleted
      },
      function(data,status){
      $("#Update_Modal").modal("hide"); 
      readRecords();
      }
      );
    }
    </script>
  </body>
</html>