<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get parameters
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';


//  Cities lookup

if ($lookup === 'cities') {

    $stmt = $conn->prepare(
        "SELECT cities.name AS city, cities.district, cities.population
         FROM cities
         JOIN countries ON countries.code = cities.country_code
         WHERE countries.name LIKE :country"
    );

    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['city']) . "</td>";
        echo "<td>" . htmlspecialchars($row['district']) . "</td>";
        echo "<td>" . htmlspecialchars($row['population']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    exit;
}


// default country lookup


if ($country === '') {
    // If empty, then show all countries
    $stmt = $conn->query("SELECT * FROM countries");
} else {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";

foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($row['continent'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($row['independence_year'] ?? '') . "</td>";
    echo "<td>" . htmlspecialchars($row['head_of_state'] ?? '') . "</td>";
    echo "</tr>";
}

echo "</table>";
?>