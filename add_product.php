<?php
    include("connection.php");
    session_start();
    $r_id = $_SESSION['r_id_last']; 
    $p_id = $_GET['p_id'];
    $checkproduct = "Select * from product_sales where r_id='$r_id' and p_id='$p_id'";
    $result = $con->query($checkproduct);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $p_num = $row['p_num'] + 1;
            $update = "update product_sales set p_num='$p_num' where r_id='$r_id' and p_id='$p_id'";
            $con->query($update);
        }
    }else {
        $sql = "insert into product_sales values ('$r_id', '$p_id', 1)";
        $con->query($sql);
    }
    header("location: form_product.php?r_id=$r_id");
?>