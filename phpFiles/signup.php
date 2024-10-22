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
        echo "<br>failed to create database";
        exit();
    }   

    //select dB
    mysqli_select_db($conn, 'music_organizer');

    //create table
    $q2 = "CREATE TABLE IF NOT EXISTS user(
        userId INTEGER not null,
        userName varchar(20) not null,
        dob date NOT NULL,
        email varchar(30) NOT NULL,
        pass varchar(255) not null,
        phone VARCHAR(15) NOT NULL,
        gender varchar(10) DEFAULT 'rather not say',
        nation varchar(20) DEFAULT 'not set',
        primary key(userId), 
        unique key(userName),
        CONSTRAINT chk_phone_length check (LENGTH(phone)>9)

    )";
    if(mysqli_query($conn, $q2))
        echo "<br>Table 'user' created successfully";
    else {
        echo "<br>failed to create table";
        exit();
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['userId']) && isset($_POST['userName']) && isset($_POST['dob']) && isset($_POST['email'])
            && isset($_POST['pass']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['nation']))
        {
            $id = $_POST['userId'];
            $name = $_POST['userName'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $ph = $_POST['phone'];
            $nation = $_POST['nation'];
            $gender = $_POST['gender'];
            
            //check data
            $selectRecord = "SELECT * FROM user WHERE userId='$id'";
            $checkRecord = mysqli_query($conn, $selectRecord);
            if(mysqli_num_rows($checkRecord)>0) {
                echo "Record already exist";
            } else {
                $q3 = "INSERT INTO user (userId, userName, dob, email, pass, phone, gender, nation)
                                 values('$id','$name','$dob','$email','$pass','$ph','$nation','$gender')";
                if(mysqli_query($conn, $q3)) {
                    echo "<br>Data inserted successfully";
                    //display inserted data
                    echo "<br>RECORD:";
                    echo "<br>ID: $id <br>Name: $name <br>Date of Birth: $dob <br>Email: $email <br>Password: $pass
                            <br>phone: $ph <br>Nation: $nation <br>Gender:$gender";
                }else {
                    echo "<br>failed to insert data";
                }                
            }
        }
    } else {
        echo "<br>Insertion failed";
        exit();
    }
    mysqli_close($conn);
    ?>
