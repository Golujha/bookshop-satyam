<?php include_once "connect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Bookshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php include_once "header.php"; 

    //calling order and order item
    $user_id = $getUser['user_id'];
    $order = mysqli_query($connect,"select * from orders LEFT JOIN coupon ON orders.coupon_id = coupon.c_id where user_id='$user_id' and is_ordered='0'");
    $myOrder = mysqli_fetch_array($order);
    $count_myOrder = mysqli_num_rows($order);
    ?>

    <div class="container p-5">
        <div class="row">
            <?php
            if($count_myOrder > 0):
                $myOrderId = $myOrder['order_id'];
                //getting order items
                $myOrderItems = mysqli_query($connect,"select * from order_items JOIN books ON order_items.book_id = books.id where order_id ='$myOrderId'");
                $count_order_items = mysqli_num_rows($myOrderItems);
                
                if($count_order_items):
            
            ?>
            <div class="col-9">
                <h1>My Cart(<?= $count_order_items;?>)
                </h1>
                <div class="row">
                    <?php
                    $total_amount = $total_discounted_amount = 0;                    
                    while($order_item = mysqli_fetch_array($myOrderItems)): 
                        $price = $order_item['qty'] * $order_item['price'];
                        $discount_price = $order_item['qty'] * $order_item['discount_price'];

                    ?>
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="images/<?= $order_item['cover_image'];?>" class="w-100" alt="">
                                    </div>
                                    <div class="col-10">
                                        <h2 class="h6 text-truncate">
                                            <?= $order_item['title'];?>
                                        </h2>
                                        <h4>
                                            <span class="text-success">₹
                                                <?= $order_item['discount_price'];?>
                                            </span>
                                            <del class="text-muted small">₹
                                                <?= $order_item['price'];?>
                                            </del>
                                        </h4>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <a href="cart.php?book_id=<?= $order_item['id'];?>&dfc=true"
                                                    class="btn btn-danger">-</a>
                                                <span class="btn"><?= $order_item['qty'];?></span>
                                                
                                                <a href="cart.php?book_id=<?= $order_item['id'];?>&atc=true"
                                                    class="btn btn-success">+</a>
                                            </div>
                                            <a href="cart.php?delete_item=<?= $order_item['oi_id'];?>"
                                                class="btn btn-dark">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <?php 
                        $total_amount += $price;
                        $total_discounted_amount += $discount_price;                    
               
                endwhile; ?>
                </div>
            </div>

            <div class="col-3">
                <h2>Price Break</h2>
                <div class="list-group">
                    <span
                        class="list-group-item list-group-item-action d-flex justify-content-between bg-success text-white">
                        <span>Total amount</span>
                        <span>
                            <?= $total_amount;?>/-
                        </span>
                    </span>
                    <span
                        class="list-group-item list-group-item-action d-flex justify-content-between bg-danger text-white">
                        <span>Total Discount</span>
                        <span>
                            <?= $amount_before_tax =$total_amount - $total_discounted_amount;?>/-
                        </span>
                    </span>
                    <span
                        class="list-group-item list-group-item-action d-flex justify-content-between bg-primary text-white">
                        <span>Total TAX (GST)</span>
                        <span>
                            <?=$tax = $total_discounted_amount * 0.18;?>/-
                        </span>
                    </span>
                    <?php
                    if($myOrder['coupon_id']):
                    ?>
                    <span class="list-group-item list-group-item-action bg-warning">
                        <div class="d-flex justify-content-between">
                            <span>Coupon Discount</span>
                            <span>
                                <?=$coupon_amount = $myOrder['coupon_amount'];?>/-
                            </span>
                        </div>
                        <div class="bg-white px-2 py-1 text-center" text-sm>
                            <small class="fw-bold">Coupon applied -
                                <?= $myOrder['coupon_code'];?>
                                <a href="cart.php?remove_coupon=<?= $myOrder['order_id'];?>"
                                    class="text-decoration-none text-danger">X</a>
                            </small>
                        </div>
                    </span>
                    <?php endif; ?>
                    <span
                        class="list-group-item list-group-item-action d-flex justify-content-between bg-danger text-white">
                        <span class="h5">Payable amount</span>
                        <span class="h5">
                            <?php
                         $total_payable_amount = $total_discounted_amount + $tax;
                         
                         if($myOrder['coupon_id']){
                            echo $total_payable_amount - $coupon_amount;

                         }
                         else{
                            echo $total_payable_amount;
                         }
                         
                         ?>/-
                        </span>
                    </span>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php" class="btn btn-dark btn-lg">Go back</a>
                    <a href="checkout.php" class="btn btn-primary btn-lg">Checkout</a>
                </div>
                <?php 
                if(!$myOrder['coupon_id']):
                ?>
                <div class="mb-3">
                    <form action="" method="post" class="d-flex mt-5">
                        <input type="text" placeholder="Enter coupon code" name="code" class="form-control">
                        <input type="submit" class="btn btn-dark" value="Apply" name="apply">
                    </form>
                </div>
                <?php endif;?>
            </div>
            <?php endif; else: ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>sorry your cart is empty... </h2>
                        <a href="index.php" class="btn btn-dark">Shop Now</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <?php
    //add to cart
    if(isset($_GET['book_id']) && isset($_GET['atc'])){

        //check user login or not
        if(!isset($_SESSION['account'])){
            echo "<script>window.open('login.php','_self')</script>";
        }
        
        //if login

        $book_id = $_GET['book_id'];
        $user_id = $getUser['user_id'];
        
        //checking order already exists or not
        $check_order = mysqli_query($connect,"select * from orders where user_id='$user_id'and is_ordered='0'");
        $count_check_order = mysqli_num_rows($check_order);

        if($count_check_order < 1){
            //not exist prev that why we need to create new order in order table
            $create_order = mysqli_query($connect,"insert into orders(user_id) value ('$user_id')");
            $created_order_id = mysqli_insert_id($connect);

            //inserting new order_item
            $create_order_item = mysqli_query($connect,"insert into order_items (order_id, book_id) value ('$created_order_id','$book_id')");
        } else {
            //already exist order work
            $current_order = mysqli_fetch_array($check_order);
            $current_order_id = $current_order['order_id'];

            //checking if order_item already exist or not
            $check_order_items = mysqli_query($connect,"select * from order_items where (order_id='$current_order_id' and book_id='$book_id')");
            $check_order_item = mysqli_fetch_array($check_order_items);
            $count_current_order_item = mysqli_num_rows($check_order_items);

            if($count_current_order_item > 0) {
                //only need to update qty of items in order_items table
                $current_order_item_id = $check_order_item['oi_id'];
                $query_for_qty_update = mysqli_query($connect,"update order_items set qty=qty+1 where oi_id='$current_order_item_id'");
            } else {
                $create_order_item = mysqli_query($connect,"insert into order_items (order_id, book_id) value ('$current_order_id','$book_id')");
            }
        }

        //refresh page

        echo "<script>window.open('cart.php', '_self')</script>";

    }
    //delete from cart

    if(isset($_GET['book_id']) && isset($_GET['dfc'])){

        //check user login or not
        if(isset($_SESSION['account'])){
            echo "<script>window.open('login.php', '_self')</script>";
        }
        
        //if login

        $book_id = $_GET['book_id'];
        $user_id = $_GET['user_id'];
        
        //checking order already exists or not
        $check_order = mysqli_query($connect,"select * from orders where user_id='$user_id' and is_ordered='0'");
        $count_check_order = mysqli_num_rows($check_order);

            //already exist order work
        $current_order = mysqli_fetch_array($check_order);
        $current_order_id = $current_order['order_id'];

            //checking if order_item already exist or not
        $check_order_item = mysqli_query($connect,"select * from order_items where (order_id='$current_order_id' and book_id='$book_id')");
        $check_order_item = mysqli_fetch_array($check_order_item);
        $count_current_order_item = mysqli_num_rows($check_order_item);

        if($count_current_order_item > 0) {
                //only need to update qty of items in order_items table
            $current_order_item_id = $current_order_item['oi_id'];
            $qty = $current_order_item['qty'];
            if($qty == 1){
                $delete_query_for_order_item = mysqli_query($connect,"delete from order_items where oi_id='$current_order_item_id'");

            }
            else{
                $query_for_qty_update = mysqli_query($connect,"update order_items set qty=qty-1 where oi_id='$current_order_item_id'");

            }
        }

        //refresh page

        echo "<script>window.open('cart.php', '_self')</script>";
    }

        //add coupon amount

        if(isset($_POST['apply'])){
            $code = $_POST['code'];

            $callingCoupon = mysqli_query($connect,"select * from coupon where coupon_code='$code'");
            $getCoupon = mysqli_fetch_array($callingCoupon);
            $countCoupon = mysqli_num_rows($callingCoupon);

            if($countCoupon > 0){
                //updating coupon id in order record
                $coupon_id = $getCoupon['c_id'];
                $updateOrder = mysqli_query($connect,"update orders SET coupon_id='$coupon_id' where order_id='$myOrderId'");
                echo "<script>window.open('cart.php', '_self')</script>";

            }
            else{
                echo "<script>alert('invalid coupon code');</script>";
            }
        }

        //delete item directly

        if(isset($_GET['delete_item'])){
            $item_id = $_GET['delete_item'];

            $queryForDeleteItem = mysqli_query($connect,"delete from order_items where oi_id='$item_id'");
            if($queryForDeleteItem){
                echo "<script>window.open('cart.php', '_self')</script>";
            }
            else{
                echo "<script>alert('fail to delete item')</script>";
            }
        }




        if(isset($_GET['remove_coupon'])){
            $id = $_GET['remove_coupon'];

            $queryForRemoveCoupon  = mysqli_query($connect,"update  orders SET coupon_id='NULL' where order_id='$id'");
            
            if($queryForRemoveCoupon){
                echo "<script>window.open('cart.php', '_self')</script>";
            }
            else{
                echo "<script>alert('fail to remove coupon')</script>";
            }
        }
    ?>

</body>

</html>