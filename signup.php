<?php
session_start();
if (isset($_POST['confirm'])) {
  include('db\connect.php');
  
  $userCode = filter_var(strip_tags($_POST['code']), FILTER_SANITIZE_NUMBER_INT);

  // Check if the entered code matches the stored activation code
  $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE activation_code = ?");
  $stmt->bindParam(1, $userCode);
  $stmt->execute();
  $result = $stmt->fetchAll();

  if (count($result) > 0) {
      // Update the user status to active
      $userId = $result[0]['UID'];
      $updateStmt = $conn->prepare("UPDATE tbl_users SET status = '2' WHERE UID = ?");
      $updateStmt->bindParam(1, $userId);
      
      if ($updateStmt->execute()) {
          // Registration confirmation successful
          $_SESSION['confirmation_success'] = true;
          header("Location: index.php"); 
          exit();
      } else {
          $error = "Error updating user status: " . $updateStmt->errorInfo()[2];
      }
  } else {
      $error = "Invalid activation code!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Registration</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #D7CCC8;
    }
    .container {
      margin-top: 50px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">Account not yet activated!</div>
        <div class="card-body">
          <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $error; ?>
            </div>
          <?php endif; ?>

          <form method="post" action="signup.php">
            <div class="form-group">
              <label for="code">Enter the activation code:</label>
              <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <button type="submit" name="confirm" class="btn btn-primary">Confirm Registration</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
