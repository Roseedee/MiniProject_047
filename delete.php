<?php
    include('connection.php');
    $id = $_GET['id'];
    $from = 'customer';
    $redirect = 'index.php';
    if(isset($_GET['form'])) {
        $from = $_GET['form'];
        if($from == 'customer') {
            $sql = "delete from customer where c_id='$id'";
            $redirect = 'index.php';
        }else if ($from == 'product') {
            $sql = "delete from product where p_id='$id'";
            $redirect = 'product.php';
        }else if ($from == 'product_type') {
            $sql = "delete from product_type where pdt_id='$id'";
            $redirect = 'product-type.php';
        }else if ($from == 'employee') {
            $sql = "delete from employee where e_id='$id'";
            $redirect = 'employee.php';
        }else if ($from == 'receipt') {
            $sql = "delete from receipt where r_id='$id'";
            $redirect = 'sales.php';
        }

        $con->query($sql);
    }
    header('location: '.$redirect);
?>