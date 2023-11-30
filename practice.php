

//for int char mix digit 

// $name = "CHUPJ2363N";
// if(preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]+$/',$name)){
//     echo "valid";
// }
// else{
//     echo "invalid";
// }



//for name print and character print

// $name = "SATYAM";
// if(preg_match('/^[A-Z]{5,}+$/',$name)){
//     echo "valid";
// }
// else{
//     echo "invalid";
// }



//for number is == 10

// $name = "9999999999";
// if(preg_match('/^[0-9]{10}+$/',$name)){
//     echo "valid";
// }
// else{
//     echo "invalid";
// }

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php

    $contact_error = $contact_msg= "";
    $email_error = $email_msg = "";

    if(isset($_POST['send'])){
        $contact = $_POST['contact'];
        $email = $_POST['email'];

        //contact validation

        if($contact == ""){
            $contact_msg ="contact field is required";
            $contact_error = "is-invalid";
        }
        else{
            if(preg_match("/^[0-9]{10}$/",$contact)){
                $contact_error = "is-valid";
            }
            else{
                $contact_error = "is-invalid";
                $contact_msg = "contact must be in 10 digits";
            }
        }

        //email validation

        if($email == ""){
            $email_msg = "email field is required";
            $email_error = "is-invalid";

        }
        else{
            if(preg_match("/^[^\d][a-zA-Z\d._]+@[a-zA-Z\d+._]+$/",$email)){
                $email_error = "is-valid";
            }
            else{
                $email_error = "is-invalid";
                $email_msg = "email is invalid";
            }
        }
    }
    ?>


<div class="container">
    <div class="row">
        <div class="col-4 mx-auto">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="" method="post" class="">
                        <div class="mb-3">
                            <label for="">Contact</label>
                            <input type="text" name="contact" class="form-control <?= $contact_error;?>" placeholder="enter contact no">
                            <p class="form-text text-danger"><?= $contact_msg;?></p>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control <?= $email_error;?>" placeholder="enter your email">
                            <p class="form-text text-danger"><?= $email_msg;?></p>
                        </div>
                        <input type="submit" name="send" class="btn btn-danger mt-3 w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>






