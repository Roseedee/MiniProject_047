<?php 
    session_start();
    if(!isset($_SESSION['login-state'])) {
        header('location: form_login.php');
    }
    include('connection.php');
    $r_id = $_GET['r_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="CreateReceiption.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3 align-items-center">
        <ul class="nav nav-tabs d-flex justify-content-between">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product-type.php">Product Type</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="sales.php">Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>
            <a href="logout.php" role="button" class="btn btn-secondary float-end">Logout</a>
        </ul>
        <div class="container mt-5">
            <a href="form_product.php?r_id=<?php echo $r_id ?>" role="button" class="btn btn-secondary mb-3">Back</a>
        </div>
        <ul class="list-group">
            <?php
                $sql = "Select concat(product.p_name, ' Price : ', product.p_price, ' Bath Quantity : ', product_sales.p_num) as detials from product_sales join product on product.p_id=product_sales.p_id where product_sales.r_id=".$r_id . " group by product.p_name";
                $result = $con->query($sql);
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item">'.$row['detials'].'</li>';
                    }
                }
            ?>
            <li class="list-group-item"></li>
        </ul>
    </div>
</body>
</html>

