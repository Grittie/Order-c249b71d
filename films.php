<?php
$host = '127.0.0.1';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

echo "<p><a href=\"index.php\"> Terug </a></p>";

$id = $_GET['id'];
$moviesData = "SELECT * FROM movies WHERE id='$id'";


$moviesQuery= $pdo->query($moviesData);
$movies = $moviesQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($movies as $row) {
    echo '<h1>' . $row['title'] . '</h1>';

    echo '<p>' . "Release date: " .$row['datum_van_uitkomst'] . '</p>';
    echo '<p>' . "Release country: " .$row['land_van_uitkomst'] . '</p>';

    echo '<p>' . $row['description'] . '</p>';

    $videoId = $row["youtube_trailer_id"];
    echo(" <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/$videoId\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>");
}