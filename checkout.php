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
    <title>Cart | Bookshop</title>
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

            <div class="col-8">
                <h1>Checkout</h1>
                <div class="card">
                    <div class="card-header">Add Address</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="">Alternative Name</label>
                                    <input type="text" name="alt_name" class="form-control" value="<?= $getUser['name'];?>">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">Primary Contact</label>
                                    <input type="text" placeholder="e.g 9999999999" name="alt_contact" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">Type</label>
                                    <select name="type" class="form-select">
                                        <option value="">Select Address Type</option>
                                        <option value="0">Office</option>
                                        <option value="1">Home</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="">Street</label>
                                    <input type="text" placeholder="e.g MG Road" name="street" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">Area/Village</label>
                                    <input type="text" placeholder="e.g Shri Nagar" name="area" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">House Holding No</label>
                                    <input type="text" placeholder="e.g EG12K" name="house_no" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="">Landmark</label>
                                    <input type="text" placeholder="e.g Near KFC" name="landmark" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">city</label>
                                    <input type="text" placeholder="e.g Purnea" name="city" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">state</label>
                                    <input type="text" placeholder="e.g Bihar" name="state" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="">pincode</label>
                                    <input type="text" placeholder="e.g 854334" name="pincode" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" name="save_Address" class="btn btn-primary w-100"
                                    value="Save Address">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">

                <h2>Saved Address</h2>
                <form action="">
                    <div class="grid">

                        <?php 
                        $callingSavedAddress = mysqli_query($connect,"select * from address where user_id='$user_id'");
                        $count_Address = mysqli_num_rows($callingSavedAddress);
                        if($count_Address > 0):
                        while($add = mysqli_fetch_array($callingSavedAddress)):
                        ?>
                        <label class="card">
                            <input name="address_id" class="radio" type="radio" value="<?= $add['address_id'];?>"
                                checked>

                            <span class="plan-details">
                                <span class="plan-type">
                                    <?= ($add['type']==0)? "office" : (($add['type']==1)? "home" : "other");?>
                                </span>
                                <span class="plan-cost">
                                    <?= $add['alt_name'];?>
                                </span>
                                <span>
                                    <?= $add['house_no'] . " | " .$add['street'] ."-" .$add['area'] . "<br>landmark: " . $add['landmark'] . "<br>" . $add['city'] . " (" . $add['state'] ." )-".$add['pincode'];?>
                                </span>
                                <a href="checkout.php?address_id=<?=$add['address_id'];?>"
                                    class="badge bg-danger text-white text-decoration-none ms-auto">Delete</a>
                            </span>
                        </label>
                        <?php endwhile; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-dark btn-lg mt-1 me-2">Go back</a>
                        <a href="make_payment.php" class="btn btn-primary mt-1 me-2">make payment</a>

                    </div>
                </form>
                <?php else: ?>
                <h2 class="text-muted h6">Empty saved Address</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php 
    if(isset($_POST['save_Address'])){
        $alt_name = $_POST['alt_name'];
        $alt_contact = $_POST['alt_contact'];
        $street = $_POST['street'];
        $area = $_POST['area'];
        $landmark = $_POST['landmark'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $pincode = $_POST['pincode'];
        $house_no = $_POST['house_no'];
        $type = $_POST['type'];

        $user_id = $getUser['user_id'];
        $queryForInsertAddress = mysqli_query($connect,"insert into address (alt_name,alt_contact,street,area,landmark,house_no,
        city,state,pincode,user_id,type) value ('$alt_name','$alt_contact','$street','$area','$landmark','$house_no','$city','$state',
        '$pincode','$user_id','$type')");

        if($queryForInsertAddress){
            echo "<script>window.open('checkout.php','_self')</script>";
        }
        else{
            echo "<script>alert('fail to save address')</script>";
        } 
    }    
    if(isset($_GET['address_id'])){
        $id = $_GET['address_id'];

        $user_id = $getUser['user_id'];

        $queryForRemoveAddress  = mysqli_query($connect,"delete from address where address_id='$id' and user_id='$user_id'");
        
        if($queryForRemoveAddress){
            echo "<script>window.open('checkout.php', '_self')</script>";
        }
        else{
            echo "<script>alert('fail to delete address')</script>";
        }
    }
    if(isset($_POST['make_payment'])){
        $address_id = $_POST['address_id'];
        $order_id = $myOrder['order_id'];
        //update this address in order record
        $queryForAddressUpdate = mysqli_query($connect,"update orders SET address_id='$address_id' where user_id='$user_id' and 
        order_id='$order_id'");
        if($queryForAddressUpdate){
            echo "<script>window.open('make_payment.php','_self')</script>";
        }
        else{
            echo "<script>alert('fail to proceed')</script>";
        }
    }