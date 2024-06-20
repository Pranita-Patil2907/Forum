
<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    include "_dbconnect.php"; 


    $email = $_POST["signupEmail"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = " SELECT * FROM `users` WHERE user_email = '$email' ";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $showError = "User already exist";
        header("location: /Forum/index.php?signupSuccess=false&error=$showError");
    }
    else {
        if($password != $cpassword){
            $showError = "Password does'nt match.";
            header("location: /Forum/index.php?signupSuccess=false&error=$showError");
            exit();

        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `Password`, `timestamp`) VALUES ('$email', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            header("location: /Forum/index.php?signupSuccess=true");

        }
    }

    // header("location: /Forum/index.php?error = $showError&signupSuccess = false");



}

?>