<?php
    //connection to server
    $conn = mysqli_connect('localhost', 'root', '', 'music_organizer');
    if($conn){
        echo "<br>connected successfully";
    }else{
        echo "<br>connection failed";
        exit();
    } 
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['userName']) && isset($_POST['pass'])) {
            $name = $_POST['userName'];
            $pass = $_POST['pass'];
            
            //check data
            $selectRecord = "SELECT * FROM user WHERE userName='$name' && pass='$pass";
            $checkRecord = mysqli_query($conn, $selectRecord);
            if(mysqli_num_rows($checkRecord)==1) {
                echo "<br>Login successful";
                header("Location: home.html");
            } else {
                echo "<br>Login failed: Incorrect name or password";
            }
        }
    } else {
        echo "<br>Error in input";
        exit();
    }
    mysqli_close($conn);
    ?>
