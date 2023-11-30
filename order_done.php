<?php include_once "connect.php";
if(!isset($_SESSION['account'])){
    echo "<script>window.open('login.php','_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Done | Bookshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            <div class="col-6 mx-auto">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center ">
                        <h2><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50"
                                viewBox="0,0,256,256" style="fill:#000000;">
                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1"
                                    stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                    stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                    font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M43.171,10.925l-19.086,22.521l-9.667,-9.015l1.363,-1.463l8.134,7.585l17.946,-21.175c-4.204,-4.534 -10.205,-7.378 -16.861,-7.378c-12.683,0 -23,10.317 -23,23c0,12.683 10.317,23 23,23c12.683,0 23,-10.317 23,-23c0,-5.299 -1.806,-10.182 -4.829,-14.075z">
                                        </path>
                                    </g>
                                </g>
                            </svg></h2>
                        <h4>Wow! Order Placed Successfully</h4>
                        <p>Click here to see <a href="my_order.php" class="text-light">My Order </a>Page to Know More Details</p>
                        <div class="d-flex justify-content-end">
                            <a href="my_order.php" class="btn btn-light">My Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>