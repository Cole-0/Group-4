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
                            <th>Name</th>
                            <th>Position</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'db/connect.php';

                        $distinctNamesSql = "SELECT DISTINCT tbl_users.fname, tbl_users.lname
                                         FROM tbl_users";

                        $stmtDistinctNames = $conn->prepare($distinctNamesSql);
                        $stmtDistinctNames->execute();
                        $distinctNamesResult = $stmtDistinctNames->fetchAll(PDO::FETCH_ASSOC);

                        if (count($distinctNamesResult) > 0) {
                            $counter = 1;
                            foreach ($distinctNamesResult as $row) {
                                echo "<tr>";
                                echo "<td>" . $counter . "</td>";
                                echo "<td>" . $row["fname"] . ' ' . $row["lname"] . "</td>";
                                echo "<td>Position</td>";
                                echo "<td class='no-border'><button class='view-details-btn'>View Details</button></td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='4'>No names found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <center>
                    <h6 class="text-white">-----------------Nothing follows------------------</h6>
                </center>


                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                            </div>
                            <div class="modal-body" style="overflow-y: auto;">
                                <!-- Details will be dynamically loaded here -->
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
    // Bind click event to the close button inside the modal
    $('.modal-footer .btn-secondary').click(function() {
        $('#exampleModalCenter').modal('hide'); // Hide the modal
        $('.main_table').show();
        $('h6').show(); // Show the table
    });

    // Function to bind click event to the "View Details" buttons
    function applyViewDetailsClickHandler() {
        $('.view-details-btn').off('click').on('click', function() {
            const firstName = $(this).closest('tr').find('td:nth-child(2)').text().split(' ')[0];
            const lastName = $(this).closest('tr').find('td:nth-child(2)').text().split(' ')[1];

            $.ajax({
                url: 'info_get_details.php',
                method: 'POST',
                data: {
                    firstName: firstName,
                    lastName: lastName
                },
                success: function(response) {
                    $('.modal-body').html(response);
                    $('#exampleModalCenter').modal({
                        backdrop: false
                    });
                    $('#exampleModalCenter').modal('show');
                    $('.main_table').hide();
                    $('h6').hide(); // Hide the table when the modal is opened
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    }

    // Function to load all user data
    function loadAllUsers() {
        $.ajax({
            url: 'info_all_users.php', // Assuming you have a script to fetch all users
            method: 'GET', // Assuming you use GET method
            success: function(response) {
                $('tbody').html(response);
                applyViewDetailsClickHandler(); // Reapply click event handler to the "View Details" buttons
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Call the function to initially load all user data
    loadAllUsers();

    // Event handler for the search button
    $('#searchButton').click(function() {
        const searchText = $('#searchInput').val().trim();
        if (searchText !== '') {
            $.ajax({
                url: 'info_search.php',
                method: 'POST',
                data: {
                    searchText: searchText
                },
                success: function(response) {
                    // Replace the table body with search results
                    $('tbody').html(response);
                    // Reapply click event handler to the "View Details" buttons
                    applyViewDetailsClickHandler();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    // Event handler for "Back to Main Table" button
    $(document).on('click', '#backToMainTable', function() {
        console.log("Back to Main Table button clicked");
        loadAllUsers(); // Reload all user data
    });
});


    </script>

</body>

</html>