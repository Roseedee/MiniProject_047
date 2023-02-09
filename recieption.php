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
    <title>Reciept Print</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-3 align-items-center">
        <a href="sales.php" role="button" class="btn btn-danger">Back</a>
        

        <style>
            .page {
                background-color: white;
                margin: 20px 0px;
            }

            .page .row {
                padding: 20px;
            }

            .page .row .col h1 {
                font-weight: bold;

            }

            @media print {
                body * {
                    visibility: hidden;
                }
                .page, .page * {
                    visibility: visible;
                }
            }

        </style>

        <div class="page">
            <div class="row">
                <div class="col">
                    <h1>INVOICE</h1>
                    <p>Darken Coperation</p>
                </div>
                <div class="col" style="text-align:right;">
                    <?php
                        $sql = "Select customer.* from customer join receipt on receipt.c_id=customer.c_id where r_id=$r_id;";
                        $result = $con->query($sql);
                        $customer = $customer_value = $result->fetch_assoc();
                    ?>
                    <p>Invoice to : <?php echo $customer['c_name']?></p>
                    <p>Address : <?php echo $customer['c_address']?></p>
                </div>
            </div>
            <table class="table">
                <thead class="" style="background-color: #F3D830;">
                    <tr class=""> 
                        <th>#</th>
                        <th>Product List</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">Quality</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $total_price = 0;
                    $i = 0;
                    $product = $con->query("Select product.*, product_sales.* from product_sales join product on product.p_id=product_sales.p_id where product_sales.r_id=$r_id;");
                    if($product->num_rows > 0) {
                        while($row = $product->fetch_assoc()) {
                            $i++;
                            $total_price += $row['p_price'] * $row['p_num'];
                        
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row['p_name']?></td>
                        <td style="text-align: center;"><?php echo $row['p_price']?> Bath</td>
                        <td style="text-align: center;"><?php echo $row['p_num']?></td>
                        <td style="text-align: center;"><?php echo $row['p_price'] * $row['p_num']?> Bath</td>
                    </tr>
                    <?php
                            }
                        }
                        $taxes = $total_price * 0.07;
                    ?>
                </tbody>
                <tbody style="background-color: #F3D830;">
                    <?php
                        $sql = "Select sum(p_num) as p_num from product_sales where r_id=" . $r_id;
                        $result = $con->query($sql);
                        $p_num = $p_row = $result->fetch_assoc();
                    ?>
                    <tr>
                        <td colspan="3" style="text-align: right;">Subtotal</td>
                        <td style="text-align: center;"><?php echo $p_num['p_num'] ?></td>
                        <td style="text-align: center;"><?php echo $total_price ?> Bath</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;">Taxes</td>
                        <td style="text-align: center;">7%</td>
                        <td style="text-align: center;"><?php echo$taxes?> Bath</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col" style="text-align: right;">
                    <h5>
                        TOTAL : <?php echo $total_price + $taxes?> Bath
                    </h5>
                </div>
            </div>
            <div class="row">
                <hr width="100%">
                <h3>THANK YOU!</h3>
            </div>
        </div>
        <center>
            <button class="btn btn-warning pl-5 pr-5" onclick="window.print()">Print</button>
        </center>
    </div>
</body>
</html>

