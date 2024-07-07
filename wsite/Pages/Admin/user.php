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
    <title>User</title>
    <link rel="stylesheet" href="../../CSS/admin/USER.css">
    <!-- CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

    <!-- JavaScript links (jQuery and Popper.js are required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

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
                <input type="button" class="btn nav-item" style="justify-content: end"><a class="nav-link" href="../../Pages/sign/login.html">Logout<i class="ri-expand-left-line"></i></a>
            </div>

        </div>
    </nav>
</header>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="title">
                <h2>User </h2>
            </div>

        </div>
    </div>

    <?php
    $select_pro = $database->prepare("select * from users");
    $result=$select_pro->execute();
    if($select_pro->rowCount()==0){
        echo "<h2 class='text-center'>not found any users</h2>";
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

            echo'<div class="col-lg-4 col-sm-12">
            <div class="card">
            <form method="POST">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">user id : <label  id="user_id"  >'.$fetch_product['id'].'</label><input name="user_id[]" type="hidden" value="'.$fetch_product['id'].'"/></li>
                    
                    <li class="list-group-item">User name : <label id="username">'.$fetch_product['username'].' </label></li>
                    <li class="list-group-item">Email : <label id ="Email"> '.$fetch_product['email'].'</label></li>
                    <li class="list-group-item">type user : <label id ="type_user"> '.$fetch_product['type_users'].'</label></li>
                    <li class="list-group-item  btn_list" ><button class="btn btn-primary" name="delete_prod"> Delete</button></li>
                </ul>
                </form>
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
<?php
global $database;
if(isset($_POST['delete_prod'])){
    foreach ($_POST['user_id'] as $remove_id){
        $delete_query="DELETE FROM `users` WHERE id='$remove_id'";
        $run_delete=$database->prepare($delete_query);
        $result=$run_delete->execute();
        if($result){
            echo"<script>window.open('user.php','_self')</script>";
        }

    }

}

?>
</body>
</html>
