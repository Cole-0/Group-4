<?php
// Include database connection
require 'db/connect.php';

// Prepare SQL query to select all users
$sql = "SELECT fname, lname FROM tbl_users";

// Execute the query
$stmt = $conn->query($sql);

// Check if there are any results
if ($stmt->rowCount() > 0) {
    // Start building the table rows
    $counter = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $counter . "</td>";
        echo "<td>" . $row["fname"] . ' ' . $row["lname"] . "</td>";
        echo "<td>Position</td>";
        echo "<td class='no-border'><button class='view-details-btn'>View Details</button></td>";
        echo "</tr>";
        $counter++;
    }
} else {
    // If no users found, display a message in a single row
    echo "<tr><td colspan='4'>No users found.</td></tr>";
}

// Close the database connection
$conn = null;
?>
