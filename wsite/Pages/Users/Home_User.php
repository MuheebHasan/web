<?php
session_start();
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$database= new PDO("mysql:host=localhost; dbname=car_spare (3)",$username,$pass);
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="Keyboards" content="">
    <meta name="description" content="">
    <title> Home</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"
            rel="stylesheet"
    />
    <!-- MDB -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"
    ></script>


    <!-- CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
            rel="stylesheet"
    />

    <!-- JavaScript links (jQuery and Popper.js are required) -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
    ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- MDB -->

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../CSS/User/font_awesome.min.css"/>
    <link rel="stylesheet" href="../../CSS/User/Home_user.css"/>
    <link rel="stylesheet" href="../../CSS/User/dhome.css"/>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark ">
        <div class="container-fluid ">
            <a class="navbar-brand" href="Home_User.html" style="margin-left: 40px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon my-toggler" style="color: white">

          </span>
            </button>
            <h2 style="color: #ffcccc">MY CAR STORE</h2>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul style="margin-left: 40%;" class="navbar-nav designnav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Browse">Browse and choose</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Team">Team</a>
                    </li>
                    <li id="order" class="nav-item">
                        <a class="nav-link" href="orders.php">Order</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../sign/login.html">Login</a></li>
                            <li><a class="dropdown-item" href="../sign/signup.html">register</a></li>
                            <li><a class="dropdown-item" href="../sign/login.html"> logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- home -->
<!--Home section-->
<div class="container-fluid star" id="home">
    <div class="bg-image">
        <img src="images/Car Showroom.jpg" width="1450"/>
        <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.6)">
            <div class="home-content">
            </div>
        </div>
    </div>
</div>
<!-- end home-->
<div class="container car_type " id="Browse" >

    <div id="car">
        <marquee direction="right">
            <img draggable="false" src="https://i.imgur.com/H0mfT6f.png"
                 width="15%">
        </marquee>
    </div>
    <div class="row">
        <h3 class="text-center">Types Of Car Parts Available</h3>
    </div >
    <div class="row">
        <span class="line"></span>
    </div>
    <div class="container-fluid">
        <?php
        $select_pro = $database->prepare("select * from car");
        $result=$select_pro->execute();
        if($select_pro->rowCount()==0){
            echo "null";
        }
        else{
            $count=0;
            $newrow=true;
            while($fetch_product=$select_pro->fetch(PDO::FETCH_ASSOC)){

                ?>

                <?php
                if($newrow){
                    $newrow=false;
                    echo '<div class="row gy-lg-3">';
                }

                echo' <div class="col-lg-4 col-sm-12">
            <div class="card bg-dark text-white card-type-car">
                <img  src="typecar/'.$fetch_product['image'].'" class="card-img"  style="height: 270px">
                <div class="card-img-overlay justify-content-center   card-text ">
                    <div class="tt">
                    <h5 class="">'.$fetch_product['namecar'].'</h5>
                    <p class="click">Click hear to see the parts</p>
                    <a href="Type_Product/product.php?val1='.$fetch_product['id'].'"><button class="btn-type"><i class="fa fa-car fa-2x"></i></button></a>
                    </div>
                </div>
            </div>
        </div>';

                $count++;
                if($count==3){
                    echo '</div>';
                    $newrow=true;
                    $count=0;
                }
                ?>
                <?php

            }
        }
        ?>


    </div>
</div>
<!-- Team Section -->

<div class="team pd-y" id="Team">
    <div class="container">
        <div class="row">

            <div class="section-header text-center">
                <Br>                <Br>
                <h2 class="section-title">our team</h2>
                <Br>
                <Br>
                <span class="line"></span>

            </div><!-- ./section-header-->
        </div>
        <div class="team-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="team-item tb-effect">

                        <div class="team-img">
                            <img src="./images/pec.jpeg" alt="">
                            <div class="team-overlay">
                                <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
                                <a href="https://www.instagram.com/moheeb_hasan/?fbclid=IwAR01sckF74kuvEblooTDet-hoLE5x7iku0dm5TcmXxlgDtcnMoalKpTinQM"><i class="fa-brands fa-instagram"></i></a>
                                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="team-info-title">Muheeb Hasan</h3>
                            <span class="team-info-text">Web Designer</span>

                        </div>
                    </div><!-- ./team-item tb-effect-->
                </div>
                <div class="col-lg-6">
                    <div class="team-item tb-effect mg">

                        <div class="team-img">
                            <img src="./images/adham.jpg" alt="">
                            <div class="team-overlay">

                                <a href="https://www.facebook.com/profile.php?id=100034434969996&mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a>
                                <a href="https://instagram.com/adhamaboyaqoub?igshid=MzRlODBiNWFlZA=="><i class="fa-brands fa-instagram"></i></a>
                                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                        <div class="team-info">
                            <h3 class="team-info-title">Adham Yaqoub</h3>
                            <span class="team-info-text">Web Designer</span>

                        </div>
                    </div><!-- ./team-item tb-effect-->
                </div>
            </div>
        </div><!-- ./team-content-->
    </div><!-- ./container-->


</div><!-- ./team-->


</body>
</html>