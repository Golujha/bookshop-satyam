<?php include_once "../connect.php";
if(!isset($_SESSION['admin'])){
    echo "<script>window.open('../login.php','_self')</script>";
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Coupons |Bookshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="bg-secondary">
    <?php include_once "./admin_header.php"; ?>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-3">
               <?php include_once "sidebar.php"; ?>
            </div>

            <div class="col-9">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 class="text-white">Manage Coupon</h2>
                    </div>
                </div>
              <div class="row">
                <div class="col-3">
                <div class="card">
                <div class="card-header">
                    <h5>Insert Coupon Details</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="coupon_code">Coupon code</label>
                            <input type="text" class="form-control" placeholder="enter code" id="coupon_code" name="coupon_code">
                        </div>
                        <div class="mb-3">
                            <label for="coupon_amount">Coupon amount</label>
                            <input type="text" class="form-control" placeholder="enter coupon amount" id="coupon_amount" name="coupon_amount">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary"  name="create_coupon" value="Insert coupon">
                        </div>
                    </form>

                    <?php

                    if(isset($_POST['create_coupon'])){
                        $coupon_code =$_POST['coupon_code'];
                        $coupon_code_amount =$_POST['coupon_amount'];

                        $query = mysqli_query($connect, "insert into coupon (coupon_code,coupon_amount) value ('$coupon_code','$coupon_code_amount')");
                        if($query){
                            echo "<script>window.open('manage_coupons.php','_self')</script>";
                          }
                          else{
                            echo "<script>alert('failed')</script>";
    
                          }
    
                    }

                    ?>
                </div>
            </div>
                </div>
                <div class="col-9">
                <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Code</th>
                        <th>Amount</th>
                        <th>action</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $callingCoupon = mysqli_query($connect,"select * from coupon");
                    while($data = mysqli_fetch_array($callingCoupon)):
                    ?>
                    <tr>
                        <td><?= $data['c_id'];?></td>
                        <td><?= $data['coupon_code'];?></td>
                        <td><?= $data['coupon_amount'];?></td>

                        <td>
                           <div class="btn-group gap-1">
                           <a href="manage_coupons.php?coupon_id=<?= $data['c_id'];?>" class="btn btn-danger">X</a>
                            <a href="" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-success">View</a>
                           </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
              </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
if(isset($_GET['coupon_id'])){
    $id = $_GET['coupon_id'];
    $query = mysqli_query($connect,"delete from coupon where coupon_id='$id'");

    if($query){
        echo "<script>window.open('manage_coupons.php','_self')</script>";
    }
    else{
        echo "<script>alert('delete failed')</script>";

    }
}
?>