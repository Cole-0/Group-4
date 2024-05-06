<?php
session_start();
require('db/connect.php');

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$position = $_SESSION['position'];
$course = $_SESSION['course'];

try {
    $filter = "";

    if(isset($_GET["search"]) && $_GET["search"] != ""){
        $search = $_GET["search"];
        $filter = "(title LIKE '%" . $search . "%' OR nature LIKE '%" . $search . "%' OR place LIKE '%" . $search . "%')";
    }

    if(isset($_GET["date_filter"]) && $_GET["date_filter"] != ""){
        $year_filter = $_GET["date_filter"];
        if($filter!=""){
            $filter .= " AND YEAR(date) = " . $year_filter;
        } else {
            $filter = "YEAR(date) = " . $year_filter;
        }
    }

    if($filter!=""){
        $filter = " WHERE " . $filter;
    }

    $seminarQuery = "SELECT crud.*, tbl_users.* FROM crud 
                    LEFT JOIN tbl_users ON crud.UID = tbl_users.UID" . $filter;

    $seminarResult = $conn->prepare($seminarQuery);
    $seminarResult->execute();
    $seminars = $seminarResult->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e){
    die("Unexpected error has occurred!" . $e);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>CCSICT FACULTY (Admin)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
    <a class="navbar-brand">CCSICT FACULTY Seminar / Training / Conference Monitory System (Admin) </a>
    <form class="form-inline ml-auto" method="GET">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search">
        <select class="form-control mr-sm-2" name="date_filter">
            <option value="">Filter by Date</option>
            <?php
                //Options for date filter
                $dateOptions = '';
                for ($year = 2015; $year <= 2024; $year++) {
                    $selected = ($_GET['date_filter'] == $year) ? 'selected' : '';
                    $dateOptions .= "<option value=\"$year\" $selected>$year</option>";
                }
                echo $dateOptions;
            ?>
        </select>
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
                    <img src="assets/user.png" class="card-img-top small-image" alt="User">
                    <h5 class="card-title" id="userName"><i class="bi bi-person-circle"></i><?php echo htmlspecialchars($fname); ?> <?php echo htmlspecialchars($lname); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($course); ?> - <?php echo htmlspecialchars($position); ?></p>
                </div>
           
            <br><br><br><br><br>
            <h3>List of All Seminars</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Seminar Title</th>
                    <th scope="col">Nature</th>
                    <th scope="col">Date</th>
                    <th scope="col">Location</th>
                    <th scope="col">Faculty Name</th>
                    <th scope="col">Certificate</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    if(count($seminars) > 0){
                        foreach ($seminars as $seminar){
                            echo "<tr>
                                    <td>".$seminar['title']."</td>
                                    <td>".$seminar['nature']."</td>
                                    <td>".$seminar['date']."</td>
                                    <td>".$seminar['place']."</td>
                                    <td>".$seminar['fname']."</td>
                                    <td><a href='view_certificate.php?id=".$seminar['id']."'>View Certificate</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'><i>No records found!</i></td></tr>";
                    }
                ?>
                </tbody>
            </table>
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
