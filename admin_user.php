<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $place = $_POST['place'];
    $nature = $_POST['nature'];
    $certificate = $_POST['certificate'];


    $sql = "INSERT INTO crud (title, date, place, nature, certificate) VALUES ('$title', '$date', '$place', '$nature', '$certificate')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:admin_display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADMIN ADD</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="Enter your Name" name="title" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" placeholder="Enter your Date" name="date" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Place</label>
                <input type="text" class="form-control" placeholder="Enter your Place" name="place" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="choice">Nature of Training</label>
                <select class="form-control" name="nature" autocomplete="off">>
                    <option value="participant">Participant</option>
                    <option value="speaker">Speaker</option>
                </select>
            </div>

            <div class="form-group">
                <label>Certificate</label>
                <input type="text" class="form-control" placeholder="Enter your Certificate" name="certificate" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>


</body>

</html>