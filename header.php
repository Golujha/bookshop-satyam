<div class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="index.php" class="navbar-brand text-light fw-bold" style="font-size:26px;">Bookshop</a>
        <form action="" class="d-flex" style="margin-left: 150px;">
            <input type="search" name="search" class="form-control" size="60" placeholder="search your book">
            <input type="submit" name="find" class="btn btn-danger ms-1">
        </form>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="btn btn-dark mt-1 me-2 " href="index.php">Home</a>
                    </li>
                  
                    <?php if(isset($_SESSION['account'])):
                        $email = $_SESSION['account'];
                        $getUser = mysqli_query($connect,"select * from accounts where email='$email'");
                        $getUser = mysqli_fetch_array($getUser);
                    ?>
                    <li class="nav-item active">
                        <a class="btn btn-info mt-1 me-2 text-capitalize text-white" href="my_order.php"><?= $getUser['name'];?></a>
                    </li>
                  
                    <li class="nav-item active">
                        <a class=" mt-1 me-2 btn btn-sm btn-danger " href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item active">
                        <a class=" mt-1 me-2 btn btn-sm btn-danger " href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>

                    <li class="nav-item active">
                        <a class="btn btn-danger mt-1 me-2" href="login.php">login</a>
                    </li>

                    <li class="nav-item active">
                        <a class="btn btn-warning mt-1 me-2" href="register.php">Create an Account</a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
    </div>
</div> 
 


