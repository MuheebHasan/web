<?php

session_start();
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$con = mysqli_connect($db,$username,$pass,$dbn);


if($con)
{
    echo "sucsessful";

}
else
{
    echo "not";
}
$res="";$res1="";
$flag=false;

$username="";$password="";$stmt="";
if (isset($_POST['btn_login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="select * from users where username='$username' OR email='$username' AND password='$password' ";
    $res=mysqli_query($con,$query);
    $row=mysqli_fetch_array($res);
    if(@$row["type_users"]=="user"){
        $id= $row["id"];
        $_SESSION['id']=$id;
        $iid='hello';


        header("Location:Home_User.php"); // redirect to home page

    }
    else if(@$row["type_users"]=="admin"){
        header("Location:../../Pages/Admin/orderd.php"); // redirect to home page
    }
    else{
        $error = "Invalid username or password";
        echo $error;
    }
}



