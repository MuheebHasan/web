<?php
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$conn=new mysqli($db,$username,$pass,$dbn);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../CSS/admin/orderd.css">
    <!-- CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

    <!-- JavaScript links (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <link  rel="stylesheet"  href="../../Css/admin/headera.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="orderd.php">logo</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="orderd.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menuepro.php">product</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="Order.php">Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="user.php">Users</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#">messages</a></li>-->
                </ul>
                <input type="button" class="btn nav-item" style="justify-content: end"><a class="nav-link" href="../../Pages/sign/login.html">Logout <i class="ri-expand-left-line"></i></a>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="title">
                <h2>Dashboard Admin </h2>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1><?php
                    $pend="Pending";

                    $sql=$conn->query("SELECT  sum(total_price) as sumation  FROM orders WHERE status='Pending'");
                    $result=$sql->fetch_assoc();

                    echo $result['sumation'];
                    echo "$";
                    ?></h1>
                <button class="btn-primary">total pending</button>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1>
                    <?php
                    $pend="Delivered";

                    $sql=$conn->query("SELECT  sum(total_price) as sumation  FROM orders WHERE status='Delivered'");
                    $result=$sql->fetch_assoc();

                    echo $result['sumation'];
                    echo "$";
                    ?></h1>
                <button class="btn-primary">total completed</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1><?php


                    $sql=$conn->query("SELECT  count(id) as count  FROM product ");
                    $result=$sql->fetch_assoc();

                    echo $result['count'];

                    ?></h1>
                <button class="btn-primary">total product</button>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1><?php


                    $sql=$conn->query("SELECT  count(id) as count  FROM orders ");
                    $result=$sql->fetch_assoc();

                    echo $result['count'];

                    ?></h1>
                <button class="btn-primary">order Placed</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1><?php


                    $sql=$conn->query("SELECT  count(id) as count  FROM users ");
                    $result=$sql->fetch_assoc();

                    echo $result['count'];

                    ?></h1>
                <button class="btn-primary">total user</button>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <h1>2</h1>
                <button class="btn-primary">new messages</button>
            </div>
        </div>
    </div>
</div>
<!--js link --->
<script type="text/javascript" src="../../js/admin/scriptsd.js"></script>

</body>
</html>
