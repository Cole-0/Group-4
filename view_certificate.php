<?php
include('db/connect.php');

// Retrieve seminar ID from the URL parameter
$seminarId = $_GET['id'];

// Query the database to get the certificate based on the seminar ID
$certificateQuery = "SELECT certificate FROM crud WHERE id = :id";
$certificateResult = $conn->prepare($certificateQuery);
$certificateResult->execute(array(":id" => $seminarId));
$certificateData = $certificateResult->fetch(PDO::FETCH_ASSOC);

// Set the appropriate headers for image display
header('Content-Type: image/jpeg');
echo $certificateData['certificate'];
?>
