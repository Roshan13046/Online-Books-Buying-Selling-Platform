<?php
	  session_start();
	  $_SESSION['show']=0;
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

</head>


<body>


	<?php

        //session_start();


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




		$con = mysqli_connect('localhost', 'root');


		mysqli_select_db($con, 'bookshare');

		$query = " SELECT * from user";

		$result = mysqli_query($con, $query);

		$num = mysqli_num_rows($result);

		$query1 = " SELECT * from sold_books";

		$result1 = mysqli_query($con, $query1);

		$num1 = mysqli_num_rows($result1);

		$query2 = " SELECT * from book";

		$result2 = mysqli_query($con, $query2);

		$num2 = mysqli_num_rows($result2);


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
          <li class="nav-item active">
            <a class="nav-link" href="admin.php"><i class="fa fa-fw fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="monthreport.php"><i class="fa fa-shopping-cart"></i>   Get Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="searchforinfo.php"><i class="fa fa-fw fa-search"></i> Users Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="searchtodelete.php"><i class="fa fa-fw fa-search"></i> Delete User</a>
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
	

	

	

	<div class="container-fluid">

  
		<div class="jumbotron text-center" style="background-color: white;">
			

			<div class="jumbotron text-center" style="background-color: white;">
				<h1>
					Statistics In Figures
					<center><p style="border:2px solid orange; width: 25%; height: 0px; margin-top: 1%;" ></p></center>
				</h1>
			</div>


			<div class="col-sm-4">
				<p>Total Users</p>
				<h1><?php echo $num; ?></h1>
			</div>

			<div class="col-sm-4">
				<p>Total Book Sold</p>
				<h1><?php echo $num1; ?></h1>
			</div>

			<div class="col-sm-4">
				<p>Total Number of Book Uploaded</p>
				<h1><?php echo $num2; ?></h1>
			</div>

		</div>


	</div>

	<!--<div class="container-fluid" style="margin-top: 5%;">
		<div class="jumbotron text-center" style="background-color: white;">
			<button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="logoutbtn" style="font-size: 20px; color: black;">Click Here To Edit Profile...</button>
		</div>
	</div>-->


	



</body>
</html>