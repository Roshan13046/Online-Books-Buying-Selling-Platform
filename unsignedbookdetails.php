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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="mpstyle.css">
  <title>Search books</title>
  <script>
           function mycontact()
              {
                  alert("You have to first sign/login in inorder to contact the seller!!!");
              }
  </script>
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
            <a class="nav-link" href="mpjhome.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="mpjsearch.php"><i class="fa fa-fw fa-search"></i> Search books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="faqAndHelp.php">FAQs  <i class="fa fa-commenting"></i></a>
          </li>
        </ul>
        <div class="logsign">
          <button class="btn btn-outline-light my-2 my-sm-0" type="button" id="Login" data-toggle="modal" data-target="#loginmod"><i class="fa fa-fw fa-user"></i> Log In</button>
          <a href="mpjreg.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">Sign Up</a>
        </div>
      </div>
    </nav>
  </div>

  <div class="modal fade" id="loginmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <form name="formlog1" id="logform1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Fill in the following details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    <?php
                       
                        /* include('connection.php');
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
                                              $('#loginmod').modal('show');
                                              });</script>";
                                          }
                                }
                            else
                               {
                                    echo "<h5 class='alert alert-danger'>Incorrect email id!!</h5><hr>";
                                    echo "<script>$(document).ready(function() {
                                      $('#loginmod').modal('show');
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
                            <a class="pull-right" data-toggle="modal" data-target="#myforget" style="cursor: pointer; color:blue"><u>Forgot Password</u></a>
                            <div style="padding-top:25px;">
                               <h5>Not having account? <a href="mpjreg.php" style="cursor: pointer;"><u>Sign up here</u><a></h5>
                            </div>
                  </div>
                  <div class="modal-footer">
                       <input type="reset" value="Close" class="btn btn-secondary" data-dismiss="modal">
                 </div>
            </div>
        </div>
      </form>
    </div>

    <div class="modal" id="myforget">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Forgot Password? Enter your email-id</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form name="formpass" id="passform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              <?php
                 /* include('connection.php');    
                  if(isset($_POST['subn3']))
                      {
                          $emailreset=$_POST['email3'];
                          $to_email=$emailreset;
                          $subject="Verifaction of password";
                          $randpass=mt_rand(0,99999);
                          $body="Your verification code is:".$randpass;
                          $headers = "From: dhamkeatharva@gmail.com";

                          $_SESSION['resetemail']=$emailreset;
                          $_SESSION['verifcode']=$randpass;

                          $emailforget=mysqli_real_escape_string($con,$_POST['email3']);
                          $emailqueryforget=" select *from studentpro where stdemailid='$emailforget' ";
                          $queryforget=mysqli_query($con,$emailqueryforget);

                          $emailcountforget=mysqli_num_rows($queryforget);

                          if($emailcountforget)
                            {
                                    
                                  if(mail($to_email, $subject, $body, $headers)) {
                                       $_SESSION['verifmsg']="<h4 style='color: blue; padding-left:20px;'><i>Verification code has been mailed.<br>Please check you mail box</i></h4><hr>";
                                       echo "<script>location.href='resetpass.php'</script>";
                                      //echo "<h5 class'alert alert-secondary'>verification code sent to your mail</h5><br>";
                                  }                   
                                  else {
                                      echo "<h5 class='alert alert-danger'>There was some problem in sending the verification code to your mail</h5><hr>";
                                      echo "<script>$(document).ready(function() {
                                        $('#myforget').modal('show');
                                        });</script>";
                                  }

                            }
                          else
                            {
                                  echo "<h5 class='alert alert-danger'>The email address you entered is not registered!!<br>Please enter the email address which you had provided during registration!</h5><hr>";
                                  echo "<script>$(document).ready(function() {
                                    $('#myforget').modal('show');
                                    });</script>";
                            }
                 

                      }*/
                      include('connection.php');    
                      if(isset($_POST['subn3']))
                          {
                              $emailreset=$_POST['email3'];
                              $to_email=$emailreset;
                              $subject="Verifaction of password";
                              $randpass=mt_rand(0,99999);
                              $body="Your verification code is:".$randpass;
                              $headers = "From: dhamkeatharva@gmail.com";
    
                              //$_SESSION['resetemail']=$emailreset;
                              $_SESSION['verifcode']=$randpass;
    
                              $emailforget=mysqli_real_escape_string($con,$_POST['email3']);
                              //$emailqueryforget=" select *from studentpro where stdemailid='$emailforget' ";
                              $emailqueryforget=" select *from useremail where user_emailid='$emailforget' ";
                              $queryforget=mysqli_query($con,$emailqueryforget);
    
                              $emailcountforget=mysqli_num_rows($queryforget);
    
                              if($emailcountforget)
                                {
                                        
                                  $fru=mysqli_fetch_assoc($queryforget);
                                  $_SESSION['resetuid']=$fru['user_eid'];
                                      if(mail($to_email, $subject, $body, $headers)) {
                                           $_SESSION['verifmsg']="<h4 style='color: blue; padding-left:20px;'><i>Verification code has been mailed.<br>Please check you mail box</i></h4><hr>";
                                           echo "<script>location.href='resetpass.php'</script>";
                                          //echo "<h5 class'alert alert-secondary'>verification code sent to your mail</h5><br>";
                                      }                   
                                      else {
                                          echo "<h5 class='alert alert-danger'>There was some problem in sending the verification code to your mail</h5><hr>";
                                          echo "<script>$(document).ready(function() {
                                            $('#myforget').modal('show');
                                            });</script>";
                                      }
    
                                }
                              else
                                {
                                      echo "<h5 class='alert alert-danger'>The email address you entered is not registered!!<br>Please enter the email address which you had provided during registration!</h5><hr>";
                                      echo "<script>$(document).ready(function() {
                                        $('#myforget').modal('show');
                                        });</script>";
                                }
                     
    
                          }
    

              ?>
            <div class="form-group">
               <label>Enter email address:</label>
               <input type="email" class="form-control" id="myemail3" name="email3" placeholder="Email" required>
            </div>
            <input type="submit" name="subn3" class="btn btn-success green mx-auto" value="Submit" style="align-self: center;" data-backdrop="static">
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


  <?php


  if($_SESSION['rld']==1)
     {
       $suid=$_SESSION['unid'];
       $bookid=$_SESSION['unbk'];
     }
  else
    {
        $_SESSION['unid']='';
        $_SESSION['unbk']='';
        $suid = $_POST['uid'];
        $bookid=$_POST['bkid'];
        $_SESSION['unid']=$_POST['uid'];
        $_SESSION['unbk']=$_POST['bkid'];
    }

    $_SESSION['goback']=1;
    $_SESSION['rld']=1;

    include('connection.php');
      
       $bkinfo=" select *from book where book_id='$bookid' ";
       $bkquery=mysqli_query($con,$bkinfo);
       $bookinfo=mysqli_fetch_array($bkquery);
       $usinfo=" select *from user where user_id='$suid' ";
       $usquery=mysqli_query($con,$usinfo);
       $userinfo=mysqli_fetch_array($usquery);

