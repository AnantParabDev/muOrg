<?php
    //connection to server
    $conn = mysqli_connect('localhost', 'root', '');
    if($conn){
        echo "<br>connected successfully";
    }else{
        echo "<br>connection failed";
        exit();
    } 

    //create dB
    $q1 = "CREATE DATABASE IF NOT EXISTS music_organizer";    
    if(mysqli_query($conn, $q1)){
        echo "<br>Created database 'music_organizer'";
    }else{
        echo "<br>failed to create database" . mysqli_error($conn);
        exit();
    }   

    //select dB
    mysqli_select_db($conn, 'music_organizer');

    //create table
    $q2 = "CREATE TABLE IF NOT EXISTS user1 (
    userId INT(100) NOT NULL AUTO_INCREMENT,
    userName VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(30) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    gender VARCHAR(10) DEFAULT 'other',
    nation VARCHAR(20) DEFAULT 'other',
    PRIMARY KEY(userId),  
    UNIQUE KEY(userName),
    UNIQUE KEY(email)
);
";

    if(mysqli_query($conn, $q2))
        echo "<br>Table 'user' created successfully";
    else {
        echo "<br>failed to create table";
        exit();
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['userName']) && isset($_POST['dob']) && isset($_POST['email'])
            && isset($_POST['pass']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['nation']))
        {
            $name = $_POST['userName'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT );
            $ph = $_POST['phone'];
            $nation = $_POST['nation'];
            $gender = $_POST['gender'];
            
            //check data
            $selectRecord = "SELECT * FROM user WHERE email='$email'";
            $checkRecord = mysqli_query($conn, $selectRecord);
            if(mysqli_num_rows($checkRecord)>0) {
                echo "Record already exist";
            } else {
                $q3 = "INSERT INTO user (userName, dob, email, pass, phone, gender, nation)
                                 values('$name','$dob','$email','$pass','$ph','$gender','$nation')";
                if(mysqli_query($conn, $q3)) {
                    echo "<br>Data inserted successfully";
                    //display inserted data
                    echo "<br>RECORD:";
                    echo "<br>Name: $name <br>Date of Birth: $dob <br>Email: $email
                            <br>phone: $ph <br>Nation: $nation <br>Gender:$gender";
                }else {
                    echo "<br>failed to insert data" . mysqli_error($conn);
                }                
            }
        }
    } else {
        echo "<br>Insertion failed" . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
