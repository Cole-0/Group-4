<?php
require 'db/connect.php';

// Check if the search text is provided and not empty
if (isset($_POST['searchText']) && !empty($_POST['searchText'])) {
    // Sanitize the input to prevent SQL injection
    $searchText = htmlspecialchars($_POST['searchText']);
    
    // Prepare the SQL query to search for names based on the provided search text
    $searchSql = "SELECT tbl_users.fname, tbl_users.lname
                  FROM tbl_users
                  WHERE tbl_users.fname LIKE :searchText
                  OR tbl_users.lname LIKE :searchText";
                  
    $stmtSearch = $conn->prepare($searchSql);
    $stmtSearch->bindValue(':searchText', '%' . $searchText . '%', PDO::PARAM_STR);
    $stmtSearch->execute();
    
    $searchResult = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);

    if (count($searchResult) > 0) {
        $counter = 1;
        foreach ($searchResult as $row) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>";
            echo "<td>" . $row["fname"] . ' ' . $row["lname"] . "</td>";
            echo "<td>Position</td>";
            echo "<td class='no-border'><button class='view-details-btn'>View Details</button></td>";
            echo "</tr>";
            $counter++;
        }
        // Add a button to go back to the main table
        echo "<tr><td colspan='4'><button id='backToMainTable' class='btn btn-secondary'>Back to Main Table</button></td></tr>";
    } else {
        echo "<tr><td colspan='4'>No matching names found.</td></tr>";
        echo "<tr><td colspan='4'><button id='backToMainTable' class='btn btn-secondary'>Back to Main Table</button></td></tr>";
    }
} else {
    // Original query to fetch full main table data
    $originalSql = "SELECT tbl_users.fname, tbl_users.lname
                    FROM tbl_users";
                  
    $stmtOriginal = $conn->prepare($originalSql);
    $stmtOriginal->execute();
    
    $originalResult = $stmtOriginal->fetchAll(PDO::FETCH_ASSOC);

    if (count($originalResult) > 0) {
        $counter = 1;
        foreach ($originalResult as $row) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>";
            echo "<td>" . $row["fname"] . ' ' . $row["lname"] . "</td>";
            echo "<td>Position</td>";
            echo "<td class='no-border'><button class='view-details-btn'>View Details</button></td>";
            echo "</tr>";
            $counter++;
        }
    } else {
        echo "<tr><td colspan='4'>No names found.</td></tr>";
    }
}
?>
