<?php
include 'db/connect.php';

$sortColumn = 'lname'; 
$sortOrder = 'ASC'; 

// CHECK KUNG ALIN DITO YUNG PININDOT NI USER
if (isset($_POST['sort_column'])) {
    $sortColumn = $_POST['sort_column'];
}
if (isset($_POST['sort_order'])) {
    $sortOrder = ($_POST['sort_order'] === 'DESC') ? 'DESC' : 'ASC';
}

// Retrieve all data with specified sorting
$query = $conn->prepare("SELECT lname, fname, course, email, contactno, status 
                         FROM tbl_users 
                         ORDER BY $sortColumn $sortOrder");
$query->execute(); 
$allResults = $query->fetchAll(); 
$allRows = $query->rowCount(); 

//SUGGESTIONS NI AJAX
if (isset($_GET['searchbar'])) {
    $search = trim($_GET['searchbar']); 
    $query = $conn->prepare("SELECT DISTINCT fname, lname 
                             FROM tbl_users 
                             WHERE LOWER(CONCAT(fname, ' ', lname)) LIKE LOWER(:keyword)");
    $query->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR);
    $query->execute(); 
    $results = $query->fetchAll(PDO::PARAM_STR);

    echo json_encode($results); 
    exit; 
}

$searchResults = null;
$rows = 0;

try {//DISPLAY NUNG SINEARCH
    if (isset($_POST['submit'])) {
        $search = trim($_POST['search']); 
        $query = $conn->prepare("SELECT lname, fname, course, email, contactno, status 
                                 FROM tbl_users 
                                 WHERE LOWER(CONCAT(fname, ' ', lname)) LIKE LOWER(:keyword) 
                                 ORDER BY $sortColumn $sortOrder");
        $query->bindValue(':keyword', '%' . $search . '%', PDO::PARAM_STR);
        $query->execute(); 
        $searchResults = $query->fetchAll(); 
        $rows = $query->rowCount();
    }
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage(); 
    die(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sorting and Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .search-container {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .searchbar {
            width: 500px;
            height: 40px;
        }
        .suggestions {
            border: 1px solid #ccc;
            background: white;
            position: absolute;
            display: none;
            z-index: 10;
            list-style: none;
            padding: 0;
            margin: 0;
            width: 500px;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
    <script>
    function sortOnChange() {
        document.getElementById('sort-form').submit(); 
    }
    </script>
</head>
<body>
    <div class="container">
        <div class="search-container">
            <form method="post" class="d-flex justify-content-center" id="sort-form">
                <div style="position: relative;">
                    <input type="text" class="form-control searchbar" placeholder="Search Data" name="search" id="search-bar" required>
                    <ul class="suggestions" id="suggestions-list"></ul>
                </div>

                <select name="sort_column" class="form-select ml-2" style="width: 150px;" onchange="sortOnChange();">
                    <option value="lname" <?php echo ($sortColumn === 'lname') ? 'selected' : ''; ?>>Sort by Last Name</option>
                    <option value="status" <?php echo ($sortColumn === 'status') ? 'selected' : ''; ?>>Sort by Status</option>
                </select>
                
                <select name="sort_order" class="form-select ml-2" style="width: 150px;" onchange="sortOnChange();">
                    <option value="ASC" <?php echo ($sortOrder === 'ASC') ? 'selected' : ''; ?>>ASC</option>
                    <option value="DESC" <?php echo ($sortOrder === 'DESC') ? 'selected' : ''; ?>>DESC</option>
                </select>
            </form>
        </div>

        <div class="container">
            <?php 
            if ($allRows > 0) {
                echo '<div class="table-container">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Last Name</th>';
                echo '<th>First Name</th>';
                echo '<th>Course</th>';
                echo '<th>Email</th>';
                echo '<th>Contact Number</th>';
                echo '<th>Status</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($allResults as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['lname'] . '</td>';
                        echo '<td>' . $row['fname'] . '</td>';
                        echo '<td>' . $row['course'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['contactno'] . '</td>';
                        echo '<td>' . $row['status'] . '</td>';
                        echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<h4 class="text-danger" style="text-align: center">No results found.</h4>'; 
            }
            ?>
        </div>
    </div>

<script>
$(document).ready(function () {
    var searchBar = $('#search-bar');
    var suggestionsList = $('#suggestions-list');

    searchBar.on('keyup', function () {
        var searchTerm = $.trim($(this).val());

        if (searchTerm.length >= 2) { 
            $.ajax({
                url: '<?php echo $_SERVER["PHP_SELF"]; ?>', 
                type: 'GET',
                data: { searchbar: searchTerm },
                success: function (response) {
                    var suggestions = JSON.parse(response); 
                    suggestionsList.empty(); 

                    if (suggestions.length > 0) { 
                        suggestionsList.show(); 

                        suggestions.forEach(function (suggestion) {// LALABAS SUGGESTIONS BASE SA KEYWORD MO
                            var suggestionText = suggestion.fname + ' ' + suggestion.lname;
                            var item = $('<li>')
                                .addClass('suggestion-item')
                                .text(suggestionText) 
                                .on('click', function () {
                                    searchBar.val(suggestionText); 
                                    document.getElementById('sort-form').submit(); 
                                    suggestionsList.hide(); 
                                });

                            suggestionsList.append(item); 
                        });
                    } else {// WALA LALABAS KAPAG WALA NAGMATCH SA SINEARCH MONG KEYWORD
                        suggestionsList.hide(); 
                    }
                },
                error: function (err) {
                    console.error('Error fetching suggestions:', err); 
                }
            });
        } else {
            suggestionsList.hide(); 
        }
    });
});
</script>

</body>
</html>
