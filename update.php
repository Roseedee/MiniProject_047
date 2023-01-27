<?php
    include("connection.php");
    $redirect = 'index.php';
    if(isset($_GET['form'])) {
        $from = $_GET['form'];
        if($from == 'customer') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            
            $sql = "update customer set c_name='$name', c_address='$address', c_tel='$tel' where c_id=$id;";
            
            if($con->query($sql)) {
                $redirect = 'index.php';
            }else {
                echo "Insert Data Failed : ". $connection->error;
                $redirect = 'index.php';
            }
        }else if($from == 'product') {
            $id = $_POST['id'];
            $pname = $_POST['pname'];
            $pcostprice = $_POST['pcostprice'];
            $pprice = $_POST['pprice'];
            $ptype = $_POST['ptype'];
            $pstate = $_POST['pstate'];
            
            $sql = "update product set p_name='$pname', p_cost_price='$pcostprice', p_price='$pprice', pdt_id='$ptype', pdst_id='$pstate' where p_id=$id;";
            
            if($con->query($sql) == true) {
                $redirect = 'product.php';
            }else {
                echo "Insert Data Failed : ". $connection->error;
                $redirect = 'product.php';
            }
        }else if($from == 'product_type') {
            $id = $_POST['id'];
            $ptype = $_POST['ptype'];
            
            $sql = "update product_type set pdt_name='$ptype' where pdt_id=$id;";
            
            if($con->query($sql) == true) {
                $redirect = 'product-type.php';
            }else {
                echo "Insert Data Failed : ". $connection->error;
                $redirect = 'product-type.php';
            }
        }else if($from == 'employee') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            
            $sql = "update employee set e_name='$name', e_address='$address', e_tel='$tel' where e_id=$id;";
            
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