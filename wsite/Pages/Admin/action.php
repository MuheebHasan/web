<?php
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$conn=new mysqli($db,$username,$pass,$dbn);
$output='';

if (isset($_POST['query'])){
    $search=$_POST['query'];

    $stmt = $conn->prepare("select * from product where name like Concat('%',?,'%') ");
    $stmt->bind_param('s',$search);
}
else{
    $stmt = $conn->prepare("select * from product ");
}
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows>0){
    $count=0;
    $newrow=true;
    while($fetch_product=mysqli_fetch_assoc($result)){

        ?>

        <?php
        if($newrow){
            $newrow=false;
            echo '<div class="row gy-lg-3">';


        }

        echo' <div class="col-lg-4 col-sm-12">
                <div class="card-body h-100" id="card_data">
                    <div class="product">
                    <form method="GET" >
                        <div class="items">
                             
                             
                             <img src="../../Pages/Users/images/'.$fetch_product['image'].'" class="card-img-top" style="height:376px;">
                             

                            <div class="card-body">
                            
                                <h5 class="card-title text-center text-capitalize">'.$fetch_product['name'].'</h5>
                                <p class="card-text" name="c" style="overflow: scroll;overflow-x: visible; height: 100px">'.$fetch_product['details'].'</p>
                            
                                <p class="price-pro"> Price :<input  type="text" readonly value="'.$fetch_product['price']."$".'" style="border: none"/></p>
                                <p class="count-pro" >count : '.$fetch_product['count'].'</p>
                                <input type="hidden" name="id_pro[]" value="'.$fetch_product['id'].'"/>
                                <button type="button" value="'.$fetch_product['id'].'" class="btn btn-primary editbtn" name="Update"  >Update</button>
                                <button class="btn btn-primary" name="delete_product" data-bs-toggle="modal"  >Delete</button>
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

    }
    ?>

    <?php
}

else{
    echo '<h2 class="text-center" >No Product Found!</h2>';
}


if (isset($_GET['delete_product'])) {
    foreach ($_GET['id_pro'] as $remove_id) {


        $select_prod = "Select * FROM `order_items` WHERE product_id='$remove_id'";
        $sq = $conn->query($select_prod);
        $row = $sq->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo '<script>alert("the product exist in order")</script>';
        } else {
            $delete_query = "DELETE FROM `product` WHERE id='$remove_id'";
            $run_delete = $conn->prepare($delete_query);
            $result = $run_delete->execute();
        }

        if ($result) {
            echo "<script>window.open('menuepro.php','_self')</script>";
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
        $qu = $conn->query($sql);
        if ($qu) {
            echo "<script>window.open('menuepro.php','_self')</script>";
        } else {
            echo "<script>alert(The operation did not complete successfully)</script>";
        }

    }
    else {
        $sql = "UPDATE `product` SET `name`='$names',`details`='$desc',`count`='$count',`price`='$price',`image`='$image' WHERE id='$id'";
        $qu = $conn->query($sql);
        if ($qu) {
            echo "<script>window.open('menuepro.php','_self')</script>";
        } else {
            echo "<script>alert(The operation did not complete successfully)</script>";
        }
    }



}



?>
