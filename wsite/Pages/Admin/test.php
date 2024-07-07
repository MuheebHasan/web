<?php
$output="";
$username ="root";
$pass ="";
$db="localhost";
$dbn="car_spare (3)";
$conn=new mysqli($db,$username,$pass,$dbn);
?>
    <html>
    <body>






    <?php
    if(isset($_POST['id_pro'])){

        $query="Select * from product where id='".$_POST['id_pro']."'";
        $result=mysqli_query($conn,$query);

        ?>

        <?php
        while($row=mysqli_fetch_assoc($result)){

            ?>
            <image   id="pro_id" src="../../Pages/Users/images/mar/<?php echo $row["image"] ?>"  style="width:20% "  />
            <input name="img" type="hidden" value="<?php echo $row["image"] ?>"/>
            <br>
            <input type="file" id="image" name="image" />

            <h3>name</h3>
            <h5 class="card-title text-capitalize"><input type="text" id="name_pro" name="pro"  value="<?php echo $row["name"] ?>"/></h5>

            <h3>Description</h3>
            <p class="card-text"><textarea id="desc_pro" name="desc_pro" ><?php echo $row["details"] ?></textarea></p>
            <h3>Price</h3>
            <p class="price-pro"><input id="price_pro"  type="text" name="price_pro"  value="<?php echo $row["price"] ?>" /></p>
            <h3>Count</h3>
            <p class="count-pro"><input id="count_pro" type="text" value="<?php echo $row["count"] ?>" name="count_pro"></p>
            <input type="hidden" name="id_pro" value="<?php echo $_POST['id_pro'] ?> ">



            <?php






        }


    }




    ?>
    </body>
    </html>
<?php

