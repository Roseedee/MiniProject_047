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
    <title>Customer</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <ul class="nav nav-tabs d-flex justify-content-between">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"  href="index.php">Customer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">Product</a>
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
            <h1 class="text-center alert alert-secondary">Customer</h1>
            <?php
                if(isset($_GET['id'])) {
                    echo '<form action="update.php?form=customer" method="POST">';
                }else {
                    echo '<form action="insert.php?form=customer" method="POST">';
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
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" name="name" value="<?php if(isset($_GET['name'])) { echo $_GET['name']; unset($_GET['name']); }?>">
                    </div>
                    <div class="flex-grow-1 mr-3">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" type="text"  name="address" value="<?php if(isset($_GET['address'])) { echo $_GET['address']; unset($_GET['address']); }?>">
                    </div>
                    <div class="flex-grow-1">
                        <label for="tel" class="form-label">Phone number</label>
                        <input class="form-control" type="text" name="tel" value="<?php if(isset($_GET['tel'])) { echo $_GET['tel']; unset($_GET['tel']); }?>">
                    </div>
                </div>
                <input class="btn btn-success mt-3" type="submit" value="<?php if(isset($_GET['id'])) { echo "Update";} else {echo "Insert"; } ?>">
                <?php
                    if(isset($_GET['id'])) {
                        echo '<a href="index.php" role="button" class="btn btn-secondary mt-3">Cancel</a>';
                        unset($_GET['id']);
                    }
                ?>
            </form>
        </div>
        <table class="table mt-3">        
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Phone number</th>
                    <th colspan="2" class="text-center">Manage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "Select * From customer";
                    $result = $con->query($sql);
                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                                echo '<td class="text-center">'. $row['c_id'] . '</td>';
                                echo '<td class="text-center">'. $row['c_name'] . '</td>';
                                echo '<td class="text-center">'. $row['c_address'] . '</td>';
                                echo '<td class="text-center">'. $row['c_tel'] . '</td>';
                                echo '<td class="text-center"><a role="button" class="btn btn-primary" href="index.php?id=' . $row['c_id'] .'&name='.$row['c_name'].'&address='.$row['c_address'].'&tel='.$row['c_tel'].'">Update</a></td>';
                                echo '<td class="text-center"><a role="button" class="btn btn-danger" href="delete.php?id=' . $row['c_id'] .'&form=customer">Delete</a></td>';
                            echo '</tr>';
                        }
                    }else {
                        echo '<td class="text-center" colspan="6">No Data in Table</td>';
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>