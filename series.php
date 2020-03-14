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
$seriesData = "SELECT * FROM series WHERE id='$id'";

$seriesQuery= $pdo->query($seriesData);
$series = $seriesQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($series as $row) {
    echo '<h1>' . $row['title'] . '</h1>';

    echo '<p>' . "Recieved Awards: " .$row['has_won_awards'] . '</p>';
    echo '<p>' . "Seasons: " .$row['seasons'] . '</p>';
    echo '<p>' . "Country: " .$row['country'] . '</p>';
    echo '<p>' . "Language: " .$row['language'] . '</p>';

    echo '<p>' . $row['description'] . '</p>';

}