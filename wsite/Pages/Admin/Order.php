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
    <!-- CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

    <!-- JavaScript links (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../CSS/admin/orders.css">
    <meta charset="UTF-8">
    <title>Users</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="dashboard.php">logo</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="orderd.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menuepro.php">product</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="order.php">Order</a></li>
                    <li class="nav-item"><a class="nav-link" href="user.php">Users</a></li>

                </ul>
                <input type="button" class="btn nav-item" style="justify-content: end"/><a class="nav-link" href="../../Pages/Sign/login.html">Logout <i class="ri-expand-left-line"></i></a>

            </div>
        </div>
        </div>
    </nav>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4"> </div>
        <div class="col-lg-4 title"><h2>Placed Order</h2></div>
        <div class="col-lg-4"> </div>
    </div>
</div>
<div class="container">

    <?php
    $sql="Select * from orders";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows>0) {
        $count=0;
        $newrow=true;
        while($fetch_product=mysqli_fetch_assoc($result)){
            if($newrow){
                $newrow=false;
                echo '<div class="row">';
            }

            $sqln="Select username,email from users where id='$fetch_product[user_id]' ";
            $rsqln=$conn->query($sqln);
            $row = mysqli_fetch_assoc($rsqln);
            $usersname=$row['username'];
            $email=$row['email'];
            $orderid=$fetch_product['id'];

            $sqlitem = "SELECT t2.name, t1.price 
            FROM order_items AS t1 
            JOIN product AS t2 ON t1.product_id = t2.id 
            JOIN orders AS t3 ON t1.order_id = t3.id
            WHERE t1.order_id = $orderid";

            $resnp = $conn->query($sqlitem);


            echo '
        
        <div class="col-lg-4 " style="margin-top: 20px;margin-left: 10%" >
            <div class="card h-100 " >
            <form method="GET">
                <p> Order id :  <span><input  readonly id="payment" name="order_id[]" value="'.$orderid.'" style="border: none;"/></span></p>
                <p> User id :  <span><label id="userid">'.$fetch_product['user_id'].'</label></span></p>
                 <p> user name :  <span><label id="name-c">'.$usersname.'</label></span></p>
                <p> email :  <span><label id="email">'.$email.'</label></span></p>
                 <p> number phone :  <span><label id="num-phone">'.$fetch_product['number_phone'].'</label></span></p>
                  <p> address :  <span><label id="address">'.$fetch_product['address'].'</label></span></p>
                <p> placed on : <span><label id="placed-on">'.$fetch_product['order_date'].'</label></span></p>
               
               
               
                <div style="height:72px;  overflow: scroll; overflow-x: visible" >
                <table style="border: solid 1px; width: 100%">
                <tr style="border: solid 1px;">
                 <th style="width: 50%;">Name Product</th>
            <th>price item</th>
            </tr>
                
                ';

            while($np = mysqli_fetch_assoc($resnp)){

                echo'<tr style="border: solid 1px">
            <td>'.$np['name'].'</td>
            <td>'.$np['price'].'</td>
            </tr>
            ';



            }
            echo '</table></div><br>
                <p> total Price :  <span><label id="total-price">'.$fetch_product['total_price'].'</label></span></p>
                
                <select name="status" class="select-orders col-lg-12 col-sm-12" >
                <option selected hidden >'.$fetch_product['status'].'</option>
                    <option >Pending</option>
                    <option>Shipped</option>
                    <option>Delivered</option>
                </select>
                
                
                <div class="row">
                    <div class="col-lg-6" >
                        <button style="margin-left: 0;" name="update_status"  class="Update">Update</button>
                    </div>
                    <div class="col-lg-6">
                        <button name="del_order"  class="delete">Delete</button>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
        
        ';
            $count++;
            if($count==2){
                echo '</div>';
                $newrow=true;
                $count=0;
            }
        }
    }
    else{
        echo '<h2 class="text-center">Not Found Any Orders</h2>';
    }
    ?>

    <?php
    if(isset($_GET['del_order'])){
        foreach ($_GET['order_id'] as $remove_id){
            $delete_query="DELETE FROM `order_items` WHERE order_id='$remove_id'";
            $run_delete=$conn->prepare($delete_query);
            $result=$run_delete->execute();
            $delete_que="DELETE FROM `orders` WHERE id='$remove_id'";
            $run_del=$conn->prepare($delete_que);
            $resul=$run_del->execute();
            echo"<script>window.open('Order.php','_self')</script>";

        }
    }
    if(isset($_GET['update_status'])){
        $status=$_GET['status'];
        foreach ($_GET['order_id'] as $update){
            $update_query="UPDATE `orders` SET `status`='$status' WHERE id=$update";
            $run_update=$conn->prepare($update_query);
            $up=$run_update->execute();
            echo"<script>window.open('Order.php','_self')</script>";

        }
    }
    ?>
</div>
</body>
</html>
