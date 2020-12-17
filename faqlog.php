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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Sell FAQs</title>
	<!-- <link rel="stylesheet" type="text/css" href="styles.css">	 -->
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
            <a class="nav-link" href="logland.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mpjsearchlog.php"><i class="fa fa-fw fa-search"></i> Search books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="mpjupload.php"><i class="fa fa-shopping-cart"></i>   Sell book</a>
          </li>
          <li class="nav-item active">
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

<div class="container"  style="margin-top:80px;">
	
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
