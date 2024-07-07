<?php
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$conn=new mysqli($db,$username,$pass,$dbn);
session_start();
$id_user=$_SESSION['id'];
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../CSS/User/Cart.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../CSS/User/cardit.css"/>
    <!---->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


</head>
<body onload="subTotal()">
<header>
    <form method="GET">
        </form>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">logo</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="Home_User.php">Home</a></li>
                </ul>
                <div class="header-icons" style="margin-right: 60px">
                </div>
            </div>
        </div>
    </nav>
</header>
<section class="h-100 h-custom">
    <div class="container h-100 py-5" style="background-color: #ffffff">
        <div class="row col-lg-12  px-5 py-4 d-flex justify-content-center align-items-center h-100">
            <form method="POST"  >
                <div class="col ">
                    <div class="card shopping-cart" style="border-radius: 15px;">
                        <div class="card-body text-black">

                            <div class="row">
                                <div class="col-lg-12 px-5 py-4">

                                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your Order Product</h3>
                                    <?php
                                    $sql="Select * from orders where user_id='$id_user'";
                                    $stmt=$conn->prepare($sql);
                                    $stmt->execute();
                                    $result=$stmt->get_result();
                                    if($result->num_rows>0) {
                                        $count=0;
                                        $newrow=true;
                                        while($fetch_product=mysqli_fetch_assoc($result)) {

                                            if ($newrow) {
                                                $newrow = false;
                                                echo '<div class="row">';
                                            }
                                            $orderid=$fetch_product['id'];
                                            $sqlitem = "SELECT t2.name, t1.price,t2.image,t1.quantity,t2.details
                                FROM order_items AS t1 
                                 JOIN product AS t2 ON t1.product_id = t2.id 
                                 JOIN orders AS t3 ON t1.order_id = t3.id
                                WHERE t1.order_id = '$orderid'";

                                            $resnp = $conn->query($sqlitem);
                                            while($res=mysqli_fetch_assoc($resnp)) {

                                                ?>
                                                <div class="d-flex align-items-center mb-5">
                                                    <div class="flex-shrink-0">
                                                        <img src="images/mar/<?php echo $res["image"] ?>"
                                                             class="img-fluid" style="width: 150px;" alt="Generic placeholder image">
                                                    </div>


                                                    <?php


                                                    ?>




                                                    <div class="flex-grow-1 ms-3">


                                                        <h5 class="text-primary"><?php echo $res["name"] ?></h5>
                                                        <h6> <?php echo $res["details"] ?></h6>

                                                        <div class="">
                                                            <?php echo'<label for="price">item price  : </label> <input class="fw-bold  iprice" value="'.$res["price"].'" name="price" id="price" style="margin-left: 7px ; width: 7%"/><span class="me-5 pe-3 ">$</span>';




                                                            echo'
                                                            <label style="margin-left: 20%">Count :</label>
                                                            <input class="fw-bold iquantity" readonly type="text" value="'.$res["quantity"].'" />
                                                            


';
                                                            ?>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="margin-top: 7px">
                                                            <label>total price :</label><p class="fw-bold mb-0 itotal" style="margin-left: 7px"></p><span class="me-5 pe-3 ">$</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                //<input readonly type="" value="'. $fetch_product["status"].'"/>
                                                $count++;
                                            }  echo'  <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">
                                            <div>
                                                    <p> Order id :  <span><input  readonly id="payment" name="order_id[]" value="'.$orderid.'" style="border: none;"/></span></p>

                                            <label>Status :<select name="Status" id="pro-cars"  >
                                            <option selected hidden >'.$fetch_product['status'].'</option>
                        <option value="Pending" >Pending</option>
                        <option value="Delivered">Delivered</option>
                                               <option value="else">else</option>
                    </select>
                     </label>
<button style="background-color: #b44593" name="done">done</button>
                                        </div>
                                        <h5 class="fw-bold mb-0  " style="margin-top: 0" name="tt">Total:</h5>
                                        <div>
                                            <input class="fw-bold align-content-end text-end mb-0 totalp" id="total" name="total" readonly value="'.$fetch_product["total_price"].'" style="margin-right: 3px;background-color: #e1f5fe;" ><span class="black-text fw-bold">$</span>
                                        </div>


                                    </div>
 <hr class="col-lg-12" style="height: 2px; background-color: #1266f1; opacity: 1;">  ';
                                        }

                                    }
                                    if(isset($_POST['done'])) {
                                        $status = $_POST['Status'];
                                        foreach ($_POST['order_id'] as $update) {
                                            $update_query = "UPDATE `orders` SET `status`='$status' WHERE id=$update";
                                            $run_update = $conn->prepare($update_query);
                                            $up = $run_update->execute();
                                            echo"<script>window.open('Orders.php','_self')</script>";

                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</section>
<script>
    var iprice=document.getElementsByClassName('iprice');
    var iquantity=document.getElementsByClassName('iquantity');
    var itotal=document.getElementsByClassName('itotal');
    var totalp=document.getElementsByClassName('totalp');
    function subTotal(){
        var sum=0;
        for (var i=0;i<iprice.length;i++){

            var p=(iprice[i].value);
            var q=(iquantity[i].value)
            var result=p*q;
            var rc= document.getElementsByClassName('itotal')[i].innerHTML=result;
            sum+=rc;
        }
        document.getElementById('total').value=sum;
    }
    subTotal();
</script>
</body>
</html>