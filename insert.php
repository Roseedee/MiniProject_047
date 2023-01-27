<?php
    session_start();
    include("connection.php");
    $redirect = 'index.php';
    if(isset($_GET['form'])) {
        $from = $_GET['form'];
        if($from == 'customer') {
            $fname = $_POST['name'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            
            $sql = "insert into customer values (NULL, '$fname', '$address', '$tel');";
            
            if($con->query($sql)) {
                $redirect = 'index.php';
            }else {
                echo "Insert Data Failed : ". $connection->error;
                $redirect = 'index.php';
            }
        }else if($from == 'product') {
            $p_name = $_POST['pname'];
            $p_cost = $_POST['pcostprice'];
            $p_sell = $_POST['pprice'];
            $p_type = $_POST['ptype'];
            $p_state = $_POST['pstate'];
            
            $sql = "insert into product values (NULL, '$p_name', '$p_cost', '$p_sell', '$p_type', '$p_state');";
            
            if($con->query($sql)) {
                $redirect = 'product.php';
            }else {
                $_SESSION['error'] = $con->error;
                $redirect = 'product.php';
            }
        }else if($from == 'product_type') {
            $pdt_name = $_POST['ptype'];
            
            $sql = "insert into product_type values (NULL, '$pdt_name');";
            
            if($con->query($sql)) {
                $redirect = 'product-type.php';
            }else {
                $_SESSION['error'] = $con->error;
                $redirect = 'product-type.php';
            }
        }else if($from == 'employee') {
            $fname = $_POST['name'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            
            $sql = "insert into employee values (NULL, '$fname', '$address', '$tel');";
            
            if($con->query($sql)) {
                $redirect = 'employee.php';
            }else {
                echo "Insert Data Failed : ". $connection->error;
                $redirect = 'employee.php';
            }
        }
    }
    
    header("location:".$redirect);
?>