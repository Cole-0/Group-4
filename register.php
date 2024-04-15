<?php
session_start();

if (isset($_POST['submit'])) {
    include('db\connect.php');
    $error = "";
    $success = "";

    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $contactno = isset($_POST['contactno']) ? $_POST['contactno'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if (empty($fname) || empty($lname) || empty($contactno) || empty($course) || empty($email) || empty($_POST['password'])) {
        echo "<script>alert('Please input all the details needed!'); history.back();</script>";
    } else {
        $fname = filter_var(strip_tags($fname), FILTER_SANITIZE_STRING);
        $lname = filter_var(strip_tags($lname), FILTER_SANITIZE_STRING);
        $contactno = filter_var(strip_tags($contactno), FILTER_SANITIZE_NUMBER_INT);
        $course = filter_var(strip_tags($course), FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $email = filter_var(strip_tags($email), FILTER_SANITIZE_EMAIL);
        $activation_code = rand(10000, 99999);

        // Validate password length and complexity
        if (strlen($password) < 6 || strlen($password) > 15 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
            echo "<script>alert('Password must be between 6 and 15 characters and contain at least one uppercase letter, one lowercase letter, and one number.'); history.back();</script>";
        } else {
            // Use prepared statement to check if email already exists
  

            $stmtEmail = $conn->prepare("SELECT * FROM tbl_users WHERE email = ?");
            $stmtEmail->bindParam(1, $email);
            $stmtEmail->execute();
            $resultEmail = $stmtEmail->fetchAll();

            if (count($resultEmail) > 0) {
                echo "<script>alert('Email already exists!'); history.back();</script>";
            } elseif ($password !== $_POST['confirmPassword']) {
                // Confirm Password
                echo "<script>alert('Password does not match!'); history.back();</script>";
            } else {
                // The email are available, proceed with user registration
                // Insert the user data into the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmtInsert = $conn->prepare("INSERT INTO tbl_users (fname, lname, contactno, course, password, email, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmtInsert->bindParam(1, $fname);
                $stmtInsert->bindParam(2, $lname);
                $stmtInsert->bindParam(3, $contactno);
                $stmtInsert->bindParam(4, $course);
                $stmtInsert->bindParam(5, $hashedPassword);
                $stmtInsert->bindParam(6, $email);
                $stmtInsert->bindParam(7, $activation_code);

                if ($stmtInsert->execute()) {
                    // Registration successful, set session variables
                    $_SESSION['fname'] = $fname;
                    $_SESSION['lname'] = $lname;
                    $_SESSION['contactno'] = $contactno;
                    $_SESSION['course'] = $course;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $hashedPassword;
                    $_SESSION['activation_code'] = $activation_code;

                    // Include the file to send activation email
                    include('emailer\emailver.php');

                    // Redirect to the confirmation page
                    header("Location: signup.php");
                    exit();

                } else {
                    // Handle the error
                    $error = "<script>alert('Error inserting data into the database: " . $stmtInsert->errorInfo()[2] . "'); history.back();</script>";
                    echo $error;
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
 
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- First Column -->
            <div class="col-md-6">
                <center>
                    <h2 class="title">CCSICT FACULTY</h2>
                    <h3 class="title2">Seminar / Training / Conference Monitory System</h3>
                    <img src="assets\logosystem.png" class="logo" alt="System Image">
                </center>
            </div>

            <!-- Second Column -->
            <div class="col-md-6">
                <div class="card info-card">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">SIGN IN</h5>
                            <h6>Log In Your Account? <a href="index.php" class="link-primary">Click Here!</a></h6>
                        </center>
                        <form method="post" action="register.php">
                            <div class="row mb-2">
                                <!-- Added mb-3 class for bottom margin -->
                                <div class="col-md-6">
                                    <label for="firstname">First Name:</label>
                                    <input type="text" class="form-control custom-border" name="fname" placeholder="Enter your first name">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name:</label>
                                    <input type="text" class="form-control custom-border" name="lname" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <!-- Added mb-3 class for bottom margin -->
                                <div class="col-md-6">
                                    <label for="firstname">Contact Number:</label>
                                    <input type="text" class="form-control custom-border" name="contactno" placeholder="Enter your contact number">
                                </div>
                                <div class="col-md-6">
                                    <label>Course:</label>
                                    <input type="text" class="form-control custom-border" name="course" placeholder="Enter your course">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <label>Email:</label>
                                <input type="text" class="form-control custom-border" name="email" placeholder="Enter your email">
                            </div>
                            <div class="col-md-12">
                              
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password:</span>
                                    </div>
                                    <input type="password" class="form-control custom-border"  name="password" id="password" placeholder="Enter your password" aria-label="Password" aria-describedby="password-addon-1">
                                    <span class="input-group-text password-toggle" id="password-addon-1">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Confirm Password</span>
                                </div>
                                <input type="password" class="form-control custom-border" name="confirmPassword" id="confirm-password" placeholder="" aria-label="Confirm Password" aria-describedby="password-addon-2">
                                <span class="input-group-text password-toggle" id="password-addon-2">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div><br>
                            <center>
                                <button type="submit" class="btn py-1 px-4" name="submit" style="background-color: #ffa908; border: 2px solid #000; font-family: Arial, sans-serif;"> Submit Response
                                    <i class="fas fa-angle-right mr-1"></i>
                                    <i class="fas fa-angle-right mr-1"></i>
                                </button>
                            </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="iconscript.js"></script>
    <script src="button.js"></script>
</body>

</html>
