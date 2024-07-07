
<?php

include('cart.php');

?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../CSS/User/cart.css" rel="stylesheet">
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

                    echo'  <li class="nav-item"><a class="nav-link" href="Type_Product/product.php">Type Product</a></li>';
                    ?>

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

                                    <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Your products</h3>
                                    <?php
                                    $count=0;
                                    $i=0;
                                    global $all_cart;
                                    echo'<form method="POST">';
                                    while($row_cart=mysqli_fetch_assoc($all_cart)){
                                        $sql="Select * from product where count > 0 and id='$row_cart[pid]'";
                                        $all_product=$database->query($sql);

                                        while($row=mysqli_fetch_assoc($all_product)){

                                            ?>

                                            <div class="d-flex align-items-center mb-5">

                                                <div class="flex-shrink-0">
                                                    <img src="images/mar/<?php echo $row["image"] ?>"
                                                         class="img-fluid" style="width: 150px;" alt="Generic placeholder image">
                                                </div>
                                                <div class="flex-grow-1 ms-3">

                                                    <div   class="float-end text-black " style="text-decoration: none ">

                                                        <form method="POST" >
                                                            <input type="hidden" name="removeitem[]" value="<?php echo $row['id']?>"/>
                                                            <button  name="btn_delete" >delete</button>
                                                        </form>

                                                    </div>
                                                    <?php
                                                    global $database;
                                                    if(isset($_POST['btn_delete'])){
                                                        foreach ($_POST['removeitem'] as $remove_id){
                                                            $delete_query="DELETE FROM `test` WHERE pid='$remove_id'";
                                                            $run_delete=$database->query($delete_query);
                                                            if($run_delete){
                                                                echo"<script>window.open('cart2.php','_self')</script>";
                                                            }

                                                        }

                                                    }

                                                    ?>


                                                    <h5 class="text-primary"><?php echo $row["name"] ?></h5>
                                                    <h6> <?php echo $row["details"] ?></h6>

                                                    <div class="d-flex align-items-center">
                                                        <?php echo'<label>item price  : </label> <input class="fw-bold mb-0 iprice" value="'. $row["price"].'" name="price'.$i.'" id="price" style="margin-left: 7px"/><span class="me-5 pe-3 ">$</span>';




                                                        echo'<label>Count </label>
                                            <div class="input-group " class="def-number-input number-input safari_only" style=" width:35% ; margin-left: 10px; " >
                                                  <span class="input-group-btn">
                                                      <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="count'.$i.'">
                                                 <span class="glyphicon glyphicon-minus"></span>
                                                </button>
                                                </span>
                                                <input type="text"  name="count'.$i.'"   class="form-control input-number iquantity" onchange="subTotal()" value="1" min="1" max="'.$row['count'].'">
                                                <span class="input-group-btn">
                                               
                                                      <button type="button" class="btn btn-default btn-number" data-type="plus"  data-field="count'.$i.'">
                                                       <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                   </span>
                                            </div>';



                                                        ?>


                                                        <div >

                                                            <script>

                                                                var iprice=document.getElementsByClassName('iprice');
                                                                var iquantity=document.getElementsByClassName('iquantity');
                                                                var itotal=document.getElementsByClassName('itotal');
                                                                var totalp=document.getElementsByClassName('totalp');
                                                                var del=document.getElementsByClassName('delete');

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


                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center" style="margin-top: 7px">
                                                        <label>total price :</label><p class="fw-bold mb-0 itotal" style="margin-left: 7px">  </p><span class="me-5 pe-3 ">$</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php                                $i++;
                                            $count++;
                                        }
                                    }


                                    ?>


                                    <script>
                                        $('.btn-number').click(function(e){
                                            e.preventDefault();

                                            fieldName = $(this).attr('data-field');
                                            type      = $(this).attr('data-type');
                                            var input = $("input[name='"+fieldName+"']");
                                            var currentVal = parseInt(input.val());
                                            if (!isNaN(currentVal)) {
                                                if(type == 'minus') {

                                                    if(currentVal > input.attr('min')) {
                                                        input.val(currentVal - 1).change();
                                                    }
                                                    if(parseInt(input.val()) == input.attr('min')) {
                                                        $(this).attr('disabled', true);
                                                    }

                                                } else if(type == 'plus') {

                                                    if(currentVal < input.attr('max')) {
                                                        input.val(currentVal + 1).change();

                                                    }
                                                    if(parseInt(input.val()) == input.attr('max')) {
                                                        $(this).attr('disabled', true);
                                                    }

                                                }
                                            } else {
                                                input.val(0);
                                            }
                                        });
                                        $('.input-number').focusin(function(){
                                            $(this).data('oldValue', $(this).val());
                                        });
                                        $('.input-number').change(function() {

                                            minValue =  parseInt($(this).attr('min'));
                                            maxValue =  parseInt($(this).attr('max'));
                                            valueCurrent = parseInt($(this).val());

                                            name = $(this).attr('name');
                                            if(valueCurrent >= minValue) {
                                                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                                            } else {
                                                alert('Sorry, the minimum value was reached');
                                                $(this).val($(this).data('oldValue'));
                                            }
                                            if(valueCurrent <= maxValue) {
                                                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                                            } else {
                                                alert('Sorry, the maximum value was reached');
                                                $(this).val($(this).data('oldValue'));
                                            }


                                        });



                                    </script>
                                    <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">


                                    <div class="d-flex justify-content-between p-2 mb-2" style="background-color: #e1f5fe;">

                                        <h5 class="fw-bold mb-0  " style="margin-top: 0" name="tt">Total:</h5>
                                        <div>
                                            <input class="fw-bold align-content-end text-end mb-0 totalp" id="total" name="total" readonly value="" style="margin-right: 3px;background-color: #e1f5fe;" ><span class="black-text fw-bold">$</span>
                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div class="row" style="margin-top: 40px">
                                <hr class="mb-4" style="height: 2px; background-color: #1266f1; opacity: 1;">
                                <h3 class="mb-5 pt-2 text-center fw-bold text-uppercase">Payment</h3>
                                <div class="col-lg-12 px-5 py-4">
                                    <div class="cont" style="background-color: #fff3f3">

                                        <div class="card-container">

                                            <div class="front">
                                                <div class="image">
                                                </div>
                                                <div class="card-number-box">################</div>
                                                <div class="flexbox">
                                                    <div class="box">
                                                        <span>card holder</span>
                                                        <div class="card-holder-name">full name</div>
                                                    </div>
                                                    <div class="box">
                                                        <span>expires</span>
                                                        <div class="expiration">
                                                            <span class="exp-month">mm</span>
                                                            <span class="exp-year">yy</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="back">
                                                <div class="stripe"></div>
                                                <div class="box">
                                                    <span>cvv</span>
                                                    <div class="cvv-box"></div>
                                                </div>
                                            </div>

                                        </div>

                                        <div   id="secf">
                                            <div class="inputBox">
                                                <span>card number</span>
                                                <input name="card_num" type="text" maxlength="16" class="card-number-input">
                                            </div>
                                            <div class="inputBox">
                                                <span>card holder</span>
                                                <input name="card_holder" type="text" class="card-holder-input" maxlength="20">
                                            </div>
                                            <div class="flexbox">
                                                <div class="inputBox">
                                                    <span>expiration mm</span>
                                                    <select name="month" id=" " class="month-input">
                                                        <option value="month" selected disabled>month</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="inputBox">
                                                    <span>expiration yy</span>
                                                    <select name="year" id="" class="year-input">
                                                        <option value="year" selected disabled>year</option>


                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                    </select>
                                                </div>
                                                <div class="inputBox">
                                                    <span>cvv</span>
                                                    <input name="cvv" type="text" maxlength="4" class="cvv-input">
                                                </div>
                                            </div>

                                            <hr class="mb-4" style="color: #32be8f; "></hr>
                                            <div class="inputBox">
                                                <span>Address</span>
                                                <input name="Address" type="text" class="card-holder-input" maxlength="100">
                                            </div>
                                            <div class="inputBox">
                                                <span>Phone number</span>
                                                <input name="phone" type="text" max="13" class="card-holder-input" maxlength="100">
                                            </div>
                                            <button type="submit"  name="sub_order" value="" class="submit-btn">submit</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>
