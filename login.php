<?php
include('include/header.html'); ?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="include/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php

if (isset($_POST['submitted'])) {
    require_once('mysqli_connect.php');
    $error = array();

    if (empty($_POST['email'])) {
        $error[] = 'Your forgot to enter your Email Address';
    } else {
        $email = mysqli_real_escape_string($abc, trim($_POST['email']));
    }

    if (empty($_POST['pass'])) {
        $error[] = 'Your forgot to enter your Password';
    } else {
        $pass = mysqli_real_escape_string($abc, trim($_POST['pass']));
    }

    if (empty($error)) {
        $query = "SELECT ID FROM users WHERE email = '$email' and password ='$pass'";
        $result = mysqli_query($abc, $query);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            if (mysqli_affected_rows($abc) == 1) {
        ?>
                <script>
                    swal({
                        title: "Log in",
                        icon: "success",
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    swal({
                        title: "Something went wrong",
                        text: "Either wrong email or password!",
                        icon: "error",
                    });
                </script>
        <?php
                echo '<p>' . mysqli_error($abc) . '<br>Query' . $q . '</p>';
            }
        } else {
            
        ?>
        <script>
            swal({
                title: "Something went wrong",
                text: "Either wrong email or password!",
                icon: "error",
            });
        </script>
<?php
        }
    } else {
        ?>
        <script>
            swal({
                title: "Something went wrong",
                text: "Either wrong email or password!",
                icon: "error",
            });
        </script>
<?php
    }
    mysqli_close($abc);
}
?>

<body>
    <div id="container">
        <div class="card" style="width: 800px; margin: auto; background-color: white; border-radius: 2%; padding-bottom: 30px">
           
            <h2 style="color: black; text-align: center; padding-top: 15px; padding-bottom: 15px; font-size: 40px">Login</h2>
            <form action="login.php" method="POST">
                <div class="mb-2">
                    <label for="InputFN" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="InputFN" name="email" placeholder="Enter Email Address">
                </div>
                <div class="mb-2">
                    <label for="InputLN" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputLN" name="pass" placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-primary btn-lg float-left" name="submitted" style="background-color: #335; border-color: #335;">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include('include/footer.html'); ?>