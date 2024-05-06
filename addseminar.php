<?php
session_start();
include('db/connect.php');

// Check if the user is logged in
if (!isset($_SESSION['UID'])) {
  // If not logged in, redirect to the login page
  header("Location: index.php");
  exit();
}

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$position = $_SESSION['position'];
$course = $_SESSION['course'];

if (isset($_POST["submit"])) {
    $title = $_POST['seminarTitle'];
    $date = $_POST['seminarDate'];
    $place = $_POST['seminarLocation'];
    $nature = $_POST['natureoftraining'];
    $certificate = file_get_contents($_FILES['certificate']['tmp_name']); // Get the contents of the uploaded file

    // Validate form data (you can add validation logic here)

    if (empty($title) || empty($date) || empty($place) || empty($nature) || empty($certificate)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } else {
        // Check if the seminar already exists
        $checkSeminarQuery = "SELECT * FROM crud WHERE title = :title AND date = :date AND place = :place";
        $checkSeminarResult = $conn->prepare($checkSeminarQuery);
        $checkSeminarResult->execute(array(":title" => $title, ":date" => $date, ":place" => $place));

        if ($checkSeminarResult->rowCount() > 0) {
            echo "<script>alert('Seminar already exists!');</script>";
        } else {
            // Seminar doesn't exist, insert a new row
            $insertSeminarQuery = "INSERT INTO crud (UID, title, date, place, nature, certificate) VALUES (:UID, :title, :date, :place, :nature, :certificate)";
            $insertSeminarResult = $conn->prepare($insertSeminarQuery);
            $insertSeminarResult->bindParam(":UID", $_SESSION['UID']);
            $insertSeminarResult->bindParam(":title", $title);
            $insertSeminarResult->bindParam(":date", $date);
            $insertSeminarResult->bindParam(":place", $place);
            $insertSeminarResult->bindParam(":nature", $nature);
            $insertSeminarResult->bindParam(":certificate", $certificate, PDO::PARAM_LOB); 

            if ($insertSeminarResult->execute()) {
                echo "<script>alert('Seminar added successfully!');</script>";
            } else {
                echo "<script>alert('Failed to add seminar!');</script>";
            }
        }

        header("Location: mainpage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Seminar Information Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
  <a class="navbar-brand">Adding Seminar Information</a>
  <form class="form-inline ml-auto">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-muted my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-2 sidebar">
      <ul class="nav flex-column">
        <br>
        <li class="nav-item">
          <a class="btn btn-block" href="mainpage.php">Back</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-block"  href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
    <div class="col-10">

      <div class="card">
        <div class="card-body  center-content">
          <img src="assets/user.png" class="card-img-top small-image" alt="User">
          <h5 class="card-title" id="userName"><i class="bi bi-person-circle"></i><?php echo htmlspecialchars($fname); ?> <?php echo htmlspecialchars($lname); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($course); ?> - <?php echo htmlspecialchars($position); ?></p>
        </div>
      </div>
      <br><br><br><br><br>

      <br>
      <div class="card">
        <div class="card-header">
          Seminar Information
        </div>
        <div class="card-body">
          <form id="seminarForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"> 
            <div class="form-group">
              <label for="seminarTitle">Title</label>
              <input type="text" class="form-control" id="seminarTitle" name="seminarTitle" placeholder="Enter seminar title">
            </div>
            <div class="form-group">
              <label for="seminarDate">Date</label>
              <input type="date" class="form-control" id="seminarDate" name="seminarDate">
            </div>
            <div class="form-group">
              <label for="seminarLocation">Location</label>
              <input type="text" class="form-control" id="seminarLocation" name="seminarLocation" placeholder="Enter seminar location">
            </div>
            <div class="form-group">
              <label for="natureoftraining">Nature of Training</label>
              <input type="text" class="form-control" id="natureoftraining" name="natureoftraining" placeholder="Enter the nature of your seminar attended">
            </div>
            <div class="form-group">
              <label for="certificate">Certificate</label>
              <input type="file" class="form-control-file" id="certificate" name="certificate"> 
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
<style>
  .sidebar {
    background-color: #FF7518;
    height: 100vh;
  }
  .navbar {
    background-color: #FF7518;
    padding: 10px;
    border-bottom: 1px solid #fff;
  }
  .navbar-brand {
    color: #fff;
    font-size: 1.5em;
  }
  .nav-item {
      display: flex;
      justify-content: center;
    }
    .nav-item .btn {
    margin-bottom: 20px;
  }
  .btn {
    background-color: #fff; 
    color: black;
  }
  .btn:hover {
    background-color: gray;
    color: white;
    outline: 2px solid #d45500;
  }
  .center-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh;
    flex-direction: column;
  }
  .small-image {
    margin-top: 100px;
    width: 100px;
    height: 100px;
  }
</style>
</html>
