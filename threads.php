<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iDiscuss - Threads</title>
   
  </head>
  <body>
       
          <?php include "partials/_dbconnect.php";   ?>
          <?php include "partials/_header.php";   ?>


          <?php
          
          $id = $_GET['threadid'];
          $sql = "SELECT * FROM `threads` WHERE thread_id='$id' ";
          $result = mysqli_query($conn, $sql);
         

          while($row= mysqli_fetch_assoc($result))
          {
            $title = $row["thread_title"];
            $desc = $row["thread_desc"];

            
            $thread_user_id = $row["thread_user_id"];
            $sql2 = "SELECT user_email FROM `users` WHERE Srno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user = $row2['user_email'];
          }
          
          
          ?>

        
          <!-- Inserting Comments into comments db -->
          <?php 
          $showAlert = false;
          $method = $_SERVER["REQUEST_METHOD"];
          if($method == "POST")
          {
            $comment = $_POST["comment"];
            $Srno = $_POST["Srno"];

            

          // Inerting thrads into db
          $sql = " INSERT INTO `comments` (`comment_content`, `thread_id`, `posted_by`, `comment_time`) VALUES ('$comment', '$id', '$Srno', current_timestamp());
          ";
          $result = mysqli_query($conn, $sql);
          $showAlert = true;
          if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been posted successfully. 
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
            <h1 class="display-4"> <?php echo $title ?></h1>
            <p class="lead"> <?php echo $desc?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledege with each other. Be respectful, even when there's a disagreement.
            No foul language or discriminatory comments.
            No spam or self-promotion, except in spaces designated for that purpose.
            No links to external websites or companies.
            No NSFW (not safe for work) content.
            No discussions of illegal activities.</p>
            <p> <b> Posted By: <?php echo $user;?></b></p>
            </div>
           
          </div>

          <?php
           if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
          echo ' <div class="container">
          <h1 class="py-3">Post a Comment </h1>

          <form  action=" '. $_SERVER["REQUEST_URI"].' " method="POST">
             
            <div class="form-group">
            <label for="exampleFormControlTextarea1">Type your Comment</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="comment" name="comment"></textarea>
          </div>
          <input type="hidden" name="Srno" value=" '. $_SESSION['Srno'].'">

            <button type="submit" class="btn btn-success">Post Comment</button>
          </form>


          </div>';
        }
        else{
          echo ' 
            <div class="container">
            <h1 class="py-3"> Post a Comment</h1>
            <p class="lead"> You are not logged In. Login to be able to post a comment. </p>
            </div>
          ';
        }

        ?>


          <div class="container my-3">
            <h1 class="py-3">Discussion</h1>

          <?php
          $id = $_GET['threadid'];
          $sql = "SELECT * FROM `comments` WHERE thread_id='$id' ";
          $result = mysqli_query($conn, $sql);
          $noResult = true;

          while($row= mysqli_fetch_assoc($result))
          {
            $noResult = false;
            $id = $row["comment_id"];
            $content = $row["comment_content"];
            $time = $row["comment_time"];
            $thread_user_id = $row["posted_by"];

            $sql2 = "SELECT user_email FROM `users` WHERE Srno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2= mysqli_fetch_assoc($result2);
            $user = $row2['user_email'];

          
            
            echo ' <div class="media">
            <img src="img/userimg.jpeg" width="55px" class="mr-3" alt="user image">
            <div class="media-body">
            <p class="font-weight-bold my-0">'. $user.' '. $time.'</p>
                <p> '.$content.'</p>
        </div>
    </div>';
          }

          if($noResult){
            echo ' <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No Questions Found</p>
              <p class="lead">Be the First to ask the Question</p>
            </div>
          </div>';
          }
          
      ?> 


        
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