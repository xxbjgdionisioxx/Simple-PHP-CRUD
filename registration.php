<?php
include('include/header.html'); ?>
<html>

<head>
  <title>Registration </title>
  <link rel="stylesheet" href="include/style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

  <?php
  require('mysqli_connect.php');
  if (isset($_POST['btnsubmit'])) {
    if (!empty($_POST['first_name'])) {
      $fname = mysqli_real_escape_string($abc, trim($_POST['first_name']));
    } else {
      $fname = null;
    }
    if (!empty($_POST['last_name'])) {
      $lname = mysqli_real_escape_string($abc, trim($_POST['last_name']));
    } else {
      $lname = null;
    }
    if (!empty($_POST['email'])) {
      $email = mysqli_real_escape_string($abc, trim($_POST['email']));
    } else {
      $email = null;
    }
    if (!empty($_POST['password1'])) {
      if ($_POST['password1'] != $_POST['password2']) {
        $password1 = null;
      } else {
        $password1 = mysqli_real_escape_string($abc, trim($_POST['password1']));
      }
    } else {
      $password1 = null;
    }

    if ($fname && $lname && $email && $password1) {
      $sql = "INSERT INTO users (first_name, last_name, email, password)
        VALUES ('$fname','$lname','$email','$password1')";

      if (mysqli_query($abc, $sql)) {
  ?>
        <script>
          swal({
            title: "New Record Created!",
            icon: "success",
          });
        </script>
      <?php
      } else {
        echo "Error:" . $sql . "<br>" . mysqli_error($abc);
      }
      mysqli_close($abc);
    } else {
      ?>
      <script>
        swal({
          title: "Something went wrong",
          text: "Please Fill out the form again!",
          icon: "error",
        });
      </script>
  <?php
    }
  }
  ?>
  <div id="container">
    <div class="card" style="width: 800px; margin: auto; background-color: white; border-radius: 2%; padding-bottom: 30px">
      
      <h2 style="color: black; text-align: center; padding-top: 15px; padding-bottom: 15px; font-size: 40px">Sign Up</h2>
      <form action="registration.php" method="POST">
        <div class="mb-2">
          <label for="InputFN" class="form-label">First Name</label>
          <input type="text" class="form-control" id="InputFN" name="first_name" placeholder="Enter First name">
        </div>
        <div class="mb-2">
          <label for="InputLN" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="InputLN" name="last_name" placeholder="Enter Last name">
        </div>
        <div class="mb-2">
          <label for="InputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="InputEmail1" name="email" placeholder="Enter Email">
        </div>
        <div class="mb-2">
          <label for="InputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="InputPassword1" name="password1" placeholder="Enter Password">
        </div>
        <div class="mb-2">
          <label for="InputPassword2" class="form-label">Retype Password</label>
          <input type="password" class="form-control" id="InputPassword2" name="password2" placeholder="Re-Enter Password">
        </div>
        <button type="submit" class="btn btn-primary btn-lg float-left" name="btnsubmit" style="background-color: #335; border-color: #335;">Submit</button>
      </form>
    </div>
  </div>
</body>

</html>
<?php
include('include/footer.html'); ?>