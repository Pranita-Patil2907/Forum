
<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <!-- ------------------ -->

    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
    <!-- ------------------ -->
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
    <!-- ------------------ -->

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
        Top Categories
      </a>
        <div class="dropdown-menu">';


          $sql = "SELECT category_name, category_srno FROM `idiscuss` LIMIT 3 ";
          $result=mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_srno'].'">'.$row['category_name'].'</a>';
          }


         
       echo' </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>

        <div class="row mx-2">';


        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
          echo '  <form class="form-inline my-2 my-lg-0" method= "get" action="search.php">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          <p class = "my-0 mx-2 text-light"> Welcome '. $_SESSION['username'].' </p>
           <a href = "partials/_logOut.php" class = "btn btn-outline-success "> LogOut </a>

          </form>
          ';

        }
        else{
          echo '  <form class="form-inline my-2 my-lg-0" method= "get" action="search.php">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> 
          </form>
          <div class="btn btn-success ml-2" data-toggle="modal" data-target="#loginModal">LogIn</div>
          <div class="btn btn-success mx-2" data-toggle="modal" data-target="#signupModal">SignUp</div>
          ';
        }
       
       echo '</div>
        </div>
        </nav>';

        ?>
        <?php

        include 'partials/_loginModal.php';
        include 'partials/_signupModal.php';
        ?>

        <?php  
        
        // if($_GET['signupSuccess']=='true' && isset($_GET['signupSuccess']))
        // {
        //   echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
        //   <strong>Success!</strong> You are ready to login.
        //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button>
        // </div>';
        // }
        // else if($_GET['error']!='false' && isset($_GET['error'])){
        //    $showError = $_GET['error'];
        //   echo '<div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
        //     <strong>Error!</strong> '.$showError.'
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">&times;</span>
        //     </button>
        //   </div>';
        //   }
        //   else if($_GET['signupSuccess']=='loggedIn' && isset($_GET['signupSuccess'])){
        //       echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
        //     <strong>Success! </strong> Successfully SignedIn.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">&times;</span>
        //     </button>
        //   </div>';
        //     }
        //     else{
        //       if($_GET['error']!='Yes' && isset($_GET['error'])){
        //         echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
        //     <strong>Error! </strong> Email or Password invalid.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">&times;</span>
        //     </button>
        //   </div>';

        //       }

        //   }


        


        // if($_GET['loginSuccess']=='true' && isset($_GET['loginSuccess']))
        // {
        //   echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
        //   <strong>Success!</strong> Your account is created..
        //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //   </button>
        // </div>';
        // }
        // else{
        //   if($_GET['loginError']!='false' && isset($_GET['loginError']))
        //   {
        //     $showError = $_GET['loginError'];
        //   echo '<div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
        //     <strong>Error!</strong> '.$showError.'
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //       <span aria-hidden="true">&times;</span>
        //     </button>
        //   </div>';
        //   }
        // }


?>