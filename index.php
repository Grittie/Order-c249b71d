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

echo " <h1> Welcome to the $db control panel </h1>";

$seriesData = 'SELECT * FROM series';

$seriesQuery= $pdo->query($seriesData);
$series = $seriesQuery->fetchAll(PDO::FETCH_ASSOC);

echo "
<h2> Series </h2>
<table>
    <tr>
        <td style=\"font-weight:bold\"> Title </td>
        <td style=\"font-weight:bold\"> Rating </td>
    </tr>
";
foreach ($series as $row) {
    echo "
    <tr>
        <td>$row[title]</td>
        <td>$row[rating]</td>
        <td><a href=series.php?id=$row[id]> Details </a></td>
    </tr> ";
}

echo "</table>";

$moviesData = 'SELECT * FROM movies';

$moviesQuery= $pdo->query($moviesData);
$movies = $moviesQuery->fetchAll(PDO::FETCH_ASSOC);

echo "
<h2> Movies </h2>
<table>
    <tr>
        <td style=\"font-weight:bold\"> Title </td>
        <td style=\"font-weight:bold\"> Duration </td>
    </tr>
";

foreach ($movies as $row) {
    echo "
    <tr>
        <td>$row[title]</td>
        <td>$row[duur]</td>
        <td><a href=films.php?id=$row[id]> Details </a></td>
    </tr> ";
}

echo "</table>";