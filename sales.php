<?php 
    session_start();
    if(!isset($_SESSION['login-state'])) {
        header('location: form_login.php');
    }
    include('connection.php');
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
            <h1 class="text-center alert alert-secondary">Sales</h1>
            <a href="CreateReceiption.php" role="button" class="btn btn-primary mt-3">Create Receipt</a>
        </div>
        <div class="accordion accordion-flush  mt-5" id="accordionFlushExample">
            <?php
                $sql = "Select receipt.r_id, receipt.r_tt_price, customer.c_id, customer.c_name, employee.e_id, employee.e_name from receipt join customer on customer.c_id=receipt.c_id JOIN employee on employee.e_id=receipt.e_id;";
                $receipt = $con->query($sql);
                if($receipt->num_rows > 0) {
                    while($row = $receipt->fetch_assoc()) {
            ?>
            <div class="accordion-item alert alert-secondary">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $row['r_id'];?>" aria-expanded="false" aria-controls="flush-collapseOne">
                    Seller : <?php echo $row['e_name'];?> => Buyer : <?php echo $row['c_name'];?>
                </button>
                </h2>
                <div id="<?php echo $row['r_id'];?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <ul class="list-group">
                        <?php
                            $product = $con->query("Select product.*, product_sales.* from product_sales join product on product.p_id=product_sales.p_id where product_sales.r_id=$row[r_id];");
                            if($product->num_rows > 0) {
                                while($row1 = $product->fetch_assoc()) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">'. $row1['p_name'].'
                                            <span class="badge bg-primary rounded-pill">'.$row1['p_num'].'</span>
                                    </li>';
                                }
                            }
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Price : <?php echo $row['r_tt_price'];?>
                        </li>
                    </ul>
                    <a href="" class="btn btn-danger mt-2">Delete</a>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>

