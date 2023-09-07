<?php
declare(strict_types=1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nos";

function db_connect(): object
{
    global $servername;
    global $username;
    global $password;
    global $dbname;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Fout bij het maken van de connection: " . $e->getMessage();
    }
}

// Call the db_connect() function to establish a database connection
$conn = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <link defer rel="stylesheet" href="style.css">
    <title>News</title>
</head>
<body>
    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/NOS_logo.svg">
    </header>
    <nav>
        <ul>
            <li><a href="#">overzicht</a></li>
            <li><a href="#">video's</a></li>
            <li><a href="#">archief</a></li>
            <li><a href="#">binnenland</a></li>
            <li><a href="#">buitenland</a></li>
            <li><a href="#">regionaal nieuws</a></li>
            <li><a href="#">politiek</a></li>
            <li><a href="#">economie</a></li>
            <li><a href="#">koningshuis</a></li>
            <li><a href="#">tech</a></li>
            <li><a href="#">cultuur & media</a></li>
            <li><a href="#">opmerkelijk</a></li>
        </ul>
    </nav>
    <main>
        <?php
            // Assuming you have a "news" table with columns ImageID and TitleID
            $sql = "SELECT ImageSrc, TitleSrc FROM nos_news";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            echo '<section class="news">';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $Imagesrc = $row['ImageSrc'];
                $Titlesrc = $row['TitleSrc'];

                echo '<article>';
                echo '<h2>' .$Titlesrc . '</h2>';
                echo '<img src="' . $Imagesrc . '" alt="">';
                echo '</article>';
            }
            echo '</section>';
            ?>
    </main>
    <footer>
    </footer>
</body>
</html>
