<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #F4F7F9;
    }
    .slide {
        height: 100%;
        width: 0; /* Initially hidden */
        position: fixed;
        top: 0;
        left: 0;
        background-color: #f87217 ;
        overflow-x: hidden;
        transition: 0.5s ease;
    }
    h1 {
        color: black;
        font-weight: 500;
        text-align: center;
        padding: 10px 0;
        padding-right: 30px;
        pointer-events: none;
    }
    ul {
        list-style: none;
        padding: 0;
        transition: margin-left 0.5s ease;
    }
    ul li a {
        display: block;
        padding: 15px;
        color: black;
        font-weight: 500;
        text-transform: capitalize;
        text-decoration: none;
        transition: 0.2s ease-out;
        font-size: 20px;
    }
    ul li a:hover {
        color: #f87217;
        background-color: #ffffff;
        text-decoration: none; 
    }
    ul li a i {
        margin-right: 10px;
    }
    input[type="checkbox"] {
        display: none;
    }
    .toggle {
        position: absolute;
        height: 30px;
        width: 30px;
        top: 20px;
        left: 15px;
        z-index: 999;
        cursor: pointer;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        padding: 5px;
        border-radius: 5px;
    }
    .toggle .common {
        position: absolute;
        height: 2px;
        width: 20px;
        background-color: #8000ff;
        border-radius: 2px;
        transition: 0.3s ease;
        left: 50%;
        transform: translateX(-50%);
    }
    .toggle .top_line {
        top: 30%;
    }
    .toggle .middle_line {
        top: 50%;
    }
    .toggle .bottom_line {
        top: 70%;
    }
    input[type="checkbox"]:checked ~ .slide {
        width: 250px; /* Slide in when checked */
    }
    input[type="checkbox"]:checked ~ .toggle .top_line {
        left: 2px;
        top: 14px;
        width: 25px;
        transform: rotate(45deg);
    }
    input[type="checkbox"]:checked ~ .toggle .bottom_line {
        left: 2px;
        top: 14px;
        width: 25px;
        transform: rotate(-45deg);
    }
    input[type="checkbox"]:checked ~ .toggle .middle_line {
        opacity: 0;
        transform: translateX(20px);
    }
    .topbar {
        background-color: #f87217;
        font-weight: 500;
        color: black;
    }
    .custom-card-bg {
        background-color: #f87217 ;
    }
    .card {
        border-radius: 15px;
        border: 1px solid black;
        padding: 3px;
    }
 
</style>

</head>
 <div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col text-center">
            <span style="font-size: 44px;">Welcome Admin</span>
            </div>
        </div>
    </div>
 </div>

<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg ">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800; ">1</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of Seminars
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg ">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800;">2</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of Faculty
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800;">3</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of  Male Faculty
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg ">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800;">4</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of Female Faculty  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800;">5</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of MSIT
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card">
            <div class="card custom-card-bg ">
                <h1 class="display-3 text-center mb-4" style="font-weight: 800;">6</h1>
                    <div class="card-body text-center" style="font-weight: 500; font-size: 20px; color: black;">
                        Total Number of DIT
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<body>
    <input type="checkbox" id="toggle-menu">
    <label for="toggle-menu" class="toggle">
        <span class="top_line common"></span>
        <span class="middle_line common"></span>
        <span class="bottom_line common"></span>
    </label>

    <div class="slide">
        <h1>Menu</h1>
        <ul>
            <li><a href="faculty.php"><i class="fas fa-users"></i>List Of Faculty</a></li>
            <li><a href="#"><i class="fas fa-folder"></i>Seminar Catalog</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
