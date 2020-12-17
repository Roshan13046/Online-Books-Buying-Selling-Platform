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
  //$email = $_SESSION['sessionemail'];
  $ufid=$_SESSION['userid'];
  $_SESSION['upback']=0;
// print_r($_GET);
if($_GET && isset($_GET["delete"]))             //Delete button functionality
{
    /*$bname = $_GET['bookname'];
    $con = get_connection();
     $query= "DELETE FROM bookinfo WHERE bookname='{$bname}'";      //Delete the book from book table
    $result = mysqli_query($con, $query);
    $_SESSION["delete_msg"] = "Success";                            //Message to show successfull deletion of book 
    echo '<meta http-equiv="refresh" content="0; url='. "list.php" .'" />';
    // print_r($_GET);*/


    $bookid = $_GET['bookid'];
    $con = get_connection();

    $bkinfos=" select *from book where book_id='$bookid' ";
    $bksquery=mysqli_query($con,$bkinfos);
    $bookinfosend=mysqli_fetch_array($bksquery);
    $sendbookname=$bookinfosend['book_name'];


     $recheck=" select *from request where request_book_id='$bookid' ";
     $recheckquery=mysqli_query($con,$recheck);
     $rechecknum=mysqli_num_rows($recheckquery);

     if($rechecknum)
       {
           while($fbdata=mysqli_fetch_array($recheckquery,MYSQLI_ASSOC))
              {
                      $bd_id=$fbdata['request_buyer_id'];
                      $ub1=" select *from useremail where user_eid='$bd_id' ";
                      $ub1query=mysqli_query($con,$ub1);
                      $ub2=mysqli_fetch_array($ub1query);
                      $buyeremailid=$ub2['user_emailid'];
                      $headers = "From: dhamkeatharva@gmail.com";
                      $tobuyer_email=$buyeremailid;
                      $subjectbuy="Notification regarding your book request";
                      $bodybuy="The book for which you had requested has been removed from the platform by the seller".
                               "\n".
                               "\n Name of the requested book: ".$sendbookname.
                               "\n".
                               "\nTry contacting another seller";
                     mail($tobuyer_email,$subjectbuy,$bodybuy,$headers);
                     //echo "Buyer's email:".$buyeremailid;

              }
       }

     $query= "DELETE FROM book WHERE book_id='$bookid'";      //Delete the book from book table
    $result = mysqli_query($con, $query);
    $_SESSION["delete_msg"] = "Success";                            //Message to show successfull deletion of book 
    echo '<meta http-equiv="refresh" content="0; url='. "mpjbooklist.php" .'" />';
    exit;
}

?>

<?php

$con=get_connection();
$slct=" select *from book where book_seller_id='$ufid' and book_status='active'";
$result=mysqli_query($con,$slct);
$showbooksnum=mysqli_num_rows($result);
$i=0;
if($showbooksnum>0)
{   ?>
    <div class="container booktables">
    <h2 style="margin:6px;">My Books:</h2>
    <?php
                        if($_SESSION["delete_msg"])
                        {   ?>
                                <div class="alert alert-success">
                                    <p>Deleted Successfully!</p>
                                </div>
                                <?php  
                                    // echo $_SESSION["delete_msg"];
                                    ($_SESSION["delete_msg"] = '');
                                ?>
                    <?php
                        }   ?>
        <table class='table table-hover table-bordered'>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Author name</th>
                    <th>Subject</th>
                    <th>Edition</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
    <?php
    while ($fdata = mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
        $i++;
        ?>        
            <tbody>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $fdata['book_name']; ?></td>
                    <td><?php echo $fdata['author_name']; ?></td>
                    <td><?php echo $fdata['subject']; ?></td>
                    <td><?php echo $fdata['edition']; ?></td>
                    <td><?php echo $fdata['price']; ?></td>
                    <td>
                      
                            <a href="<?php echo "uploadreset.php?bookid=".$fdata['book_id']."&update=1"; ?>" class='btn btn-primary btn-sm' style='margin:6px;'>Update</a>
                            <a href="<?php echo "mpjbooklist.php?bookid=".$fdata['book_id']."&delete=1"; ?>" class='btn btn-danger btn-sm' style='margin:6px'>Delete</a>
                       
                    </td>
                </tr>
            </tbody>
    <?php
    }       ?>
        </table>
    </div>
<?php
} 
else
{
  //echo "<h2 style='margin:6px;'>No results</h2>"; 
  $_SESSION['mys']=1;
}      
?>







<?php
$strTable = "book";
$string = "WHERE book_seller_id = '{$ufid}' and book_status='sold'"; //
$strSelect = "book_id, department, year, course, semester, book_name, author_name, edition, subject, price";
$result = fetch_data($strTable, $string, $strSelect);
$i=0;
if($result)
{   ?>
    <div class="container booktables">
    <h2 style="margin:6px;">Sold Books:</h2>
    <?php
                        if($_SESSION["delete_msg"])
                        {   ?>
                                <div class="alert alert-success">
                                    <p>Deleted Successfully!</p>
                                </div>
                                <?php  
                                    // echo $_SESSION["delete_msg"];
                                    ($_SESSION["delete_msg"] = '');
                                ?>
                    <?php
                        }   ?>
        <table class='table table-hover table-bordered'>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Author name</th>
                    <th>Subject</th>
                    <th>Edition</th>
                    <th>Price</th>
                    <!--<th>Action</th>-->
                </tr>
            </thead>
    <?php
    while ($fdata = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
    {
        $i++;
        ?>        
            <tbody>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $fdata['book_name']; ?></td>
                    <td><?php echo $fdata['author_name']; ?></td>
                    <td><?php echo $fdata['subject']; ?></td>
                    <td><?php echo $fdata['edition']; ?></td>
                    <td><?php echo $fdata['price']; ?></td>
                 
                </tr>
            </tbody>
    <?php
    }       ?>
        </table>
    </div>
<?php
}
else
{
  $_SESSION['tms']=1;
}      
?>

<?php
          if($_SESSION['mys']==1 && $_SESSION['tms']==1)
             {
              echo "<h2 class='alert alert-danger' style='margin:6px;'>No results</h1>"; 
             }

          $_SESSION['mys']=0;
          $_SESSION['tms']=0;

?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
