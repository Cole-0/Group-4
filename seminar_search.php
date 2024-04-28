<?php
require 'db/connect.php';

if (isset($_POST['searchText'])) {
    $searchText = $_POST['searchText'];

    // SQL query to search for seminars based on the title
    $searchSql = "SELECT id, title, place, nature FROM crud WHERE title LIKE :searchText";
    $stmtSearch = $conn->prepare($searchSql);
    $stmtSearch->bindValue(':searchText', '%' . $searchText . '%', PDO::PARAM_STR);
    $stmtSearch->execute();
    $searchResult = $stmtSearch->fetchAll(PDO::FETCH_ASSOC);

    if (count($searchResult) > 0) {
        // Prepare the HTML for search results
        $html = '';
        foreach ($searchResult as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row["title"] . '</td>';
            $html .= '<td>' . $row["place"] . '</td>';
            $html .= '<td>' . $row["nature"] . '</td>';
            // Button to view details with data-id attribute containing the seminar ID
            $html .= "<td class='no-border'><button class='view-details-btn' data-id='{$row['id']}'>View Details</button></td>";
            $html .= '</tr>';
        }
        echo $html;
        echo "<tr><td colspan='4'><button id='backToMainTable' class='btn btn-secondary'>Back</button></td></tr>";
    } else {
        echo "<tr><td colspan='4'>No seminars found.</td></tr>";
        echo "<tr><td colspan='4'><button id='backToMainTable' class='btn btn-secondary'>Back</button></td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>Invalid request.</td></tr>";
    echo "<tr><td colspan='4'><button id='backToMainTable' class='btn btn-secondary'>Back</button></td></tr>";
}
?>
