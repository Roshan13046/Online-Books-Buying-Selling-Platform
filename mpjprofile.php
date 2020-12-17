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

   error_reporting(E_ERROR); 
    
   $base_url = "localhost/phpprog/";


  include('db.php');
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

  <script>

  
function uprCase(){
            var x=formsign.ufname.value;
            x=x.toUpperCase();
            formsign.fname.value=x;
            var y=formsign.ulname.value;
            y=y.toUpperCase();
            formsign.lname.value=y;
        }

             function matchpass()
                   {
                        
                        var ph=document.formsign.phone.value;
                        var fsnam=document.formsign.fname.value;
                        var lsnam=document.formsign.lname.value;
                        
                        regx1=/^[A-Za-z]+$/;
                        regx2=/^[A-Za-z]+$/;
                         
                        regx3=/^[7-9]\d{9}$/;


                       if((regx1.test(fsnam)))
                                  {
                                     document.getElementById("lbl3").style.visibility="hidden";
                                  }
                        if((regx2.test(lsnam)))
                                  {
                                     document.getElementById("lbl4").style.visibility="hidden";
                                  } 
                        if((regx3.test(ph)))
                                  {
                                     document.getElementById("lbl1").style.visibility="hidden";
                                  } 

                     

                          if(!(regx1.test(fsnam)) || !(regx2.test(lsnam)) || !(regx3.test(ph)))
                             {
                                if(!(regx1.test(fsnam)))
                                 {
                                     document.getElementById("lbl3").style.visibility="visible";
                                 }
                                if(!(regx2.test(lsnam)))
                                 {
                                     document.getElementById("lbl4").style.visibility="visible";
                                 }
                               if(!(regx3.test(ph)))
                                 {
                                    document.getElementById("lbl1").style.visibility="visible";
                                 }
                               return false;
                             }
                          else 
                             {
                                return true;
                             }
                   }
    </script>
</head>

<body style="background-image:url(assets/SigninFormBack.jpg);">

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

  <?php

       $ufid=$_SESSION['userid'];

       if(isset($_POST['submit']))
          {

               $firstname=$_POST['fname'];
               $lastname=$_POST['lname'];
               $phone=$_POST['phone'];
               $email=$_POST['email'];

               $con=get_connection();

               $update1=" update user set user_firstname='$firstname',user_lastname='$lastname',user_contact='$phone' where user_id='$ufid' ";
               $update1query=mysqli_query($con,$update1);

               $update2=" update useremail set user_emailid='$email' where user_eid='$ufid' ";
               $update2query=mysqli_query($con,$update2);

               if($update1query && $update2query)
                  {
                      echo "<h4 class='alert alert-success'>Updated Successfully!</h4>";
                  }
               else
                 {
                    echo "<h4 class='alert alert-danger'>Information not updated successfully</h4>"; 
                 }


          }


          $con = get_connection();
          $seldet=" select *from user where user_id='$ufid' ";
          $seldetquery=mysqli_query($con,$seldet);
          $userdetails=mysqli_fetch_array($seldetquery);

          $seleml=" select *from useremail where user_eid='$ufid' ";
          $selemlquery=mysqli_query($con,$seleml);
          $usereml=mysqli_fetch_array($selemlquery);
          
  ?>

    <div class="container" style="margin-top:90px; background-color: rgb(255, 255, 26); margin-bottom:40px; opacity:0.9;">

    <h1 style='margin-top:10px; color:purple;' align="center">General Accounts Settings</h1>

    <form name="formsign" onsubmit="return matchpass()" method="POST" style="margin-top:30px; padding:25px;">
                    <div class="form-group row">
                        <label for="fname" class="col-sm-2 col-form-label" style="color: green;"><strong><h4>First name:</h4></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="fname" class="form-control" onblur="uprCase()" value="<?php echo $userdetails['user_firstname'];?>" required>
                        <label id="lbl3" style="color: red; font-size:28px; visibility: hidden;">Name should contain characters only!!</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lname" class="col-sm-2 col-form-label" style="color: green;"><strong><h4>Last name:</h4></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="lname" class="form-control" onblur="uprCase()" value="<?php echo $userdetails['user_lastname'];?>" required>
                        <label id="lbl4" style="color: red; font-size:28px; visibility: hidden;">Name should contain characters only!!</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label" style="color: green;"><strong><h4>Phone number:</h4></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" value="<?php echo $userdetails['user_contact'];?>" required>
                        <label id="lbl1" style="color: red; font-size:28px; visibility: hidden;">Invalid phone number!!!</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label" style="color: green;"><strong><h4>Email id:</h4></strong></label>
                        <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="<?php echo $usereml['user_emailid'];?>" required>
                        </div>
                    </div>

                    <input type="submit" style="margin-left:190px; margin-top:20px;" value="Submit" class="btn btn-primary" type="submit" name="submit">

    </form>


    </div>

  <div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>