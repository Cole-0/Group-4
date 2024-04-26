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
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 3px solid #dcdcdc;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 20px;
            padding-right: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .title {
            padding-top: 20px;
            font-size: 50px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bold;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
        }

        body {
            background-color: #FF7518;
        }

        .container {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3>User Info Page</h3> <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th></th>
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
                            foreach ($distinctNamesResult as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["fname"] . "</td>";
                                echo "<td>" . $row["lname"] . "</td>";
                                echo "<td><button class='view-details-btn'>View Details</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No names found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Details will be dynamically loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6-md custom_display_details"></div>
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
        });
        
        // Bind click event to the "x" button in the modal header
        $('.modal-header .close').click(function() {
            $('#exampleModalCenter').modal('hide'); // Hide the modal
        });

        // Bind click event to the "View Details" buttons
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                event.stopPropagation(); // Stop event propagation
                const firstName = button.closest('tr').querySelector('td:first-child').textContent;
                const lastName = button.closest('tr').querySelector('td:nth-child(2)').textContent;

                $.ajax({
                    url: 'get_details.php',
                    method: 'POST',
                    data: { firstName: firstName, lastName: lastName },
                    success: function(response) {
                        $('.modal-body').html(response);
                        $('#exampleModalCenter').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    });
</script>


</body>

</html>
