<?php
include('db/connect.php');


$seminarId = $_GET['id'];


$certificateQuery = "SELECT certificate FROM crud WHERE id = :id";
$certificateResult = $conn->prepare($certificateQuery);
$certificateResult->execute(array(":id" => $seminarId));
$certificateData = $certificateResult->fetch(PDO::FETCH_ASSOC);

// Set the appropriate headers for image display
header('Content-Type: image/jpeg');
echo $certificateData['certificate'];
?>
