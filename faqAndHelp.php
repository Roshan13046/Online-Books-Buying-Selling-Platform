<?php
    session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Sell FAQs</title>	

  <link rel="stylesheet" href="mpstyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://use.fontawesome.com/30c21ac8e0.js"></script>          
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
          <li class="nav-item active">
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



<div class="container" style="margin-top:80px;">
	
	<div class="row" style="margin-bottom:20px;">
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
      <!-- <li ><a data-toggle="tab" href="#tab1" aria-selected="true" class="active" style="color:red; height:60px; width:150px;">Frequently asked question's</a></li> -->
        <li style="color:red; padding:5px; height:60px; width:150px;  background-color: yellow; border-style: solid; border-radius:10px; border-color: black; margin-right: 80px;"><a href="#tab1" data-toggle="tab"  aria-selected="true" class="active" >Frequently asked question's</a></li>
				<li style="color:red; padding:15px; height:60px; width:150px;  background-color:lime ;border-style: solid; border-color: black;border-radius:10px; border-color: black; margin-right: 80px;"><a href="#tab2" data-toggle="tab"  aria-selected="false" >Need Help?</a></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			
			<div class="tab-content">
				<div id="tab1" class="tab-pane fade show active">
					<div class="accordion">
						<div class="card">
							<div class="card-header" id="infraOne">
								<a href="#collapseOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
									<p class="mb-0">
								  How do I register and Login?
									</p>
								</a>
							</div>
							<div id="collapseOne" class="collapse" aria-labelledby="infraOne" data-parent="#accordion">
								<div class="card-body">
								 Click on SignUp. Fill the required credentials and Save the data and Login with EmailID and Password.
								</div>
							</div>
						</div><!-- close card-->
						<div class="card">
							<div class="card-header" id="infraTwo">
								<a href="#collapseTwo" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  <p class="mb-0">How can I update my Profile?</p>
								</a>
							</div>
							<div id="collapseTwo" class="collapse" aria-labelledby="infraTwo" data-parent="#accordion">
								<div class="card-body">
								Firstly Login then Click on My Profile at Top and then update your profile and submit. 
								</div>
							</div>
						</div><!-- card-->
						<div class="card">
							<div class="card-header" id="infraThree">
								<a href="#collapseThree" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									<p class="mb-0">How can I post and upload my books?</p>
								</a>
							</div>
							<div id="collapseThree" class="collapse" aria-labelledby="infraThree" data-parent="#accordion">
								<div class="card-body">
								Firstly Register and Signup.Click on Sell Book at top of nav bar.Then Enter the required Book details and Click on upload book button.You have succesfully uploaded your books.
								</div>
							</div>
						</div><!-- card-->
                        <div class="card">
							<div class="card-header" id="infraFour">
								<a href="#collapseFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									<p class="mb-0">
								  How can I buy books from site?
									</p>
								</a>
							</div>
							<div id="collapseFour" class="collapse" aria-labelledby="infraFour" data-parent="#accordion">
								<div class="card-body">
								Firstly Register and Login.Then click on Search Books at top of nav bar.Then fill the required Book credentials and Click on Proceed button.The required Books result will be appeared and choose the required books. Click on view details button and further book details will be shown. To buy a book click on contact seller button. Your request for the particular book along with your contact details will be mailed to the seller.And seller details will be mailed to you.                                    
								</div>
							</div>
						</div><!-- close card-->
						<div class="card">
							<div class="card-header" id="infraFive">
								<a href="#collapseFive" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
								  <p class="mb-0">How can I check my uploaded books?</p>
								</a>
							</div>
							<div id="collapseFive" class="collapse" aria-labelledby="infraFive" data-parent="#accordion">
								<div class="card-body">
								Firstly, Login then click on my books. Your Unsold and Sold Books will displayed along with their deatils.
								</div>
							</div>
						</div><!-- card-->						
                        <div class="card">
							<div class="card-header" id="infraSix">
								<a href="#collapseSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
									<p class="mb-0">
								  How can I contact the book seller?
									</p>
								</a>
							</div>
							<div id="collapseSix" class="collapse" aria-labelledby="infraSix" data-parent="#accordion">
								<div class="card-body">
								Firstly Register and Login.Then click on Search Books at top of nav bar.Then fill the required Book credentials and Click on Proceed button.The required Books result will be appeared and choose the required books. Click on view details button and further book details will be shown. To buy a book click on contact seller button. Your request for the particular book along with your contact details will be mailed to the seller.And seller details will be mailed to you.                                    
								</div>
							</div>
						</div><!-- close card-->						
						<div class="card">
							<div class="card-header" id="infraSeven">
								<a href="#collapseSeven" class="collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
									<p class="mb-0">How can I contact the Developers?</p>
								</a>
							</div>
							<div id="collapseEight" class="collapse" aria-labelledby="infraEight" data-parent="#accordion">
								<div class="card-body">
								Go to FAQ' and Click on about us tab. The Develeopers details will be shown. You can further conatct them.
								</div>
							</div>
						</div><!-- card-->
					</div><!-- accordion-->
				</div><!-- tab 1-->
			<div id="tab2" class="tab-pane fade">
				<div class="accordion">
					<div class="card">
						<div class="card-header" id="aboutOne44">
							<a href="#collapseOne44"   data-toggle="collapse" data-target="#collapseOne44" aria-expanded="false" aria-controls="collapseOne44">
								<p class="mb-0">How can I perform a transaction?</p>
							</a>
						</div>
						<div id="collapseOne44" class="collapse" aria-labelledby="aboutOne44" data-parent="#accordion">
							<div class="card-body">
							Currently we are not providing any Transaction services. Perform your transaction using other sources manually.
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="aboutTwo33">
							<a href="#collapseTwo33" class="collapsed" data-toggle="collapse" data-target="#collapseTwo33" aria-expanded="false" aria-controls="collapseTwo33">
							  <p class="mb-0">How will I receive my delivery?</p>
							</a>
						</div>
						<div id="collapseTwo33" class="collapse" aria-labelledby="aboutTwo33" data-parent="#accordion">
							<div class="card-body">
							Contact the Book Seller and take the Book Delivery manually.
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="about22">
							<a href="#collapseThree22" class="collapsed" data-toggle="collapse" data-target="#collapseThree22" aria-expanded="false" aria-controls="collapseThree22">
							  <p class="mb-0">How can I register a complaint?</p>
							</a>
						</div>
						<div id="collapseThree22" class="collapse" aria-labelledby="aboutThree22" data-parent="#accordion">
							<div class="card-body">
							To register a Complaint contact the Website Developers through their contact details.
							</div>
						</div>
					</div>
                    <div class="card">
						<div class="card-header" id="about11">
							<a href="#collapse11"   data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
								<p class="mb-0">Site has server problem?</p>
							</a>
						</div>
						<div id="collapse11" class="collapse" aria-labelledby="about11" data-parent="#accordion">
							<div class="card-body">
							Please Conatct the Website maintainers with their Contact details.
							</div>
						</div>
					</div>							
				</div><!-- accordion-->
			</div><!-- tab2 -->
            

		  </div><!-- tab content-->
		</div>
	</div>
</div>	

	</body>
</html>
