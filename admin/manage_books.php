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
            <div class="row">
                    <div class="col-12 mb-3 d-flex justify-content-between">
                        <h2 class="text-white m-0 p-0">Manage Books(3)</h2>
                        <a href="insert_book.php" class="btn btn-light">Insert Book</a>

                    </div>
                </div>
              <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>author</th>
                        <th>ISBN</th>
                        <th>price</th>
                        <th>image</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //query start here for calling data
                    $callingBooks = mysqli_query($connect,"select * from books");
                    while($data = mysqli_fetch_array($callingBooks)):
                    ?>
                    <tr>
                        <td><?= $data['id'];?></td>
                        <td><?= $data['title'];?></td>
                        <td><?= $data['author'];?></td>
                        <td><?= $data['isbn'];?></td>
                        <td><?= $data['discount_price'];?> <del><?= $data['price'];?></del></td>
                        <td>
                            <img width="50px" src="../images/<?= $data['cover_image'];?>" alt="">
                        </td>
                        <td>
                          <div class="btn-group gap-1 border-radius-5px">
                            <a href="manage_books.php?b_id=<?= $data['id'];?>" class="btn btn-danger">X</a>
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
if(isset($_GET['b_id'])){
    $id = $_GET['b_id'];
    $query = mysqli_query($connect,"delete from books where id='$id'");

    if($query){
        echo "<script>window.open('manage_books.php','_self')</script>";
    }
    else{
        echo "<script>alert('delete failed')</script>";

    }
}
?>