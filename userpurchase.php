<?php
   session_start();
?>
<!DOCTYPE html>
<html>

	<head>
    	<title>Home Page</title>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	    <link rel="stylesheet" href="mpstyle.css">
		<link rel="stylesheet" href="style.css">
		
		<script>
                 function checkid()
				   {
                       var numid=document.form1.usersid1.value;

					   var number = /^[0-9]+$/;

					   if((!number.test(numid)))
                                  {
                                       alert("User-id should be number only!!")
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

<?php

if(!isset($_SESSION['adminid']))
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


	<div class="navigation">
    <nav class="navbar navbar-expand-lg navbar custnav">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#" style="font-size: 25px;">BooksShare.com</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="admin.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="monthreport.php"><i class="fa fa-shopping-cart"></i>   Get Report</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="searchforinfo.php"><i class="fa fa-fw fa-search"></i> Users Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="searchtodelete.php"><i class="fa fa-fw fa-search"></i> Delete Users</a>
		  </li>
		  <li class="nav-item">
            <a class="nav-link" href="userpurchase.php"><i class="fa fa-fw fa-search"></i> Buyer Info</a>
		  </li>
		  <li class="nav-item">
            <a class="nav-link" href="userupload.php"><i class="fa fa-fw fa-search"></i> Seller Info</a>
          </li>
        </ul>
        <div class="logsign">
          <form action="#" method="POST">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logoutbtn" style="font-size: 20px;">Logout</button>
          </form>
        </div>
      </div>
    </nav>
</div>


<a href="admin.php" class="btn btn-primary" style="margin-top: 1%; margin-left: 1%; font-size: 20px;">Back</a>



	<div class="container-fluid">
		<div>
			<div class="col-sm-6" style="padding-top: 2%; padding-left: 4%;"><h1 class="fontsize5">Search Here to get Purchased book of User</h1></div>
		</div>
	</div>

	<div style="padding-left: 4%;"><p style="border:2px solid orange; width: 15%; height: 0px;" ></p></div>

	<form name="form1" action="userpurchasedinfo.php" onsubmit="return checkid()" method="POST">
		<div class="jumbotron text-center" style="background-color: white;">
			<div style="background-color: white; padding-left: 5%;">
				<br><br>
					<div class="container-fluid" style="width: 70%; background-color: #e6ffff; border-radius: 25px;" id="boxshadow">
						<div style="padding: 1px;">
							<div class="jumbotron text-center" style="background-color: #e6ffff;">
								<div class="form-group">
              						<label style="font-size: 20px;">Enter User ID to get information : </label>
            						<input type="text" name="usersid1" class="form-control"><br>

									<input type="submit" value="Proceed" name="subbtn" class="btn btn-primary" style="font-size: 20px; margin-top: 3%;">
            					</div>
							</div>
						</div>
					</div>
			</div><br>
		</div>
	</form>
	

</body>
</html>