<?php
$username = "root";
$pass = "";
$db = "localhost";
$dbn = "car_spare (3)";
$id_user=$_SESSION['id'];
$database = new mysqli($db, $username, $pass, $dbn);
?>
<?php
$_SESSION['action_completed'] = true;


if(isset($_POST['sub_order'])){
    $address=$_POST['Address'];
    $phone=$_POST['phone'];
    $cart_number=$_POST['card_num'];
    $card_holder=$_POST['card_holder'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    $cvv=$_POST['cvv'];
    $total_cart = "Select * from test where id_user=$id_user";
    $total_cart_result = $database->query($total_cart);
    $total_amount=$_POST['total'];


    if ((mysqli_num_rows($total_cart_result) > 0)&($address!=null)&($phone!=null)&($cart_number!=null)&($card_holder!=null)&($month!='MONTH')&($year!="year")&($cvv!=null)) {

        $sql = "INSERT INTO `orders` (`id`, `user_id`, `number_phone`, `address`, `total_price`) VALUES (NULL, '$id_user', '$phone', '$address', '$total_amount');";
        $insert_query = $database->prepare($sql);
        $insert_query->execute();

        $query = "SELECT max(id)as 'id' FROM orders ";

        $res = $database->query($query);

        if ($res) {
            $row = $res->fetch_assoc();

            $order_id = $row['id'];
            $total_cart = "Select pid from test where id_user='$id_user'";
            $total_cart_result = $database->prepare($total_cart);
            $total_cart_result->execute();
            $result = $total_cart_result->get_result();


            $i = 0;
            $ress="";$sqd="";
            while ($fetch_product = $result->fetch_assoc()) {
                $count = $_POST['count' . $i];
                $price = $_POST['price' . $i];
                $cbw="select count from product where id='$fetch_product[pid]'";

                $cb=$database->prepare($cbw);
                $cb->execute();
                $c=$cb->get_result();
                $ro=$c->fetch_assoc();
                $query = $database->prepare("INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES (NULL,'$order_id', '$fetch_product[pid]', '$count','$price')");
                $query->execute();
                $dif = $ro['count'] - $count;
                $up = "UPDATE `product` SET `count`='$dif' WHERE id='$fetch_product[pid]'";
                $sup = $database->prepare($up);
                $ress = $sup->execute();


                if($ress||$sqd){
                    echo"<script>window.open('cart2.php','_self')</script>";
                }
                $i++;
            }


            echo '<h1 style="margin-left:10px ">Found</h1>';





        }
    }

    else{
        echo '<h1 style="margin-left:10px ">Not Found</h1>';
    }
}

?>

<script>

    document.querySelector('.card-number-input').oninput = () =>{
        document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
    }

    document.querySelector('.card-holder-input').oninput = () =>{
        document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
    }

    document.querySelector('.month-input').oninput = () =>{
        document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
    }

    document.querySelector('.year-input').oninput = () =>{
        document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
    }

    document.querySelector('.cvv-input').onmouseenter = () =>{
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
    }

    document.querySelector('.cvv-input').onmouseleave = () =>{
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
    }

    document.querySelector('.cvv-input').oninput = () =>{
        document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
    }

</script>
</body>
</html>
