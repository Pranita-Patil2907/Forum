<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>iDiscuss - Coding Forum</title>
    <style>
      .d-block{
        height: 400px;
        width: 100%;
      }
      </style>
  </head>
  <body>
  
          <?php include "partials/_dbconnect.php";   ?>
          <?php include "partials/_header.php";   ?>



          <!-- Cousrosal -->

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="https://images.pexels.com/photos/1181298/pexels-photo-1181298.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="Coding Image">
              </div>
              <div class="carousel-item">
                <img src="https://th.bing.com/th/id/OIP.EGTYfPeRhAPc80sZogm91gAAAA?rs=1&pid=ImgDetMain" class="d-block w-100" alt="Coding Image">
              </div>
              <div class="carousel-item">
                <img src="https://images.pexels.com/photos/4064172/pexels-photo-4064172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="Coding Image">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </button>
          </div>

          <!-- Categories container starts here -->
          <div class="container">
            <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
            <div class="row">

            <!-- Fetcheing categories -->
            <!-- Using a loop to iterate over the categories -->

            <?php  
            $sql = "SELECT * FROM `idiscuss`";
            $result = mysqli_query($conn, $sql);

            while($row= mysqli_fetch_assoc($result))
            {
              $catid = $row["category_srno"];
              $cat = $row["category_name"];
              $desc = $row["category_description"];
              echo '
              <div class="col-md-4 my-2">
              <div class="card" style="width: 18rem;">
                  <img src="img/'.$cat.'.jpeg" width="30px" class="card-img-top" alt="Python">
                  <div class="card-body">
                    <h5 class="card-title"> <a href="threadlist.php?catid=' . $catid . ' "> ' . $cat . '</a> </h5>
                    <p class="card-text">  ' . substr($desc, 0, 90) . '...
                    </p>
                    <a href="threadlist.php?catid=' . $catid . ' " class="btn btn-primary">View Threads</a>
                  </div>
                </div>
              </div> ' ;
            }
            ?>

            
            </div>
          </div>
          <?php  include "partials/_footer.php"; 
          

          // if($_GET['signupSuccess']=='true' && isset($_GET['signupSuccess']))
          // {
          //   echo "yes";
          // }
          ?>
        




      
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