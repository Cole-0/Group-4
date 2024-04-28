<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 2px solid black;
            /* Outer border of the table */
            padding: 16px;
            /* Adjust the padding as needed */
        }

        th,
        td {
            border: 2px solid black;
            border-radius: 20px;
            padding: 12px;
            text-align: center;
        }

        .th_no {
            width: 80px;
        }

        .no-border {
            border: none;
            text-align: center;
            width: 150px;
        }

        body {
            background-color: #FF7518;
        }

        .container {
            margin-bottom: 30px;
        }

        .view-details-btn,
        .modal-footer button {
            color: #FF7518;
            background-color: transparent;
            border: 2px solid #FF7518;
            padding: 4px 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            border-radius: 8px;
        }

        .view-details-btn:hover,
        .modal-footer button:hover {
            background-color: #FF7518;
            color: white;
        }

        .modal-body p {
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <div class="container main-main">
        <div class="row">
            <div class="col-md-8 mx-auto">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search by name" id="searchInput">
                            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                        </div>
                    </div>
                </div>

                <table class="table main_table">
                    <thead>
                        <tr>
                            <th class="th_no">No.</th>
                            <th>Title</th>
                            <th>Place</th>
                            <th>Nature</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db/connect.php';

                        // SQL query to retrieve seminar information
                        $seminarSql = "SELECT id, title, place, nature FROM crud";
                        $stmtSeminars = $conn->prepare($seminarSql);
                        $stmtSeminars->execute();
                        $seminarResult = $stmtSeminars->fetchAll(PDO::FETCH_ASSOC);

                        if (count($seminarResult) > 0) {
                            $counter = 1;
                            foreach ($seminarResult as $row) {
                                echo "<tr>";
                                echo "<td>" . $counter . "</td>";
                                echo "<td>" . $row["title"] . "</td>";
                                echo "<td>" . $row["place"] . "</td>";
                                echo "<td>" . $row["nature"] . "</td>";
                                // Button to view details with data-id attribute containing the seminar ID
                                echo "<td class='no-border'><button class='view-details-btn' data-id='{$row['id']}'>View Details</button></td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No seminars found.</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
                <center>
                    <h6 class="text-white">-----------------Nothing follows------------------</h6>
                </center>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                            </div>
                            <div class="modal-body" style="overflow-y: auto;">
                                <!-- Seminar details will be dynamically loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
$(document).ready(function() {
    $('.modal-footer .btn-secondary').click(function() {
        $('#exampleModalCenter').modal('hide'); // Hide the modal
        $('.main_table').show();
        $('h6').show(); // Show the table
    });
    $(document).on('click', '#backToMainTable', function() {
        $('.modal-body').html(''); // Clear the modal body content
        $('#exampleModalCenter').modal('hide'); // Hide the modal
        loadAllSeminars(); // Load all seminars
    });

    // Function to load all seminars
    function loadAllSeminars() {
        $.ajax({
            url: 'seminar_all_details.php',
            method: 'GET',
            success: function(response) {
                // Replace the table body with all seminars
                $('tbody').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Function to handle the click event of the "View Details" button
    $(document).on('click', '.view-details-btn', function() {
        // Retrieve seminar ID
        const seminarId = $(this).data('id');
        // Make AJAX request to fetch seminar details
        $.ajax({
            url: 'seminars_details.php',
            method: 'GET',
            data: {
                id: seminarId
            },
            success: function(response) {
                // Populate modal content with details
                $('.modal-body').html(response);
                $('#exampleModalCenter').modal({
                    backdrop: false
                });
                // Show modal
                $('#exampleModalCenter').modal('show');
                $('.main_table').hide(); // Hide the main table
                $('h6').hide(); // Hide the message
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Event handler for the search button
    $('#searchButton').click(function() {
        const searchText = $('#searchInput').val().trim();
        if (searchText !== '') {
            $.ajax({
                url: 'seminar_search.php',
                method: 'POST',
                data: {
                    searchText: searchText
                },
                success: function(response) {
                    // Replace the table body with search results
                    $('tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
</script>



</body>

</html>