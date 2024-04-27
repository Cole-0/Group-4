<?php
require 'db/connect.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$seminarsSql = "SELECT crud.title, crud.date, crud.place, crud.nature
                FROM tbl_users
                LEFT JOIN crud ON tbl_users.UID = crud.id_info
                WHERE tbl_users.fname = :fname AND tbl_users.lname = :lname
                ORDER BY crud.date DESC";

$stmtSeminars = $conn->prepare($seminarsSql);
$stmtSeminars->bindParam(':fname', $firstName);
$stmtSeminars->bindParam(':lname', $lastName);
$stmtSeminars->execute();
$seminarsResult = $stmtSeminars->fetchAll(PDO::FETCH_ASSOC);

$totalSeminarsAttended = 0;
if ($seminarsResult[0]['title'] !== null) {
    $totalSeminarsAttended = count($seminarsResult);
}

if ($totalSeminarsAttended > 0) {
    // Prepare the HTML for user's name and seminars details
    $html = '<p><span style="font-weight: bold; margin-left: 4px">' . $firstName . ' ' . $lastName . ' MIT</span></p>';
    $html .= '<p>Total seminars attended: ' . $totalSeminarsAttended . '</p>';
    $html .= '<table class="seminars-table">';
    $html .= '<tr><th>Title</th><th>Date</th><th>Place</th><th>Nature of Training</th></tr>';
    foreach ($seminarsResult as $seminar) {
        $html .= '<tr>';
        $html .= '<td>' . $seminar["title"] . '</td>';
        $html .= '<td>' . $seminar["date"] . '</td>';
        $html .= '<td>' . $seminar["place"] . '</td>';
        $html .= '<td>' . $seminar["nature"] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
} else {
    $html = 'No seminars attended by '.'<strong>' . $firstName . ' ' . $lastName . '.</strong>';
}

echo $html;
?>
