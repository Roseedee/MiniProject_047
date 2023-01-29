<?php 
    session_start();
    if(!isset($_SESSION['login-state'])) {
        header('location: form_login.php');
    }
    include('connection.php');

    $c_id = $_POST['customer-id'];
    $e_id = $_POST['employee-id'];  
            
    $sql = "insert into receipt values (NULL, '$c_id', '$e_id', NULL, NULL);";
    $con->query($sql);

    $r_id = $con->insert_id;
    $_SESSION['r_id_last'] = $r_id;
    header('location: form_product.php?r_id='.$r_id.'')
?>
