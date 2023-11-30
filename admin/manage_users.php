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
    <title>Manage Books-Bookshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="bg-secondary">
    <?php include_once "./admin_header.php"; ?>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-3">
               <?php include_once "sidebar.php"; ?>
            </div>

            <div class="col-9">
              <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>isAdmin</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $callingUser = mysqli_query($connect,"select * from accounts");
                    while($data = mysqli_fetch_array($callingUser)):
                    ?>
                    <tr>
                        <td><?= $data['user_id'];?></td>
                        <td><?= $data['name'];?></td>
                        <td><?= $data['email'];?></td>
                        <td><?= ($data['isAdmin'])? "True" : "False";?></td>
                       
                        <td>
                           <div class="btn-group gap-1">
                           <a href="manage_users.php?u_id=<?= $data['user_id'];?>" class="btn btn-danger">X</a>
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
</body>
</html>

<?php
if(isset($_GET['u_id'])){
    $id = $_GET['u_id'];
    $query = mysqli_query($connect,"delete from accounts where user_id='$id'");

    if($query){
        echo "<script>window.open('manage_users.php','_self')</script>";
    }
    else{
        echo "<script>alert('delete failed')</script>";

    }
}
?>