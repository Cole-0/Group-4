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
    <div class="col-md-6"><center>
      <h2 class="title">CCSICT FACULTY</h2>
      <h3 class= "title2">Seminar / Training / Conference Monitory System</h3>

      <img src="logosystem.png" class="logo" alt="System Image">
    </div></center>

    <!-- Second Column -->
  
    <div class="col-md-6">
      <div class="card info-card2">
        <div class="card-body2"> <center>
          <h5 class="card-title">LOG IN</h5>
          <h6>Don't have an Account? <a href="main.php" class="link-primary">Create Here!</a></h6></center>

            
          <div class="col-12 mb-3">
            <label>Email:</label>
            <input type="text" class="form-control custom-border" id="email" placeholder="Enter your email">
          </div>
          <div class="col-md-12">
          <div class="input-group mb-3">
              <div class="input-group-prepend">
                  <span class="input-group-text">Password:</span>
              </div>
              <input type="password" class="form-control custom-border" id="password" placeholder="Enter your password" aria-label="Password" aria-describedby="password-addon-1">
              <span class="input-group-text password-toggle" id="password-addon-1">
                  <i class="fas fa-eye"></i>
              </span>
          </div>
      </div>
      


        <div class="row mt-2">
          <div class="col-8 mb-3"> <!-- Added mb-3 class for bottom margin -->
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">VERIFICATION CODE</span>
                  </div>
                  <input type="verification" class="form-control custom-border" id="verification" placeholder="">
              </div>
          </div>
          <div class="col-4">
              <a href="#" class="btn btn-link">SEND CODE</a>
          </div>
        </div>

        <center>
        <button type="button" class="btn py-1 px-4" id="clickButton" style="background-color: #ffa908; border: 2px solid #000; font-family: Arial, sans-serif;"> Submit Response
          <i class="fas fa-angle-right mr-1"></i>
          <i class="fas fa-angle-right mr-1"></i>
        </button></center>





          </div>
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
