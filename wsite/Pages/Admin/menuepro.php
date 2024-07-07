<?php

$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$database= new PDO("mysql:host=localhost; dbname=car_spare (3);",$username,$pass);
//$con = mysqli_connect($db,$username,$pass,$dbn);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_pro'])) {
        $name_pro = $_POST['name_product'];
        $price = $_POST['price'];
        $count = $_POST['count'];
        $desc = $_POST['desc'];
        $img = $_FILES['image'];
        $typecar = $_POST['type-car'];
        $typepro = $_POST['type-pro'];
        $tt_car = $database->prepare("select id from car where namecar='$typecar'");
        $tt_car->execute();
        $tt_car = $tt_car->fetchObject();
        $id_car = $tt_car->id;

        $tt_pr = $database->prepare("select id from type_product where nametype='$typepro'");
      $tt_pr->execute();
       $tt_pr = $tt_pr->fetchObject();
        $id_type = $tt_pr->id;

        $folder = "../../Users/images/mar";
        $image_file = $_FILES['image']['name'];
        $file = $_FILES['image']['tmp_name'];
        $path = $folder . $image_file;
        $target_file = $folder . basename($image_file);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//Allow only JPG, JPEG, PNG & GIF etc formats1
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
        }
//Set image upload size
        if ($_FILES["image"]["size"] > 1048576) {
            $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
        }

        ////$id_type','
        if (!isset($error)) {
            // echo $tt_car;
            move_uploaded_file($file, $target_file);
            $add_prod = $database->prepare("insert into product(name,details,count,id_car,id_type,price,image) VALUES('$name_pro','$desc','$count','$id_car','$id_type','$price','$image_file')");
            $add_prod->execute();
        }

    }
    if (isset($error)) {

        foreach ($error as $error) {
            echo '<div class="message">' . $error . '</div><br>';
        }
    }
    header('location:menuepro.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Menue product</title>
    <!-- CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/admin/popup.css">
    <!-- JavaScript links (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../CSS/admin/product.css">
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

                </ul>
                <input type="button" class="btn nav-item" style="justify-content: end"><a class="nav-link" href="../../Pages/sign/login.html">Logout <i class="ri-expand-left-line"></i>
                </a>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <form  method="POST" enctype="multipart/form-data">
        <div class="add-product">
            <div class="form-add">
                <h2>Add Product</h2>
                <div class="input-pro">
                    <input type="text" placeholder="name-product" name="name_product">
                    <input type="number" min="0" placeholder="Price" name="price">
                    <input type="number" min="1" placeholder="count" name="count">
                    <input type="text" placeholder="description" name="desc">
                    <input type="file" name="image" >
                    <select name="type-car" id="pro-cars"  >
                        <option hidden >select type car</option>
                        <option value="Kia" >Kia</option>
                        <option >Bmw</option>
                        <option>Mercedes</option>
                        <option >Audi</option>
                        <option >mitsubishi</option>
                        <option >hyundai</option>
                    </select>
                    <select name="type-pro" id="pro-type"  >
                        <option hidden >select type product</option>
                        <option >Mercedes-Benz GLE 53 AMG</option>
                        <option >Transmission and drivetrain parts</option>

                    </select>
                    <div class="row container-fluid">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <button  name="add_pro" >add product</button>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <div class="container-fluid search">
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4 title">
                <h3>Search product</h3>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-6 name-pro">
                <label >name product</label>
            </div>
            <div class="col-lg-4 col-sm-6 name-search">
                <h3><input id="search" type="text" placeholder="Name product" ></h3>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="card_data">

        <?php
        $select_pro = $database->prepare("select * from product");
        $result=$select_pro->execute();
        if($select_pro->rowCount()==0){
            echo '<h2 class="text-center" >No Product Found!</h2>';
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
                <div class="card-body h-100" >
                    <div class="product">
                    <form method="GET">
                        <div class="items">
                             
                             
                             <img src="../Users/images/mar/'.$fetch_product['image'].'" class="card-img-top" style="height:376px;">
                             
                            <div class="card-body">
                            
                                <h5 class="card-title text-center text-capitalize">'.$fetch_product['name'].'</h5>
                                <p class="card-text" name="c" style="overflow: scroll; overflow-x: visible; height: 100px">'.$fetch_product['details'].'</p>
                            
                                <p class="price-pro"> Price :<input  type="text" readonly value="'.$fetch_product['price']."$".'" style="border: none"/></p>
                                <p class="count-pro" >count : '.$fetch_product['count'].'</p>
                                <input type="hidden"  name="id_pro[]" value="'.$fetch_product['id'].'"/>
                                <button type="button" value="'.$fetch_product['id'].'" class="btn btn-primary editbtn" name="Update"  >Update</button>
                                <button class="btn btn-primary"  name="delete_product" data-bs-toggle="modal"  >Delete</button>
                            </div>
                        </div>
                           </form>

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
                <!--<div class="row gy-lg-3">-->





                <?php

            }
        }

        ?>
    </div>

    <?php
    global $database;
    if(isset($_GET['delete_product'])){
        foreach ($_GET['id_pro'] as $remove_id){


            $select_prod="Select * FROM `order_items` WHERE product_id='$remove_id'";
            $sq=$database->query($select_prod);
            $row=$sq->fetch(PDO::FETCH_ASSOC);

            if($row){
                echo '<script>alert("the product exist in order")</script>';
            }
            else{
                $delete_query="DELETE FROM `product` WHERE id='$remove_id'";
                $run_delete=$database->prepare($delete_query);
                $result=$run_delete->execute();
            }

            if($result){
                echo"<script>window.open('menuepro.php','_self')</script>";
            }

        }

    }
    ?>

    <div class="modal popup" id="editmodal" style="height:90% ; overflow:scroll ">
        <div class="col-lg-12 col-sm-12">
            <div class="card-body h-100">
                <div class="product">
                    <form method="GET" enctype="multipart/form-data">
                        <div class="items">
                            <h3 class="text-center">UPDATE PRODUCT</h3>
                            <div class="card-body">
                                <div class="modal-body">

                                </div>
                                <button  class="btn btn-primary" type="submit" data-bs-toggle="modal" name="Update_p" style="margin-left: 5%">Update</button>
                                <button class="btn btn-primary justify-content-center" name="cancel" data-bs-toggle="modal" onclick="" >cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function (){
            $(document).on('click','.editbtn',function (){
                var pro_id=$(this).val();
                $.ajax({
                    method:"POST",
                    url: "test.php",
                    data:{id_pro:pro_id},
                    success:function (result){
                        $(".modal-body").html(result);
                    }
                });
                //alert(pro_id);
                $('#editmodal').show();



            });
        });

    </script>



    <?php
    if (isset($_GET['Update_p'])){

        $names=$_GET['pro'];
        $desc=$_GET['desc_pro'];
        $price=$_GET['price_pro'];
        $count=$_GET['count_pro'];
        $id=$_GET['id_pro'];
        $image=$_GET['image'];
        $img=$_GET['img'];

        print_r($img);
        if($image==""){
            $sql = "UPDATE `product` SET `name`='$names',`details`='$desc',`count`='$count',`price`='$price',`image`='$img' WHERE id='$id'";
            $qu = $database->query($sql);
            if ($qu) {
                echo "<script>window.open('menuepro.php','_self')</script>";
            } else {
                echo "<script>alert(The operation did not complete successfully)</script>";
            }

        }
        else {
            $sql = "UPDATE `product` SET `name`='$names',`details`='$desc',`count`='$count',`price`='$price',`image`='$image' WHERE id='$id'";
            $qu = $database->query($sql);
            if ($qu) {
                echo "<script>window.open('menuepro.php','_self')</script>";
            } else {
                echo "<script>alert(The operation did not complete successfully)</script>";
            }
        }



    }



    ?>



    <script type="text/javascript">
        $(document).ready(function (){
                $("#search").keyup(function (){
                    var search=$(this).val();
                    $.ajax(
                        {
                            url:'action.php',
                            method:'POST',
                            data:{query:search},
                            success:function(response){
                                $('#card_data').html(response);
                            }
                        }
                    )
                })
            }
        );

    </script>
    <!--js link --->
    <script type="text/javascript" src="../../js/admin/scriptsd.js"></script>




</body>
</html>