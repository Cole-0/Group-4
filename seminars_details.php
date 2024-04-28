<?php
require 'db/connect.php';

// Check if seminar ID is provided
if(isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $seminarId = intval($_GET['id']);
    
    // SQL query to fetch details of the specific seminar using the provided ID
    $seminarDetailsSql = "SELECT title, date, place, nature FROM crud WHERE id = :id";
    $stmtSeminarDetails = $conn->prepare($seminarDetailsSql);
    $stmtSeminarDetails->bindParam(':id', $seminarId);
    $stmtSeminarDetails->execute();
    $seminarDetails = $stmtSeminarDetails->fetch(PDO::FETCH_ASSOC);

    // Check if seminar details are found
    if($seminarDetails) {
        // Prepare the HTML to display the seminar details
        $html = '<p><strong>Title:</strong> ' . $seminarDetails['title'] . '</p>';
        $html .= '<p><strong>Date:</strong> ' . $seminarDetails['date'] . '</p>';
        $html .= '<p><strong>Place:</strong> ' . $seminarDetails['place'] . '</p>';
        $html .= '<p><strong>Nature of Training:</strong> ' . $seminarDetails['nature'] . '</p>';
    } else {
        // If no details found for the provided ID
        $html = 'No details found for this seminar.';
    }
} else {
    // If no ID provided
    $html = 'Seminar ID not provided.';
}

echo $html;
?>
