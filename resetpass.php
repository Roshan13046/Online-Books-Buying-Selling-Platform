<?php
   session_start();
   if(isset($_SESSION['userid']))
    {
        echo "<script>location.href='logland.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mpstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>  
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="index.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Reset Password</title>
</head>
<body style="background-image: url(https://images-na.ssl-images-amazon.com/images/I/61K1vdbKyVL.jpg);">

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
            <a class="nav-link" href="mpjhome.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mpjsearch.php"><i class="fa fa-fw fa-search"></i> Search books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="faqAndHelp.php">FAQs  <i class="fa fa-commenting"></i></a>
          </li>
        </ul>
                <!--<div class="logsign">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="button" id="Login" data-toggle="modal"
                        data-target="#exampleModalCenter">Log In</button>
                    <button class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">Sign Up</button>
                </div>-->
            </div>
        </nav>
    </div>

 
    <div class="modal fade" id="loginmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Fill in the following details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form name="formlog2" id="logform2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"> 
                    <?php
                       
                         /*include('connection.php');
                         if(isset($_POST['subn2']))
                         {
                            $emailog=mysqli_real_escape_string($con,$_POST['maillog']);
                            $upasswordlog=mysqli_real_escape_string($con,$_POST['passlog']);
                            $emailquerylog=" select *from studentpro where stdemailid='$emailog' ";
                            $querylog=mysqli_query($con,$emailquerylog);

                            $emailcountlog=mysqli_num_rows($querylog);
                   
                            
                              if($emailcountlog)
                                {

                                      $email_pass=mysqli_fetch_assoc($querylog);
                                      $db_pass=$email_pass['stdpassword'];

                                      $pass_decode=password_verify($upasswordlog, $db_pass);

                                      if($pass_decode)
                                         {
                                            $_SESSION['useremail']=$_POST['maillog'];
                                            echo "<script>location.href='logland.php'</script>";
                                         }
                                      else{
                                             echo "<h5 class='alert alert-danger'>Incorrect Password!!</h5><hr>";
                                             echo "<script>$(document).ready(function() {
                                              $('#loginmod2').modal('show');
                                              });</script>";
                                          }
                                }
                            else
                               {
                                    echo "<h5 class='alert alert-danger'>Incorrect email id!!</h5><hr>";
                                    echo "<script>$(document).ready(function() {
                                      $('#loginmod2').modal('show');
                                      });</script>";

                                    
                               }
                         }*/

                         include('connection.php');
                         if(isset($_POST['subn2']))
                         {
                            $emailog=mysqli_real_escape_string($con,$_POST['maillog']);
                            $upasswordlog=mysqli_real_escape_string($con,$_POST['passlog']);
                            //$emailquerylog=" select *from studentpro where stdemailid='$emailog' ";
                            $emailquerylog=" select *from useremail where user_emailid='$emailog' ";
                            $querylog=mysqli_query($con,$emailquerylog);

                            $emailcountlog=mysqli_num_rows($querylog);
                   
                            
                              if($emailcountlog)
                                {

                                      $email_pass=mysqli_fetch_assoc($querylog);
                                      //$db_pass=$email_pass['stdpassword'];
                                      $u_id=$email_pass['user_eid'];

                                      $passquerylog=" select *from user where user_id='$u_id' ";
                                      $passquery=mysqli_query($con,$passquerylog);
                                      if($passquery)
                                         {
                                               $pass=mysqli_fetch_assoc($passquery);
                                               $db_pass=$pass['user_password'];
                                               $pass_decode=password_verify($upasswordlog,$db_pass);
                                               if($pass_decode)
                                                  {
                                                      $_SESSION['userid']=$u_id;
                                                      echo "<script>location.href='logland.php'</script>";     
                                                  }
                                               else
                                                  {
                                                       echo "<h5 class='alert alert-danger'>Incorrect Password!!</h5><hr>";
                                                       echo "<script>$(document).ready(function() {
                                                       $('#loginmod').modal('show');
                                                       });</script>";
                                                  }
                                         }
                                       else
                                         {
                                              echo "<h5 class='alert alert-danger'>There is a problem logging in due to some techincal reasons!!</h5><hr>";
                                              echo "<script>$(document).ready(function() {
                                              $('#loginmod').modal('show');
                                              });</script>";    
                                         }

                                            /*$pass_decode=password_verify($upasswordlog, $db_pass);

                                            if($pass_decode)
                                              {
                                                  $_SESSION['useremail']=$_POST['maillog'];
                                                  echo "<script>location.href='logland.php'</script>";
                                              }
                                           else
                                             {
                                                  echo "<h5 class='alert alert-danger'>Incorrect Password!!</h5><hr>";
                                                  echo "<script>$(document).ready(function() {
                                                  $('#loginmod').modal('show');
                                                  });</script>";
                                             }*/
                                }
                            else
                               {
                                    echo "<h5 class='alert alert-danger'>Incorrect email id!!</h5><hr>";
                                    echo "<script>$(document).ready(function() {
                                      $('#loginmod').modal('show');
                                      });</script>";

                                    
                               }
                         }


                    ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter email address:</label>
                                <input type="email" name="maillog" class="form-control" id="loginmailId" aria-describedby="emailHelp" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Enter Password:</label>
                                <input type="password" name="passlog" class="form-control" id="loginPassworduser" placeholder="Password" required>
                            </div>
                            <input type="submit" name="subn2" value="Log In" class="btn btn-primary" data-backdrop="static">
                    </form>
                  </div>
                  <div class="modal-footer">
                       <input type="reset" value="Close" class="btn btn-secondary" data-dismiss="modal">
                 </div>
            </div>
        </div>
    </div>

