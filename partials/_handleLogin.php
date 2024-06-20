<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "_dbconnect.php";
    // include "_header.php";
    $showError = "false";

    $email = $_POST['loginEmail'];
    $password = $_POST['loginPass'];

    $sql = "select * from `users` where user_email = '$email'";
    $result = mysqli_query($conn, $sql);


    $numRows = mysqli_num_rows($result);
    echo mysqli_error($conn);
    if($numRows == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['Password'])){
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['Srno'] = $row['Srno'];
            $_SESSION['username'] = $email;
            echo "loggedIn". $email;
            header("location: /Forum/index.php?signupSuccess=loggedIn&error=false");
        }
        else{
            echo "Error";
            $showError = "Email or Password invalid.";
            header("location: /Forum/index.php?signupSuccess=Not&error=$showError");

        }
        }
        // header("location: /Forum/index.php?signupSuccess=loggedIn&error=false");
}


?>