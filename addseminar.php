<?php
session_start();

if (isset($_POST['submit'])) {
    // Include database connection file
    include('db/connect.php');

    // Initialize error and success messages
    $error = "";
    $success = "";

    // Retrieve form data
    $title = $_POST['seminarTitle'];
    $date = $_POST['seminarDate'];
    $place = $_POST['seminarLocation'];
    $nature_training = $_POST['natureoftraining'];
    $certificate = $_POST['certificate'];

    // Validate form data (you can add validation logic here)

    // Insert data into database
    try {
        $stmt = $pdo->prepare("INSERT INTO add_seminar (title, date, place, nature_training, certificate) VALUES (:title, :date, :place, :nature_training, :certificate)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':nature_training', $nature_training);
        $stmt->bindParam(':certificate', $certificate);

        if ($stmt->execute()) {
            $success = "Seminar information added successfully";
        } else {
            $error = "Failed to add seminar information";
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
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
    <a class="navbar-brand" href="#">Adding Seminar Information</a>
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
            <a class="btn btn-block" href="#">Logout</a>
          </li>
        </ul>
      </div>
      <div class="col-10">

        <div class="card">
          <div class="card-body  center-content">
            <img src="assets/user.png" class="card-img-top small-image" alt="User">
            <h5 class="card-title" id="userName">User Name</h5>
            <p class="card-text">Professor.</p>
          </div>
        </div>
        <br><br><br><br><br>
=======
        <!-- Main content goes here -->
        <br>
        <div class="card">
          <div class="card-header">
            Seminar Information
          </div>
          <div class="card-body">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                    <input type="file" class="form-control" id="certificate" name="certificate" accept="image/*">
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