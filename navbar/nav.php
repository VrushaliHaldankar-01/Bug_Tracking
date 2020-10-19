<?php
$utype = $_SESSION['utype'];
?>

<div class="container" style="text-align:center;">
  <nav class="navbar navbar-expand-md navbar-light bg-light" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
          
    <div  class="collapse navbar-collapse lol " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <img src="includes\default-profile.png" alt="default-profile" height="40px" width="65px" style="margin-top:5px;">
        </li> 

        <li class="nav-item">
          <a class="nav-link" href="manage-account.php"><h5 class="opts">Manage account</h5></a>
        </li> 

        <?php    
        if($utype == 'T')
        {
          echo '<li class="nav-item">
                  <a class="nav-link" href="my-issues.php"><h5 class="opts">Track issues</h5></a>
                </li>';
        }       
        ?>

        <?php
        if($utype == 'T')
        {
          echo '<li class="nav-item">
                  <a class="nav-link" href="tester-dashboard.php"><h5 class="opts">My Dashboard</h5></a>
                </li> ';
        }else{
          if($utype == 'A')
          {
            echo '<li class="nav-item">
                    <a class="nav-link" href="admin-dashboard.php"><h5 class="opts">My Dashboard</h5></a>
                  </li>'; 
          }else{
            echo '<li class="nav-item">
                    <a class="nav-link" href="developer-dashboard.php"><h5 class="opts">My Dashboard</h5></a>
                  </li>'; 
          }
        }        
        ?>
        <li class="nav-item">
          <a class="nav-link" href="backendfiles/logout.php"><h5 class="opts">Logout</h5></a>
        </li> 

      </ul> 
    </div>
  </nav>
</div>