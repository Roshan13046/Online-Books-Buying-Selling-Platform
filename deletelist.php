<?php

    session_start();
    
    
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

		$iduser = $_POST['usersid'];



		$sql2 = "SELECT * FROM user where user_id = '$iduser' ";
		
		$result = mysqli_query($con, $sql2);

		$count = mysqli_num_rows($result);

		$sql3 = "SELECT * FROM useremail where user_eid = '$iduser' ";
		
		$result1 = mysqli_query($con, $sql3);

		$count1 = mysqli_num_rows($result1);

?>
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
          <li class="nav-item">
            <a class="nav-link" href="searchforinfo.php"><i class="fa fa-fw fa-search"></i> Users Information</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-fw fa-search"></i> Delete Users</a>
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
		<div>
			<div class="col-sm-6" style="padding-top: 2%; padding-left: 4%;"><h1 class="fontsize5">Click Check Box To Delete</h1></div>
		</div>
	</div>

	<div style="padding-left: 4%;"><p style="border:2px solid orange; width: 15%; height: 0px;" ></p></div>



		<div class="container" style="margin-top: 5%;">
			
					<form action="deletevalid.php" method="POST">
						
							<table class="table">
								<thead>
									<tr class="listheader">
										<td></td>
										<td>User ID</td>
										<td>First Name</td>
										<td>Last Name</td>
										<td>Contact</td>
										<td>Email</td>
									</tr>
								</thead>

								<?php
									$i=0;

									while($row = mysqli_fetch_array($result) and $row1 = mysqli_fetch_array($result1)) 
									{
			
								?>

								<tbody>
									<tr>
										<td><input type="checkbox" name="users[]" value="<?php echo $row["user_id"]; ?>" checked></td>
										<td><?php echo $row["user_id"]; ?></td>
										<td><?php echo $row["user_firstname"]; ?></td>
										<td><?php echo $row["user_lastname"]; ?></td>
										<td><?php echo $row["user_contact"]; ?></td>
										<td><?php echo $row1["user_emailid"]; ?></td>
									</tr>
								</tbody>


								<?php
										$i++;
									}
								?>
							</table>

								<div class="jumbotron text-center" style="background-color: white;">
										<br><input type="submit" class="btn btn-primary" name="delete" value="Delete" style="font-size: 20px;" />
								</div>

						
					</form>
			
		</div>
	</body>
</html>