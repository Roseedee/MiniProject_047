<?php
    include('connection.php');
    $r_id = $_GET['r_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
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
            <a href="sales.php" role="button" class="btn btn-secondary mb-3">Back</a>
            <h1 class="text-center alert alert-secondary">Create Receiption</h1>
            <?php
                $sql = "Select sum(p_num) as p_num from product_sales where r_id=" . $r_id;
                $result = $con->query($sql);
                $p_num = $p_row = $result->fetch_assoc();
            ?>    
            <div class="accordion-item alert alert-secondary">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $r_id;?>" aria-expanded="false" aria-controls="flush-collapseOne">
                    Shopee Cart : (<?php echo $p_num['p_num']; ?>)
                </button>
                </h2>
                <div id="<?php echo $r_id;?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <ul class="list-group">
                        <?php
                            $total_price = 0;
                            $product = $con->query("Select product.*, product_sales.* from product_sales join product on product.p_id=product_sales.p_id where product_sales.r_id=$r_id;");
                            if($product->num_rows > 0) {
                                while($row1 = $product->fetch_assoc()) {
                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">'. $row1['p_name'].' ('.$row1['p_price'].' Bath)
                                            <span class="badge bg-primary rounded-pill">'.$row1['p_num'].'</span>
                                    </li>';
                                    $total_price += $row1['p_price'] * $row1['p_num'];
                                }
                            }
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Price : <?php echo $total_price . ' Bath';?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <section class="section-products">
		    <div class="container">
				<div class="row">
                    <?php
                        $product = $con->query("Select * from product");
                        if($product->num_rows > 0) {
                            while($row = $product->fetch_assoc()) {
                    ?>
					<!-- Single Product -->
					<div class="col-md-6 col-lg-4 col-xl-3">
						<div id="product-1" class="single-product">
							<div class="part-1">
								<ul>
									<li><a href="add_product.php?p_id=<?php echo $row['p_id'].'&r_id='.$r_id;?>">Add</a></li>
								</ul>
							</div>
							<div class="part-2">
								<h3 class="product-title"><?php echo $row['p_name']; ?></h3>
								<h4 class="product-old-price"><?php echo $row['p_price'] + 100 . " บาท";?></h4>
								<h4 class="product-price"><?php echo $row['p_price'] . " บาท";?></h4>
							</div>
						</div>
                    </div>
                    <?php
                            }
                        }
                    ?>
				</div>
		    </div>
        </section>
    </div>
    <script>
function load_new_content(){    
    var selected_option_value=$("#select1 option:selected").val(); //get the value of the current selected option.
    window.alert(selected_option_value);

     $.post("add_product.php", {option_value: 1},
         function(data){ //this will be executed once the `script_that_receives_value.php` ends its execution, `data` contains everything said script echoed.
              $("#place_where_you_want_the_new_html").html(data);
              alert(data); //just to see what it returns
         }
     );
} 
    </script>
</body>
</html>
