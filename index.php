<?php

// Connect to the database
$connect = mysqli_connect(
    'db', // Service name
    'php_docker', // Username
    'password', // Password
    'php_docker' // Database name
);

$table_name = "php_docker_table";

// Query to fetch all data from the table
$query = "SELECT * FROM $table_name";
$response = mysqli_query($connect, $query);

// Check if the query returned any rows
if ($response && mysqli_num_rows($response) > 0) {
    echo "<h2>Data from <strong>$table_name</strong></h2>";
    
    // Start the table
    echo "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>Body</th>";
    echo "<th>Date Created</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    // Loop through and display each row
    while ($row = mysqli_fetch_assoc($response)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row['body']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date_created']) . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No data found in <strong>$table_name</strong>.</p>";
}

// Close the database connection
mysqli_close($connect);

?>
