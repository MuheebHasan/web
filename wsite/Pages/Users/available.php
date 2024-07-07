<?php
$id = $_GET["id"];
$id_car = $_GET["id_car"];
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
    <link rel="stylesheet" href="../../CSS/User/viewpro.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="../../CSS/admin/popup.css">
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


                    <li class="nav-item"><a class="nav-link" href="Home_User.php">Home</a></li>
                    <?php
                    echo'  <li class="nav-item"><a class="nav-link" href="Type_Product/product.php?val1='.$id_car.'">Type Product</a></li>';



                    ?>
                </ul>

                <div class="header-icons" style="margin-right: 60px">
                    <div class="header-cart style-1 js-cart-icon-container">
                        <a href="cart2.php"  class="cart-icon">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>

                        </a>
                        <div class="cart-label">
                            <span>Shopping Cart</span>
                        </div>

                    </div>

                </div>


                <a class="nav-link" href="#">Logout <i class="ri-expand-left-line"></i>

                </a>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <h2 class="text-center" style="margin-top: 3%">Available products </h2>
    <section style="id="sec">
    <?php
    $select_pro = $database->prepare("select * from product where id_car='$id_car' AND id_type='$id'");
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
            echo '<div class="container c ">
        <div class="row justify-content-center mb-3">
            <div class="col-md-12 col-xl-10">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                  <!--image -->
                                    <img src="images/mar/'.$fetch_product['image'].'"
                                         class="w-100 image" />

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <!-- title -->
                               <h5 class="card-title">'.$fetch_product['name'].'</h5>
                                <p class="   mb-4 mb-md-0">'.$fetch_product['details'].'</p>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                <div class="d-flex flex-row align-items-center mb-1">
                                    <h4 class="mb-1 me-1">'.$fetch_product['price'].'$</h4>
                                </div>
                                 <div class="d-flex flex-row align-items-center mb-1">
                                <p class="count_pro"> Count is Available :  '.$fetch_product['count'].'</p>
                                </div>
                    
                                <div class="d-flex flex-column mt-4">
                                
                                <input type="hidden" id="id" name="id" value="'.$fetch_product['id'].'">
                                    <button class="btn btn-primary btn-sm details" value="'.$fetch_product['id'].'"name="details" id="details" type="button">Details</button>
                                    <button class="add btn btn-outline-primary btn-sm mt-2" data-id="'.$fetch_product["id"].'"  >
                Add to Cart
            </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>';


            $count++;
            if($count==1){
                echo '</div>';

                $newrow=true;
                $count=0;
            }
            ?>

            <?php

        }
    }

    ?>

    </section>
    <script>
        var product_id=document.getElementsByClassName("add");
        for( var i = 0; i<product_id.length;i++) {
            product_id[i].addEventListener("click", function (event) {
                var target = event.target;
                var id = target.getAttribute("data-id");
                var xml=new XMLHttpRequest();
                xml.onreadystatechange=function (){
                    if(this.readyState==4 && this.status==200){
                        var data=JSON.parse(this.responseText);
                        target.innerHTML=data.in_cart;

                    }
                };

                xml.open("GET","cart.php?id="+id,true);
                xml.send();


            });
        }
    </script>
    </form>
</div>

<div class="modal popup" id="detailmodal" style="height:85% ; ">

    <div class="col-lg-12 col-sm-12">
        <div class="card-body h-100">
            <div class="product">
                <form method="GET" enctype="multipart/form-data">

                    <div class="items">

                        <h3 class="text-center">Details Product</h3>
                        <div class="card-body">
                            <div class="modal-body">

                            </div>
                            <button type="button" class="btn btn-primary " style="margin-left: 85%;margin-top:5% " name="cancel" data-bs-toggle="modal" onclick="clo()" >cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>


<script>

    function clo() {
        document.getElementById('detailmodal').style.display='none';

    }
</script>
<script>
    $(document).ready(function (){
        $(document).on('click','.details',function (){
            var pro_id=$(this).val();
            $.ajax({
                method:"POST",
                url: "details.php",
                data:{id_pro:pro_id},
                success:function (result){
                    $(".modal-body").html(result);
                }
            });
            $('#detailmodal').show();



        });
    });

</script>

</body>
</html>