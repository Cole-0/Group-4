<?php 
include 'db/connect.php';

if (isset($_POST['submit'])){ //check niya kung napindot ba yung submit button
    $search = $_POST['search'];
    $query = $conn->prepare('SELECT lname, fname, course, email, contactno FROM tbl_users
                                                             WHERE lname LIKE :keyword OR fname LIKE :keyword');
    
    $query->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR); //bind yung sinearcch na keyword sa :keyword
    $query->execute();
    $results = $query->fetchAll(); //check kung meron nahanap
    $rows = $query->rowCount();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorting and Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- CSS di ako marunong magdesign-->
    <style> 
        .table-container {
            text-align: center;
        }
        .table-container table {
            margin: 0 auto;
        }
        .table-container table th,
        .table-container table td {
            padding-left: 100px; 
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px; 
        }
        .searchbar {
            width: 500px; 
            height: 40px;
        }
        .search-container{
            margin-top: 25px;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="search-container"> 
            <form method="post" class="d-flex justify-content-center"> 
                <input type="text" class="form-control mr-2 searchbar" placeholder="Search Data" name="search" required>
                <button type="submit" name="submit" class="btn btn-dark">Search</button>
            </form>
        </div>
        <div class="container">
            <?php 
            if (isset($rows) && $rows != 0){ //check niya kung meron bang result yung nisearch
                echo '<div class="table-container">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Last Name</th>';
                echo '<th>First Name</th>';
                echo '<th>Course</th>';
                echo '<th>Email</th>';
                echo '<th>Contact Number</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach($results as $row){ //display niya
                    echo '<tr>';
                    echo '<td>' . $row['lname'] . '</td>';
                    echo '<td>' . $row['fname'] . '</td>';
                    echo '<td>' . $row['course'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['contactno'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>'; 
            }
            else{
                echo '<h4 class="text-danger">NO RESULT WAS FOUND!</h4>';
            }
            ?>
        </div>
    </div>
</body>
</html>


