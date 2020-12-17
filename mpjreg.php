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
    <title>SignIn</title>
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
                        var firstpassword=document.formsign.pswd.value;
                        var secondpassword=document.formsign.pswdr.value;
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

                        /*if(!(regx1.test(fsnam)))
                           {
                              document.getElementById("lbl3").style.visibility="visible";
                              return false;
                           }
                        else if(!(regx2.test(lsnam)))
                           {
                              document.getElementById("lbl4").style.visibility="visible";
                              return false;
                           }
                        else if(!(regx3.test(ph)))
                           {
                              document.getElementById("lbl1").style.visibility="visible";
                              return false;
                           }
                        else if(firstpassword!=secondpassword)
                            {
                               alert("password must be same!");
                               return false;
                            }
                         else{
                              return true;
                            }*/

                          if(!(regx1.test(fsnam)) || !(regx2.test(lsnam)) || !(regx3.test(ph)) || (firstpassword!=secondpassword))
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
                               if(firstpassword!=secondpassword)
                                {
                                    //alert("password must be same!");
                                    document.getElementById("lbl2").style.visibility="visible";
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
                       
                         include('connection.php');
                         /*(if(isset($_POST['subn2']))
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
                  /*include('connection.php');    
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


    <div class="signin" style="background-image: url(assets/SigninFormBack.jpg)">
        <div class="container" style="background-color: rgb(0,0,0,0.72);">
            <h1 style="padding-top: 5px; color: orange;">Please fill following details</h1>
            <hr>
            <form name="formsign" id="signupform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return matchpass()" method="POST">
            <div>
         
                     <?php
                           include('connection.php');
                           if(isset($_POST['subm']))
                           {
                            $firstname=mysqli_real_escape_string($con,$_POST['fname']);
                            $lastname=mysqli_real_escape_string($con,$_POST['lname']);
                            $email=mysqli_real_escape_string($con,$_POST['mail']);
                            $phone=mysqli_real_escape_string($con,$_POST['phone']);
                            $upassword=mysqli_real_escape_string($con,$_POST['pswd']);
                            $cpassword=mysqli_real_escape_string($con,$_POST['pswdr']);
                
                            $upassword=password_hash($upassword, PASSWORD_BCRYPT);
                            $cpassword=password_hash($cpassword, PASSWORD_BCRYPT);

                            //$emailquery=" select *from studentpro where stdemailid='$email' ";
                            $emailquery=" select *from useremail where user_emailid='$email' ";
                            $query=mysqli_query($con,$emailquery);

                            $emailcount=mysqli_num_rows($query);

                            if($emailcount>0){
                                echo "<h5 class='alert alert-danger'>You have aldready registered!!<br>Please login instead<br>Click here to Log in:<a href='#' data-toggle='modal' data-target='#loginmod'><u>Log In</u></a></h5><hr>"; 
                                
                            }
                            else{
                                   /*$insertquery=" insert into studentpro(stdname,stdlname,stdcontact,stdemailid,stdpassword) values('$firstname','$lastname','$phone','$email','$upassword') ";
                                   $resquery=mysqli_query($con,$insertquery);
                                   if($resquery){
                                    echo "<h5 class='alert alert-success'>Successfully Registered!!!<br>Now you can proceed by logging in<br>Click here to Log in:<a href='#' data-toggle='modal' data-target='#loginmod'><u>Log In</u></a></h5><hr>"; 
                                   }*/

                                   $insertquery=" insert into user(user_firstname,user_lastname,user_contact,user_password) values('$firstname','$lastname','$phone','$upassword') ";
                                   $resquery=mysqli_query($con,$insertquery);
                                   if($resquery){
                                          $last_id = mysqli_insert_id($con);
                                          $em=" insert into useremail(user_eid,user_emailid) values('$last_id','$email') ";
                                          $emquery=mysqli_query($con,$em);
                                          if($emquery)
                                            {
                                              echo "<h5 class='alert alert-success'>Successfully Registered!!!<br>Now you can proceed by logging in<br>Click here to Log in:<a href='#' data-toggle='modal' data-target='#loginmod'><u>Log In</u></a></h5><hr>"; 
                                            }
                                          else
                                            {
                                              echo "<h5 class='alert alert-danger'>There was some error in processing your data!!</h5><br><hr>";
                                            }
                                   }

                                   else{
                                       echo "<h5 class='alert alert-danger'>There was some error in processing your data!!</h5><br><hr>";
                                   }

                            }


                           }

                     ?>

                </div>
            <div id="signupmessage"></div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color: yellow;">Enter First name:</h4></label>
                    <input type="text" class="form-control" id="ufname" name="fname" onblur="uprCase()" placeholder="First name" style="color: black; background-color: white;" required>
                    <label id="lbl3" style="color: red; font-size:28px; visibility: hidden;">Name should contain characters only!!</label>
                  </div>
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color: yellow;">Enter Last name:</h4></label>
                    <input type="text" class="form-control" id="ulname" name="lname" onblur="uprCase()" placeholder="Last name" style="color: black; background-color: white;" required> 
                    <label id="lbl4" style="color: red; font-size:28px; visibility: hidden;">Name should contain characters only!!</label>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color:yellow"><i class="fa fa-envelope-o"></i> Enter Email Id:</h4></label>
                    <input type="email" class="form-control" id="umail" name="mail" placeholder="Enter Email" style="color: black; background-color: white;" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color:yellow"><i class="fa fa-phone-square"></i> Enter Phone no:</h4></label>
                    <input type="text" class="form-control" id="uphone" name="phone" placeholder="Enter Phone no" style="color: black; background-color: white;" required>
                    <label id="lbl1" style="color: red; font-size:28px; visibility: hidden;">Invalid phone number!!!</label>
                  </div>
                </div>
             
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color: yellow;"><i class="fa fa-key"></i> Enter Password:</h4></label>
                    <input type="password" class="form-control" id="pwd" name="pswd" placeholder="Enter Password" style="color: black; background-color: white;" required>
                    <label id="lbl2" style="color: red; font-size:28px; visibility: hidden;">Both passwords must be same!!!</label>
                  </div>
                  <div class="form-group col-md-6">
                    <label for=""><h4 style="color: yellow;">Confirm Password:</h4></label>
                    <input type="password" class="form-control" id="pwdre" name="pswdr" placeholder="Confirm password" style="color: black; background-color:white;" required>
                  </div>
                </div>
                <input type="submit" name="subm" class="pull-center" value="Sign In" id="subtn" style="height: 50px; width: 100px; cursor: pointer; font-size: 25px; background-color: rgb(138, 18, 138); color: whitesmoke;"><br>
                <div>
                  <h4 class="float-left" style="color:orange">Having an account? </h4><a href="#" data-toggle="modal" data-target="#loginmod"><u><h4>  Log In here</h4></u></a>
                </div><br>
              </form>
          
            </form>
        </div>
    </div>
  

    <footer class="container" style="background-color: yellow;">
        <hr>
        <p>© 2020-2021 BooksShare.com</p>
    </footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
      
</body>

</html>