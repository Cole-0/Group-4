<!DOCTYPE html>
<html>
<head>
  <title>Seminar Information Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

  <nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="#">Seminar Information Page</a>
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
            <a class="btn btn-block" href="addseminar.php">Add</a>
          </li>
          <li class="nav-item">
            <button class="btn btn-block" type="button">Delete</button>
          </li>
          <li class="nav-item">
            <button class="btn btn-block" type="button">Logout</button>
          </li>
        </ul>
      </div>
      <div class="col-10">
        <!-- Main content goes here -->
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
    background-color: #808080;
    color: white;
    outline: 2px solid #d45500;
  }
</style>
</html>