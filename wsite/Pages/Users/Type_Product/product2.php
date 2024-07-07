<?php

$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$database= new PDO("mysql:host=localhost; dbname=car_spare (3);",$username,$pass);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Type Product</title>

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

    <link rel="stylesheet" href="../../CSS/font-awesome.min.css"/>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../CSS/User/type_product/type_product.css"/>
</head>
<body>
<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">logo</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <li class="nav-item"><a class="nav-link" href="../Home_user.php">Home</a></li>
                    <?php
                    $idcar = $_GET["val1"];

                    echo'  <li class="nav-item"><a class="nav-link" href="type_product/type_product.php?val1=' . $idcar.'">Type Product</a></li>';



                    ?>

                </ul>

                <div class="header-icons" style="margin-right: 60px">


                </div>


                <a class="nav-link" href="#">Logout <i class="ri-expand-left-line"></i>

                </a>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <?php
    $select_pro = $database->prepare("select * from type_product2");
    $result=$select_pro->execute();
    if($select_pro->rowCount()==0){
        echo "null";
    }
    else{
        $count=0;
        $newrow=true;
        while($fetch_product2=$select_pro->fetch(PDO::FETCH_ASSOC)){

            ?>

            <?php
            if($newrow){
                $newrow=false;
                echo ' <div class="row gy-lg-3">';
            }

            echo' <div class="col-lg-4">
     <a href="../product2.php?idpro=' . $fetch_product2['ID'].'&idcar='.$idcar.'"><div class="card bg-dark text-white card-type-car">
        <img src="../images/kia/'.$fetch_product2['image'].'" class="card-img" alt="..." height="270px">
        <div class="card-img-overlay text-center card-text ">
          <div class="tt">
            <h5 class="">'.$fetch_product2['name'].'</h5>
          </div>
        </div>
      </div></a>
    </div>';

            $count++;
            if($count==3){
                echo '</div>';
                $newrow=true;
                $count=0;
            }
            ?>
            <?php

        };
    };

    ?>

    <!--END -->
</div>

</body>
</html>