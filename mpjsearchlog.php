<?php
   session_start();

   if(!isset($_SESSION['userid']))
   {
     echo "<script>location.href='mpjhome.php'</script>"; 
   }
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

<body>

<div class="navigation">
    <nav class="navbar navbar-expand-lg navbar custnav">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">BooksShare.com</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="logland.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item active">
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
  <?php 
      $_SESSION['gobacklog']=0;
  ?>
  <div class="search" style="background-image: url(https://www.brickunderground.com/sites/default/files/styles/blog_primary_image/public/blog/images/iStock-910031442.jpg);">
      <div class="container" style="background-color: black; opacity:0.8;">
          <h1 style="color: orange">Please fill following information</h1>
          <hr>
        <!--<form name="formfill" action="mpjsearchreslog.php" id="frm1" method="POST">-->
        <form name="formfill" action="signedsearchres.php" id="frm1" method="POST">

            <div class="form-row">
              <div class="form-group row float-left">
                  <!-- <h3 class="">Select your branch :</h3> -->
                  <label for="branch" style="margin-left: 20px;"><h4 style="color: white;">Select your branch:</h4></label>
                  <select name="branch" id="branch" class="box" style="margin-left: 60px; height: 40px; width: 200px;">
                    <option class="branchlist" value="Computer">Computer Engineering</option>
                    <option class="branchlist" value="Mechanical">Mechanical Engineering</option>
                    <option class="branchlist" value="IT">Information Technology</option>
                    <option class="branchlist" value="Electrical">Electrical Engineering</option>
                    <option selected class="branchlist" value="E&TC">E&TC Engineering</option>
                    <option class="branchlist" style="background-color: white;" value="Printing">Printing Engineering</option>
                  </select>
              </div><br>
      
                  <div class="form-group row float-right" style="margin-left: 120px;">
                     <!-- <h3 class="float-left" style="margin-right: 700px;">Select your class :</h3> -->
                     <label for="classyear"><h4 style="color: white;">Select your class:</h4></label>
                     <select name="classyear" id="classyear" class="box" style="margin-left: 50px; height: 40px; width: 80px; color: black; background-color: white">
                       <option  value="FE">FE</option>
                       <option  value="SE">SE</option>
                       <option  value="TE">TE</option>
                       <option  value="BE">BE</option>
                     </select>
                  </div><br>
           </div><br>

            <!-- <div style="margin-top: 160px"> -->
            <div class="form-group row">
              <!-- <h3>Choose syllabus pattern :</h3><br> -->
              <label for="pattern"><h4 style="color: white; margin-left: 15px;">Choose syllabus pattern:</h4></label>
              <select name="pattern" id="pattern" style="margin-left: 20px; background-color: white; color:black">
                <option value="2008">2008 Pattern</option>
                <option value="2012">2012 Pattern</option>
                <option value="2015" selected>2015 Pattern</option>
                <option value="2019">2019 Pattern</option>
              </select>
            </div>

                         
           <div style="margin-top: 45px;" required>
               <h4 style="color: white;">Select Semester:</h4><br>
               <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="customRadio1" name="sem" value="1" required>
                <label class="custom-control-label" for="customRadio1" style="color:rgb(102, 255, 51);"><h5>Semester 1</h5></label>
               </div>
               <div class="custom-control custom-radio custom-control-inline" style="margin-left: 100px;">
                <input type="radio" class="custom-control-input" id="customRadio2" name="sem" value="2" required>
                <label class="custom-control-label" for="customRadio2"  style="color:rgb(102, 255, 51);"><h5>Semester 2</h5></label>
               </div>
          </div>


          <input type="submit" name="subsearch" value="Proceed" id="subtn" class="btn" style="background-color: rgb(255, 51, 0); color: aliceblue; margin-left: 500px;">
    

      </form>
      </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
