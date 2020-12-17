<?php
    session_start();
    
    
    if(!isset($_SESSION['adminid']))
    {
      echo "<script>location.href='mpjhome.php'</script>"; 
    }
    

	$con = mysqli_connect('localhost', 'root');

		if($con)
		{
			echo "Connection Formed";
		}
		else
		{
			echo "Connection Failed";
		}

		mysqli_select_db($con, 'bookshare');

		$rowCount = count($_POST["users"]);

		for($i=0;$i<$rowCount;$i++) 
		{
			mysqli_query($con, "DELETE FROM user WHERE user_id = '" . $_POST["users"][$i] . "' ");
			$_SESSION['show']=1;
			//mysqli_query($con, "DELETE FROM useremail WHERE user_eid = '" . $_POST["users"][$i] . "' ");
            header('location: searchtodelete.php');
            
		}

?>