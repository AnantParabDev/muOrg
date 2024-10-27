<?php
    $conn = mysqli_connect('localhost','root','','music_organizer');
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS artists (
                                        artistId INT(100) NOT NULL AUTO_INCREMENT,
                                        artistName VARCHAR(200) NOT NULL,
                                        genre VARCHAR(10) DEFAULT 'new',
                                        bio VARCHAR(200) NOT NULL,
                                        PRIMARY KEY(artistId),
                                        UNIQUE KEY(artistName))"
                );

    if($_SERVER['REQUEST_METHOD']=="POST") {
        if(isset($_POST['artistName']) && isset($_POST['genre']) && isset($_POST['bio']) ) {
                $name = $_POST['artistName'];
                $genre = $_POST['genre'];
                $bio = $_POST['bio'];

                //insertion
                mysqli_query($conn, "INSERT INTO artists (artistName,genre,bio)
                                     VALUES (
                                        '$name','$genre','$bio'
                                     )");
                
            }
        else echo "<br>Insertion failed" . mysqli_error($conn);
    }
    mysqli_close($conn);

?>