<div class="signin">
   <div class="container" style="background-color: rgb(230, 230, 69);">
      <form name="formreset" id="resetform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" style="margin-top:20px; padding-top:15px">
         <?php
                
               if(isset($_SESSION['verifmsg']))
                 {
                     echo $_SESSION['verifmsg'];
                 }
               //echo "<script>alert('Verification code has been mailed!!. Please check the mail box!')</script>";

               if(isset($_POST['resubm']))
               {
                  unset($_SESSION['verifmsg']);
                    if($_POST['vercode']==$_SESSION['verifcode'] && $_POST['pswdset']==$_POST['pswdrset'])
                      {
                              include('connection.php');
                              //$emailresetcheck=mysqli_real_escape_string($con,$_SESSION['resetemail']);
                              $emailresetuid=mysqli_real_escape_string($con,$_SESSION['resetuid']);
                              $rpasswordset=mysqli_real_escape_string($con,$_POST['pswdset']);

                              $rpasswordset=password_hash($rpasswordset, PASSWORD_BCRYPT);

                              //$resetpwsd= " update studentpro set stdpassword='$rpasswordset' where stdemailid='$emailresetcheck' ";
                              $resetpwsd=" update user set user_password='$rpasswordset' where user_id='$emailresetuid' ";
                            
                              $resetquery=mysqli_query($con,$resetpwsd);

                              if($resetquery)
                              {
                                
                                    echo "<h5 class='alert alert-success'>Password updated successfully!!!<br>Now you can proceed by logging in.<br>Click here to login:<a href='#' data-toggle='modal' data-target='#loginmod'><u>Log In</u></a></h5><hr>";
                              }
                              else
                              { 
                                  echo "<h5 class='alert alert-danger'>There was some problem in updating your password!<br>Password could not be upadated!!</h5><hr>";
                              }

                      }
                    else
                     {
                           if($_POST['vercode']!=$_SESSION['verifcode'])
                            {
                                echo "<h5 class='alert alert-danger'>Enter valid verification code!!</h5>";
                            }
                           if($_POST['pswdset']!=$_POST['pswdrset'])
                           {
                               echo "<h5 class='alert alert-danger'>Both the passwords must be same!!</h5>";
                           }
                        echo "<hr>";
                     }
                }

         ?>
          <div class="form-group col-md-12">
                 <label><h4 style="color: red;">Enter the verification code:</h4><label>
                 <input type="text" class="form-control" id="vcd" name="vercode" placeholeder="Verification Code" style="color: black; background-color: rgb(133, 211, 70); width:600px;" required>
          </div>
          <div class="form-group col-md-12">
                <label><h4 style="color: red;"><i class="fa fa-key"></i> Enter new Password:</h4></label>
                <input type="password" class="form-control" id="pwdes" name="pswdset" placeholder="Enter Password" style="color: black; background-color: rgb(133, 211, 70);" required>
          </div>
          <div class="form-group col-md-12">
                <label><h4 style="color: red;">Confirm  Password:</h4></label>
                <input type="password" class="form-control" id="pwdres" name="pswdrset" placeholder="Confirm password" style="color: black; background-color: rgb(133, 211, 70);" required>
          </div>
          <input type="submit" name="resubm" class="pull-center" value="Reset Password" id="subtnres" style="height: 50px;  cursor: pointer;  width: 200px; font-size: 25px; background-color: rgb(138, 18, 138); color: whitesmoke;"><br>
      </form>

   </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>