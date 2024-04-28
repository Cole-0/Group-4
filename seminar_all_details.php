<?php
require 'db/connect.php';

$seminarSql = "SELECT id, title, place, nature FROM crud";
$stmtSeminars = $conn->prepare($seminarSql);
$stmtSeminars->execute();
$seminarResult = $stmtSeminars->fetchAll(PDO::FETCH_ASSOC);

$html = '';

if (!empty($seminarResult)) {
    // Prepare the HTML for seminars details
    $counter = 1;
    foreach ($seminarResult as $row) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["place"] . "</td>";
        echo "<td>" . $row["nature"] . "</td>";
        echo "<td class='no-border'><button class='view-details-btn' data-id='{$row['id']}'>View Details</button></td>";
        echo "</tr>";
        $counter++;
    }
} else {
    // If no seminars found, display a message in a single row
    echo "<tr><td colspan='4'>No seminars found.</td></tr>";
}

// Close the database connection
$conn = null;
?>
