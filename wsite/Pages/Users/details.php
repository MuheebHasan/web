<?php
$username = "root";
$pass = "";
$db = "localhost";
$dbn = "car_spare (3)";
$conn = new mysqli($db, $username, $pass, $dbn);
?>

<html>
<head>

</head>
<body>
<div class="modal-body">
    <?php
    if(isset($_POST['id_pro'])) {

        $query = "Select * from product where id='" . $_POST['id_pro'] . "'";
        $result = mysqli_query($conn, $query);
        while($row=mysqli_fetch_assoc($result)){
            echo'<row>
                <div class="col-lg-12 text-center">
              </div>
              </row>   
              <row>
              <h3>Description</h3>
              <hr style="background: #3b71ca ;!important;" >
              <p style="overflow: scroll ; overflow-x: visible; height: 120px;font-style: italic; "  >'.$row["details"].'</p>
</row>      
        
        ';

        }

    }
    ?>



</div>
</body>

</html>
