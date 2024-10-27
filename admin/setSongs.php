<?php
    $conn = mysqli_connect('localhost','root','','music_organizer');
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS songs (
                                        s_id INT(100) NOT NULL AUTO_INCREMENT,
                                        title VARCHAR(200) NOT NULL,
                                        artist VARCHAR(30),
                                        genre VARCHAR(10) DEFAULT 'new',
                                        duration TIME NOT NULL,
                                        filePath VARCHAR(200) NOT NULL,
                                        PRIMARY KEY(s_id),
                                        FOREIGN KEY (artist) REFERENCES artists(artistName)
                                        )"
                );

    if($_SERVER['REQUEST_METHOD']=="POST") {
        if(isset($_POST['title']) && isset($_POST['duration']) && 
            isset($_POST['genre']) && isset($_POST['filePath'])) {
                echo "<br>success";
                $title = $_POST['title'];
                $genre = $_POST['genre'];
                $duration = $_POST['duration'];
                $file = $_POST['filePath'];
                $artist = $_POST['artist'];

                //insertion
                $insertSong = "INSERT INTO songs (title,genre,duration,filePath,artist)
                                     VALUES ('$title','$genre','$duration','..//music_files//{$file}','$artist'
                                     )";
                if(mysqli_query($conn, $insertSong)) {
                    echo "<br> Song Inserted Successfully";
                } else {
                    echo "<br> Error inserting song" . mysqli_error($conn);
                }
            }
        else echo "<br>hmmmmmm" . mysqli_error($conn);
    } else {
        echo "<br>OHHH, no";
    }
    mysqli_close($conn);

?>