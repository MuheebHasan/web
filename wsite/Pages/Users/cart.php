<?php
session_start();
$username = "root";
$pass = "";
$db = "localhost";
$dbn = "car_spare (3)";
$id_user=$_SESSION['id'];
$database = new mysqli($db, $username, $pass, $dbn);
global  $database;
global $cart_num;
if (isset($_GET['id'])) {
    $idpro = $_GET['id'];
    $sql = "Select * from test where pid =$idpro  and id_user=$id_user";
    $result = $database->query($sql);
    $total_cart = "Select * from test where id_user=$id_user";
    $total_cart_result = $database->query($total_cart);
    $cart_num = mysqli_num_rows($total_cart_result);

    if (mysqli_num_rows($result) > 0) {
        $in_cart = "already in cart";

        echo $z=json_encode(["num cart" =>$cart_num,"in_cart" => $in_cart]);

    }
    else {
        $insert_to_cart = "INSERT INTO test(pid,id_user) VALUES ($idpro,$id_user)";
        if ($database->query($insert_to_cart) === true) {
            $in_cart = "added into cart";
            echo json_encode(["num cart" => $cart_num, "in_cart" => $in_cart]);

        }
        else {
            echo "<script>alert('It doesnt insert');</script>";
        }
    }

}

$sql_cart="select * from test where id_user=$id_user ";
$all_cart=$database->query($sql_cart);
?>
