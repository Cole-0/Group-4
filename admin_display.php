<?php

include 'connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN CRUD DISPLAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <button class="btn btn-primary my-5"><a href="admin_user.php" class="text-light">Add User</a></button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Place</th>
                    <th scope="col">Nature</th>
                    <th scope="col">Certificate</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql = "SELECT * FROM crud";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $date = $row['date'];
                        $place = $row['place'];
                        $nature = $row['nature'];
                        $certificate = $row['certificate'];
                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $title . '</td>
                        <td>' . $date . '</td>
                        <td>' . $place . '</td>
                        <td>' . $nature . '</td>
                        <td>' . $certificate . '</td>

                        <td>
                        <button class="btn btn-primary"><a href="admin_update.php" class="text-light">Update</a></button>
                        <button class="btn btn-danger"><a href="admin_delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                        </td>
                        </tr>';
                    }
                }
                ?>



            </tbody>
        </table>


    </div>

</body>

</html>