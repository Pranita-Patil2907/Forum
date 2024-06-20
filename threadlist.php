<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iDiscuss - Threads List</title>
   
  </head>
  <body>
  
  
          <?php include "partials/_dbconnect.php";   ?>
          <?php include "partials/_header.php";   ?>

          


          <?php
          $id = $_GET['catid'];
          $sql = "SELECT * FROM `idiscuss` WHERE category_srno='$id' ";
          $result = mysqli_query($conn, $sql);

          while($row= mysqli_fetch_assoc($result))
          {
            $catname = $row["category_name"];
            $catdesc = $row["category_description"];
            
          }
          
          ?>

          
          <?php 
          $showAlert = false;
          $method = $_SERVER["REQUEST_METHOD"];
          if($method == "POST")
          {
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $Srno = $_POST["Srno"];



          // Inerting thrads into db
          $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$title', '$desc', '$id', '$Srno', current_timestamp());  ";
          $result = mysqli_query($conn, $sql);
         
          $showAlert = true;
          if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added. Please wait for community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }

          // if(!$result){
          //   echo mysqli_error($conn);
          // }


          }
          ?>


      

          <!-- Main Jumbotron-->
          <div class="container my-4">

          <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname?> Forum</h1>
            <p class="lead"> <?php echo $catdesc?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledege with each other. Be respectful, even when there's a disagreement.
            No foul language or discriminatory comments.
            No spam or self-promotion, except in spaces designated for that purpose.
            No links to external websites or companies.
            No NSFW (not safe for work) content.
            No discussions of illegal activities.</p>
                        <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </div>
           
          </div>

          <?php
          // session_start();
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
          echo ' <div class="container">
          <h1 class="py-3"> Start a Discussion</h1>

              <form  action=" '. $_SERVER["REQUEST_URI"] .' " method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as possible. </small>
              </div>
             
              <div class="form-group">
              <label for="exampleFormControlTextarea1">Elaborate Your Problem</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="desc" name="desc"></textarea>
            </div>
            <input type="hidden" name="Srno" value="'.$_SESSION["Srno"].'">

              <button type="submit" class="btn btn-success">Submit</button>
            </form>

          </div>';
        }
        else{
          echo ' 
            <div class="container">
            <h1 class="py-3"> Start a Discussion</h1>
            <p class="lead"> You are not logged In. Login to be able to start a dicsussion. </p>
            </div>
          ';
        }
          
          ?>

          <div class="container my-3">
            <h1 class="py-3"> Browse Questions </h1>

            

          <?php
          $id = $_GET["catid"];
          $sql = "SELECT * FROM `threads` WHERE thread_cat_id='$id' ";
          $result = mysqli_query($conn, $sql);
          $noResult = true; 
          
          while($row= mysqli_fetch_assoc($result))
          {
            $noResult = false;
            $id = $row["thread_id"];
            $title = $row["thread_title"];
            $desc = $row["thread_desc"];
            $thread_time = $row["timestamp"];
            $thread_user_id = $row["thread_user_id"];
            // echo "$thread_user_id";

            $sql2 = "SELECT user_email FROM `users` WHERE Srno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user = $row2['user_email'];


            
            echo ' <div class="media">
            <img src="img/userimg.jpeg" width="55px" class="mr-3" alt="user image">
            <div class="media-body">
            <h5 class="mt-0"> <a href="threads.php?threadid=' . $id . '" class="text-dark"> '. $title.' </a></h5>

            <p class="font-weight-bold my-0"> Asked By: '. $user .' '.$thread_time.'</p>

                <p> '.$desc.'</p>
        </div>
    </div>';
            
  }

      // echo var_dump($noResult);
      if($noResult){
        echo ' <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Questions Found</p>
          <p class="lead">Be the First to ask the Question</p>
        </div>
      </div>';
      }


          
      ?>

        <!-- <div class="media">
                <img src="img/userimg.jpeg" width="55px" class="mr-3" alt="user image">
                <div class="media-body">
                    <h5 class="mt-0">Media heading</h5>
                    <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
            </div>
        </div> -->

        
          </div>
          <?php  include "partials/_footer.php"; ?>




      
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>