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
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3 align-items-center">
    <ul class="nav nav-tabs d-flex justify-content-between">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="product.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product-type.php">Product Type</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sales.php">Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="employee.php">Employee</a>
            </li>
            <a href="logout.php" role="button" class="btn btn-secondary float-end">Logout</a>
        </ul>
        <div class="container mt-5">
            <h1 class="text-center alert alert-secondary">Product</h1>

            <?php
                if(isset($_GET['id'])) {
                    echo '<form action="update.php?form=product" method="POST">';
                }else {
                    echo '<form action="insert.php?form=product" method="POST">';
                }
            ?>
            
                <div class="d-flex flew-row">
                    <?php
                        if(isset($_GET['id'])) {
                            echo '
                            <div class="mr-3" style="width: 50px;">
                                <label for="id" class="form-label">ID</label>
                                <input class="form-control" type="text" name="id" value="'. $_GET['id']. '" readonly>    
                            </div>
                            ';
                        }
                    ?>
                    <div class="flex-grow-1 mr-3">
                        <label for="pname" class="form-label">Product Name</label>
                        <input class="form-control" type="text" name="pname" value="<?php if(isset($_GET['pname'])) { echo $_GET['pname']; unset($_GET['pname']); }?>">
                    </div>
                    <div class="flex-grow-1 mr-3">
                        <label for="pcostprice" class="form-label">Cost Price</label>
                        <input class="form-control" type="text"  name="pcostprice" value="<?php if(isset($_GET['pcostprice'])) { echo $_GET['pcostprice']; unset($_GET['pcostprice']); }?>">
                    </div>
                    <div class="flex-grow-1 mr-3">
                        <label for="pprice" class="form-label">Sell Price</label>
                        <input class="form-control" type="text" name="pprice" value="<?php if(isset($_GET['pprice'])) { echo $_GET['pprice']; unset($_GET['pprice']); }?>">
                    </div>
                    <div class="flex-grow-1 mr-3">
                        <label for="ptype" class="form-label">Product Type</label>
                        <select name="ptype" class="form-select">
                            <?php
                                $product_type = $con->query("Select * from product_type");
                                if($product_type->num_rows > 0) {
                                    while($row = $product_type->fetch_assoc()) {
                                        if($_GET['ptype'] == $row['pdt_id']) {
                                            echo '<option value='.$row['pdt_id'].' selected>'.$row['pdt_name'].'</option>';
                                        }else {
                                            echo '<option value='.$row['pdt_id'].'>'.$row['pdt_name'].'</option>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="flex-grow-1">
                        <label for="pstate" class="form-label">Product State</label>
                        <select name="pstate" class="form-select">
                            <?php
                                $product_state = $con->query("Select * from product_state");
                                if($product_state->num_rows > 0) {
                                    while($row = $product_state->fetch_assoc()) {
                                        if($_GET['pstate'] == $row['pdst_id']) {
                                            echo '<option value='.$row['pdst_id'].' selected>'.$row['pdst_name'].'</option>';
                                        }else {
                                            echo '<option value='.$row['pdst_id'].'>'.$row['pdst_name'].'</option>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input class="btn btn-success mt-3" type="submit" value="<?php if(isset($_GET['id'])) { echo "Update";} else {echo "Insert"; } ?>">
                <?php
                    if(isset($_GET['id'])) {
                        echo '<a href="product.php" role="button" class="btn btn-secondary mt-3">Cancel</a>';
                        unset($_GET['id']);
                    }
                ?>
            </form>
        </div>
        <table class="table mt-3">        
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Product Name</th>
                    <th class="text-center">Cost Price</th>
                    <th class="text-center">Sell Price</th>
                    <th class="text-center">Product Type</th>
                    <th class="text-center">Product State</th>
                    <th colspan="2" class="text-center">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "Select product.*, product_type.*, product_state.* From product join product_type on product_type.pdt_id=product.pdt_id JOIN product_state on product_state.pdst_id=product.pdst_id;";
                    $result = $con->query($sql);
                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                echo '<td class="text-center">'. $row['p_id'] . '</td>';
                                echo '<td class="text-center">'. $row['p_name'] . '</td>';
                                echo '<td class="text-center">'. $row['p_cost_price'] . '</td>';
                                echo '<td class="text-center">'. $row['p_price'] . '</td>';
                                echo '<td class="text-center">'. $row['pdt_name'] . '</td>';
                                echo '<td class="text-center">'. $row['pdst_name'] . '</td>';
                                echo '<td class="text-center"><a role="button" class="btn btn-primary" href="product.php?id=' . $row['p_id'] .'&pname='.$row['p_name'].'&pcostprice='.$row['p_cost_price'].'&pprice='.$row['p_price'].'&ptype='.$row['pdt_id'].'&pstate='.$row['pdst_id'].'">Update</a></td>';
                                echo '<td class="text-center"><a role="button" class="btn btn-danger" href="delete.php?id=' . $row['p_id'] .'&form=product">Delete</a></td>';
                            echo '</tr>';
                        }
                    }else {
                        echo '<td class="text-center" colspan="7">No Data in Table</td>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>