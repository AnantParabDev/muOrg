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
            $inputPass = $_POST['pass'];
            
            //check data
            $selectRecord = "SELECT pass FROM user1 WHERE userName='$name'";
            $checkRecord = mysqli_query($conn, $selectRecord); //result set
            $row = mysqli_fetch_assoc($checkRecord);

            if($row) {//found user
                $storedPass = $row['pass'];
                if(password_verify($inputPass, $storedPass)) {
                    echo "<br>Login successful";
                    header("Location: ../home.html");
                    exit();
                }
                else{
                    echo "<br>Login failed: incorrect password";
                }
            } else {
                echo "<br>Login failed: user not found";
            }
        }
    } else {
        echo "<br>Error in input" . mysqli_error($conn);
        exit();
    }
    mysqli_close($conn);
    ?>
