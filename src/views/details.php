<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Details</h1>
        <div class="details">
            <p>Film : <?php echo $film['filmTitle']; ?></p>
            <p>Genre : <?php echo $film['filmCategory']; ?></p>
            <p>Duration : <?php echo $film['filmTime']; ?> minutes</p>
            <p>Synopsis : <?php echo $film['filmDetail']; ?></p>
            <p>Author : <?php echo $film['filmAuthor']; ?></p>
            <div class="poster">
                <img src="/Reservation_Cinema_PHP_B2/public/pictures/<?php echo $film['filmPoster']; ?>" alt="<?php echo $film['filmTitle']; ?>">
            </div>
        </div>
    </div>
</body>
</html>
