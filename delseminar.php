<!DOCTYPE html>
<html>
<head>
  <title>Seminar Information Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="#">Adding Seminar Information</a>
    <form class="form-inline ml-auto">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-muted my-2 my-sm-0" type="submit">Search</button>
    </form>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-2 sidebar">
        <ul class="nav flex-column">
          <br>
          <li class="nav-item">
            <a class="btn btn-block" href="mainpage.php">Back</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-block" href="#">Logout</a>
          </li>
        </ul>
      </div>
      <div class="col-10">
        <div class="card">
                <div class="card-body  center-content">
                    <img src="assets/user.png" class="card-img-top small-image" alt="User">
                    <h5 class="card-title" id="userName">User Name</h5>
                    <p class="card-text">Professor.</p>
                </div>
        </div>
            <br><br><br><br><br>
        <div class="card">
                <div class="card-header">
                     Seminar Information
                </div>
            <div class="card-body">
              <form id="delete-seminars-form" action="/delete_seminars" method="post">
                <div class="seminar">
                    <input type="checkbox" name="seminar_ids" value="SEMINAR_ID">
                    <div class="card">
                      <div class="seminar-content">
                        <div class="seminar-info">
                          <label>Seminar Title</label>
                          <p>Date: SEMINAR_DATE</p>
                          <p>Location: SEMINAR_LOCATION</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="seminar">
                    <input type="checkbox" name="seminar_ids" value="SEMINAR_ID">
                    <div class="card">
                      <div class="seminar-content">
                        <div class="seminar-info">
                          <label>Seminar Title</label>
                          <p>Date: SEMINAR_DATE</p>
                          <p>Location: SEMINAR_LOCATION</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="seminar">
                    <input type="checkbox" name="seminar_ids" value="SEMINAR_ID">
                    <div class="card">
                      <div class="seminar-content">
                        <div class="seminar-info">
                          <label>Seminar Title</label>
                          <p>Date: SEMINAR_DATE</p>
                          <p>Location: SEMINAR_LOCATION</p>
                        </div>
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger">Delete Selected Seminars</button>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
<style>
  .sidebar {
    background-color: #FF7518;
    height: 100vh;
  }
  .navbar {
    background-color: #FF7518;
    padding: 10px;
    border-bottom: 1px solid #fff;
  }
  .navbar-brand {
    color: #fff;
    font-size: 1.5em;
  }
  .nav-item {
      display: flex;
      justify-content: center;
    }
    .nav-item .btn {
    margin-bottom: 20px;
  }
  .btn {
    background-color: #fff; 
    color: black;
  }
  .btn:hover {
    background-color: gray;
    color: white;
    outline: 2px solid #d45500;
  }
  .center-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh;
    flex-direction: column;
  }
  .small-image {
    margin-top: 100px;
    width: 100px;
    height: 100px;
  }
  .seminar-content {
  display: flex;
  align-items: center;
}

.seminar-info {
  margin-left: 10px;
}
  
</style>
</html>