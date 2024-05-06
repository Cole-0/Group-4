<?php
session_start();
include('db/connect.php');
// Check if the user is logged in
if (!isset($_SESSION['UID'])) {
  // If not logged in, redirect to the login page
  header("Location: index.php");
  exit();
}

// Fetch faculty information from tbl_users
$facultyQuery = "SELECT * FROM tbl_users";
$facultyResult = $conn->query($facultyQuery);
$faculty = $facultyResult->fetchAll(PDO::FETCH_ASSOC);

// Initialize search variables
$searchResults = [];
if(isset($_GET["search"]) && $_GET["search"] != ""){
  $search = $_GET["search"];
  // Search faculty info by name
  $searchQuery = "SELECT * FROM tbl_users WHERE fname LIKE '%$search%' OR lname LIKE '%$search%'";
  $searchResult = $conn->query($searchQuery);
  $searchResults = $searchResult->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Faculty Information Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
  <a class="navbar-brand" href="#">Faculty Information Page</a>
  <form class="form-inline ml-auto" method="GET">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
    <button class="btn btn-muted my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-2 sidebar">
      <ul class="nav flex-column">
        <br>
        <li class="nav-item">
          <a class="btn btn-block" href="facultyinfo.php">Faculty</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-block" href="admin_display.php">Seminars</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-block" type="button" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
    <div class="col-10">
      <div class="card-body center-content">
        <!-- User Display -->
        <?php if(isset($_SESSION['fname']) && isset($_SESSION['lname']) && isset($_SESSION['position']) && isset($_SESSION['course'])): ?>
          <img src="assets/user.png" class="card-img-top small-image" alt="User">
          <h5 class="card-title" id="userName"><i class="bi bi-person-circle"></i><?php echo htmlspecialchars($_SESSION['fname'] . " " . $_SESSION['lname']); ?></h5>
          <p class="card-text"><?php echo htmlspecialchars($_SESSION['course']); ?> - <?php echo htmlspecialchars($_SESSION['position']); ?></p>
        <?php endif; ?>
      </div>
      <br><br><br><br><br>
      <h3>List of Faculty</h3>
      <div class="row">
        <?php foreach (!empty($searchResults) ? $searchResults : $faculty as $person): ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($person['fname'] . " " . $person['lname']); ?></h5>
                <p class="card-text">Position: <?php echo htmlspecialchars($person['position']); ?></p>
                <p class="card-text">Contact No: <?php echo htmlspecialchars($person['contactno']); ?></p>
                <p class="card-text">Course: <?php echo htmlspecialchars($person['course']); ?></p>
                <p class="card-text">Email: <?php echo htmlspecialchars($person['email']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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
