<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>set songs</title>
</head>
<body>
    <style>
        *{
           margin:0;
           padding: 0;
           box-sizing: border-box; 
        }
        body {
        width: 100vw;
        height: 100vh;
        font-family: sans-serif;
        background-color: black;
        color: #fff;
        overflow-x: hidden;
      }
      .main-content{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
      }
      .songs ,.songs-header{
        margin-top: 2em;
        background-color: #242424;
        color: plum;
        border:2px solid greenyellow;
        width: 90%;
        height: 50px;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        align-items: center;
      }
      .songs-item{
        width: 200px;
        text-align: center;
      }
      .songs>.songs-item {
        color: peachpuff;
      }

    </style>
    <form action="" method="">
        <div class="main-content">
          <div class='songs-header'>
                <span class="songs-item">Title</span>
                <span class="songs-item">Artist</span>       
                <span class="songs-item">Genre</span>
                <span class="songs-item">Play</span>
          </div>
            <?php
                $conn = mysqli_connect('localhost','root','','music_organizer');
                $query = "SELECT * FROM songs";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "
                      <div class='songs'>
                            <span class='songs-item'>{$row['title']}</span>
                            <span class='songs-item'>artist</span>       
                            <span class='songs-item'>{$row['genre']}</span>                           
                              <audio controls class='songs-item'>
                                <source src='{$row["filePath"]}'>
                              </audio>
                            
                      </div>
                    ";
                  }
                }
                mysqli_close($conn);
            ?>

            
        </div>
    </form>
</body>
</html>