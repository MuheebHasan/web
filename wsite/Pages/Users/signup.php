<?php

$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$con = mysqli_connect($db,$username,$pass,$dbn);
if($con)
{
    echo "sucssesful";

}
else
{
    echo "not";
}
if (isset($_POST['btn_signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $cpassword = $_POST['con_password'];
    $query="select * from users where username='$username' OR email='$email' ";
    $res=mysqli_query($con,$query);
    header("Location:../Sign/login.html"); // redirect to home page

    if(mysqli_num_rows($res)>0){
        echo "username or email are exist";

    }
    else if($password!=$cpassword){
        echo "password are not same";
    }
    else{
        $query1 = "insert into users(username,email,password) VALUES('$username','$email','$password') ";
        $res1 = mysqli_query($con, $query1);
    }
}
