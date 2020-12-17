<?php
   session_start();

   if(isset($_REQUEST['logoutbtn']))
   {
       session_unset();
       session_destroy();
       echo "<script>location.href='mpjhome.php'</script>";
   }
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="mpstyle.css">
  <title>Home Page</title>
</head>

<body style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOL3n9u-qiaoKQlZrZn0MvDZu4vcp8vpkVcw&usqp=CAU); background-attachment: fixed; background-size: cover;">

 <div class="navigation">
    <nav class="navbar navbar-expand-lg navbar custnav">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">BooksShare.com</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="logland.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mpjsearchlog.php"><i class="fa fa-fw fa-search"></i> Search books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="mpjupload.php"><i class="fa fa-shopping-cart"></i>   Sell book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="faqlog.php">FAQs  <i class="fa fa-commenting"></i></a>
          </li>
        </ul>
        <div class="logsign">
          <form action="#" method="POST">
          <a href="mpjprofile.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Profile</a>
          <!--<a href="mpjbooks.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Books</a>-->
          <a href="mpjbooklist.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Books</a>
          <a href="mpjrequest.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">Requests</a>
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logoutbtn">Logout</button>
          </form>
        </div>
      </div>
    </nav>
  </div>

 
  </div style="padding-top:70px; padding-left=100px; font-size:50px;">
          <?php

                if(!isset($_SESSION['userid']))
                {
                  echo "<script>location.href='mpjhome.php'</script>"; 
                }
                else
                {
                  include('connection.php');
                   //echo "Welcome!!! Your user id is:".$_SESSION['userid'];
                   $uilog=$_SESSION['userid'];
                   $namq=" select *from user where user_id='$uilog' "; 
                   $namquery=mysqli_query($con,$namq);
                   $namr=mysqli_fetch_assoc($namquery);
                   $uifnam=$namr['user_firstname'];
                   $uilnam=$namr['user_lastname'];
                   
                }

          ?>

         <div class="hero_section"  style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0KiJCtInx0xwWQBx3Z-Qw1aHeq8mjvpUVBA&usqp=CAU),linear-gradient(rgb(95, 84, 84),rgb(95, 84, 84));">
            <div class="content">
              <h1>Welcome <?php echo $uifnam." ".$uilnam; ?></h1> 
      <!-- Replace $username instead of Kedar Kutaskar -->
              <h5>Buy books from your seniors at best prices.</h5>
              <h5 style="margin-bottom: 5%;">Also sell your old books to yours juniors.</h5>
              <a href="mpjprofile.php" class="btn btn-outline-light my-2 my-sm-0 btn-lg"> <i class="fa fa-fw fa-user"></i> My Profile »</a>
            </div>
          </div> 
  <div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
