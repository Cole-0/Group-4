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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="styleactivation.css" rel="stylesheet">
  
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="activation-box">
          <div class="title">
              <i class="fas fa-exclamation-triangle text-dark custom-icon"></i>
              <div>
                <div class="activation-message1">Account not yet</div>
                <div class="activation-message2">ACTIVATED!</div>
              </div>
          </div>
          <div class="card-body">
            <?php if (isset($error)): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <form method="post" action="signup.php">
              <div class="form-group">
                <label for="code"><b>Enter the activation code:<b></label>
                <input type="text" class="form-control form-control-customize" id="code" name="code" required>
              </div><center>
              <button type="submit" name="confirm" class="btn btn-custom">Confirm Registration</button></center>
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
