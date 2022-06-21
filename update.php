<?php
include('include/header.html'); ?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update</title>
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

    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $error[] = 'Password did not match';
        } else {
            $pass1 = mysqli_real_escape_string($abc, trim($_POST['pass1']));
        }
    } else {
        $error[] = 'Your forgot to enter your New Password';
    }

    if (empty($error)) {
        $query = "SELECT ID FROM users WHERE email = '$email' and password ='$pass'";
        $result = mysqli_query($abc, $query);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $q = "UPDATE users SET password = '$pass1' WHERE ID='$row[0]'";
            $r = mysqli_query($abc, $q);

            if (mysqli_affected_rows($abc) == 1) {
?>
                <script>
                    swal({
                        title: "Record Updated!",
                        icon: "success",
                    });
                </script>
            <?php
            } else {
            ?>
                <script>
                    swal({
                        title: "Something went wrong",
                        text: "Password could not change!",
                        icon: "error",
                    });
                </script>
        <?php
                echo '<p>' . mysqli_error($abc) . '<br>Query' . $q . '</p>';
            }
        } else {
            echo '<h1>ERROR!</h1>
                <p>The email address and password do not match!</p>';
        }
    } else {
        ?>
        <script>
            swal({
                title: "Something went wrong",
                text: "Password could not change!",
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
           
            <h2 style="color: black; text-align: center; padding-top: 15px; padding-bottom: 15px; font-size: 40px">Update Records</h2>
            <form action="update.php" method="POST">
                <div class="mb-2">
                    <label for="InputFN" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="InputFN" name="email" placeholder="Enter Email Address">
                </div>
                <div class="mb-2">
                    <label for="InputLN" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="InputLN" name="pass" placeholder="Enter Current Password">
                </div>
                <div class="mb-2">
                    <label for="InputEmail1" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="InputEmail1" name="pass1" placeholder="Enter New Password">
                </div>
                <div class="mb-2">
                    <label for="InputPassword1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="pass2" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary btn-lg float-left" name="submitted" style="background-color: #335; border-color: #335;">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
include('include/footer.html'); ?>