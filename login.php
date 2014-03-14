<?php 
session_start();

if (isset($_SESSION["logged_in"]) && true === $_SESSION["logged_in"]){
  header("Location: /cms");
}

if (isset($_POST["submit"]) && "1" === $_POST["submit"]) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  include("./cms/db_connect.php");

  $sql = "SELECT * FROM `users` WHERE email = '$email' LIMIT 1";
  $result = mysql_query($sql);
  $user = mysql_fetch_array($result);
  
  if (!password_verify($password, $user["password"])) {
      $message = "Incorrect email or password";
  } else {
    $_SESSION["logged_in"] = true;
    $_SESSION["user_id"] = $user["user_id"];
    header("Location: /cms");
  }
}
?>
<!doctype>
<html>
  <head>
    <meta charset="utf-8">
    <title>Julia Ann Campbell</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Bilbo+Swash+Caps|Felipa|Swanky+and+Moo+Moo|Just+Me+Again+Down+Here' rel='stylesheet' type='text/css'>
    <script src="https://code.jquery.com/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="../dist/js/bootstrap.min.js"></script>
    <link href="../dist/css/bootstrap.css" rel="stylesheet">
    
    <style type="text/css"> @import url(../css/julia.css); </style>
  </head>
  <body>
    <div class="container">
      <?php include("header.php"); ?>
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <h3>Blog Login</h3>
          <form action="" method="post" class="form-horizontal" role="form" name="login">
              <div class="form-group">
                <div class="col-sm-10">
                 
          		<?php
          			if (isset($message)) {
          				echo "<p class='message'>".$message."</p>";
          			}
          		?>
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="hidden" name="submit" value="1">
                  <button type="submit" class="btn btn-primary">Login</button> 
                </div>
              </div>
          </form>
        </div>
      </div>
      <?php include("footer.php"); ?>
    </div>
  </body>
</html>