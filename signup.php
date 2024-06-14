<?php
   include 'Partials/_dbconnect.php';

   $showAlert = false;
   $showError = false;
   $userExists = false;

   if( $_SERVER['REQUEST_METHOD'] == 'POST' )
   {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $cpassword = $_POST['cpassword'];

      $existSql = mysqli_query($connect, "SELECT * FROM `users` WHERE username='$username'");

      if (mysqli_num_rows($existSql) == 0)
      {
         if( ($password==$cpassword))
         {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($connect, $sql);
   
            if ($result)
               $showAlert = true;
         }
         else
            $showError = true;
      }
      else
      {
         $userExists = true;
      }
   }
?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <title>Sign Up</title>
</head>

<body>
   <?php
      require 'Partials/_nav.php'
   ?>

   <?php
      if ($showAlert)
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You account has been created successfully. You can now login to your account.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>';
      
      if ($showError)
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> Password doesn\'t match. 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>';
      
      if ($userExists)
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> Username already exists. 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>';
   ?>
   
   <div class="container mt-3">
      <h3 class="text-center">Signup to our website</h3>

      <form action="/prog/Login System/signup.php" method="post">
         <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" maxlength="20">
         </div>

         <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" maxlength="20">
         </div>

         <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" maxlength="20">
         </div>

         <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>

   </div>

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>
</body>

</html>