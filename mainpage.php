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

// Fetch seminars for the logged-in user
$seminarQuery = "SELECT * FROM crud WHERE UID = :UID";
$seminarResult = $conn->prepare($seminarQuery);
$seminarResult->execute(array(":UID" => $_SESSION['UID']));
$seminars = $seminarResult->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Seminar Information Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
  <a class="navbar-brand" href="#">Seminar Information Page</a>
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
          <a class="btn btn-block" href="addseminar.php">Add</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-block" type="button" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
    <div class="col-10">
      
      
        <div class="card-body  center-content">
          <img src="assets/user.png" class="card-img-top small-image" alt="User">
          <h5 class="card-title" id="userName"><i class="bi bi-person-circle"></i><?php echo htmlspecialchars($fname); ?> <?php echo htmlspecialchars($lname); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($course); ?> - <?php echo htmlspecialchars($position); ?></p>
        </div>
        
      <br><br><br><br><br>
      <h3>List of Seminars Attended</h3>
     
      <?php if (count($seminars) === 0): ?>
        <div class="card">
          <div class="card-body">
            <p class="card-text">No seminars attended.</p>
          </div>
        </div>
      <?php else: ?>
        <?php foreach ($seminars as $seminar): ?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"><?php echo $seminar['title']; ?></h4>
              <p class="card-title">Nature of Seminar: <?php echo $seminar['nature']; ?></p>
              <p class="card-text">Date: <?php echo $seminar['date']; ?></p>
              <p class="card-text">Location: <?php echo $seminar['place']; ?></p>
              <p class="card-text"><a href="view_certificate.php?id=<?php echo $seminar['id']; ?>">View Certificate</a></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
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
    background-color: #808080;
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