?>
  <a href="unsignedsearchres.php" class="btn btn-primary" style="margin-top: 1%; margin-left: 1%;">Back</a>

  <h1 align="center"><u>Book Details</u></h1>

 <!--<div class="container" style="margin-left:300px; margin-top:30px; margin-bottom:30px; padding:35px; border: 1px solid red; border-radius:20px; width:55%">-->
<div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
  <div class="container float-left" style=" border: 1px solid red; margin-left:60px; padding:20px; margin-bottom:20px; border-radius:20px; width:55%">
      <h3>Book Image:<h3>   
      <img src="<?php echo $bookinfo['book_image']; ?>" height="400" width="400"><br><br>

      <h3><strong>Book Name:</strong><?php echo " ".$bookinfo['book_name']; ?></h3><br>

      <h3><strong>Subject:</strong><?php echo " ".$bookinfo['subject']; ?></h3><br>

      <h3><strong>Author Name:</strong><?php echo " ".$bookinfo['author_name']; ?></h3><br>

      <h3><strong>Edition:</strong><?php echo " ".$bookinfo['edition']; ?></h3><br>

      <h3><strong>Price:<?php echo " "; ?></strong><i class='fa fa-rupee'></i><?php echo $bookinfo['price']; ?></h3><br>

      <h3><strong>Syllabus Pattern:</strong><?php echo " ".$bookinfo['course']; ?></h3><br>

      <h3><strong>Class:</strong><?php echo " ".$bookinfo['year']; ?></h3><br>

      <h3><strong>Branch:</strong><?php echo " ".$bookinfo['department']; ?></h3><br>

  </div>

  <div class="container float-right" style=" border: 1px solid red; margin-right:35px; padding:15px; border-radius:20px; width:35%">

      <h3><i class="fa fa-user"></i><strong>  Seller's Name:</strong></h3>
      <h3><?php echo $userinfo['user_firstname']." ".$userinfo['user_lastname']; ?></h3><br>

      <button type="button" class="btn btn-primary" style="margin:left:150px; height:40px;" onclick="mycontact()">Contact Seller</button>


  </div>

</div>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>