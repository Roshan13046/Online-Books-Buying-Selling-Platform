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
          <li class="nav-item active">
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

  <a href="mpjsearchlog.php" class="btn btn-primary" style="margin-top: 1%; margin-left: 1%;">Back</a>
<!--<a href="http://localhost/miniproject/pro/Search_Result/mpjsearch.php" class="btn btn-primary">Back</a>-->
    <div class="showresults">
        <div class="container-fluid">
        <!--<h3>Results that matches to your requirements:</h3>-->               
<?php


$_SESSION['rldlog']=0;
  include('connection.php');


  if($_SESSION['gobacklog']==1)
     {
        $branch=$_SESSION['branch'];
        $classyear=$_SESSION['classyear'];
        $pattern=$_SESSION['pattern'];
        $sem=$_SESSION['sem'];
        $myid=$_SESSION['myid'];
     }
  else
     {
      $_SESSION['branch']='';
      $_SESSION['classyear']='';
      $_SESSION['pattern']='';
      $_SESSION['sem']='';
      $_SESSION['myid']='';
      $myid=$_SESSION['userid'];
      $branch= $_POST['branch'];
      $classyear= $_POST['classyear'];
      $pattern= $_POST['pattern'];
      $sem=$_POST['sem'];
      $_SESSION['branch']=$_POST['branch'];
      $_SESSION['classyear']=$_POST['classyear'];
      $_SESSION['pattern']=$_POST['pattern'];
      $_SESSION['sem']=$_POST['sem'];
      $_SESSION['myid']=$_SESSION['userid'];
     }

/*$branch=$_SESSION['branch'];
$classyear=$_SESSION['classyear'];
$pattern=$_SESSION['pattern'];
$sem=$_SESSION['sem'];*/


/*$strTable = "bookinfo";
$string = "WHERE branch = '{$branch}' and class = '{$classyear}' and pattern = '{$pattern}' and semester = '{$sem}' group by email";
$strSelect = "class,semester, count(bookname) as TotalNoOfBooks,email";
$result = fetch_data($strTable, $string,$strSelect);*/


/*$serc=" select class,branch,semester,count(bookname) as TotalNoOfBooks,email from bookinfo where branch='$branch' and class='$classyear' and pattern='$pattern' and semester='$sem' group by email ";
$searchquery=mysqli_query($con,$serc);*/
$active="active";
//$serc=" select year,department,semester,sum(price) as Total,count(book_id) as TotalNoOfBooks,book_seller_id from book where department='$branch' and year='$classyear' and course='$pattern' and semester='$sem' and book_status='$active' group by book_seller_id ";
$serc=" select * from book where department='$branch' and year='$classyear' and course='$pattern' and semester='$sem' and book_seller_id<>'$myid' and book_status='$active' ";
$searchquery=mysqli_query($con,$serc);
$searchnum=mysqli_num_rows($searchquery);
// $query = SELECT class,semester, count(bookname) as TotalNoOfBooks,email FROM bookinfo WHERE branch = 'it' and class = 'se' and pattern = '2015' and semester = 'first' group by email

// $num = mysqli_num_rows($result);
$i=0;
// print_r($result);
// echo $num;
//if(!$searchquery)
if($searchnum<=0)
{
    //echo "<h4 class='alert alert-danger'>Sorry! Books not available</h4>";
?>
 <div class="alert alert-danger">Sorry! Books not available.</div>
<?php
}
else
{
  echo "<h3 style='margin:10px;'>Results that matches to your requirements:</h3>";
    while($fdata = mysqli_fetch_array($searchquery))
    {
        $class = $fdata['year'];
        $bk_id=$fdata['book_id'];
        
        // if($class=='')
        // {
        //     // echo "Class:".$class;
            ?>
           
            <?php
            // exit;
        // }
        $semester = $fdata['semester'];
        /*$count = $fdata['TotalNoOfBooks'];
        $totalprice= $fdata['Total'];*/
        $bookdept= $fdata['department'];
        $bookprice=$fdata['price'];
        $booksubject=$fdata['subject'];
        $bokname=$fdata['book_name'];
        $bookimage=$fdata['book_image'];
        //$email = $fdata['book_seller_id'];
        $buid=$fdata['book_seller_id'];
        $getnam=" select * from user where user_id='$buid' ";
        $getnamquery=mysqli_query($con,$getnam);
        $fudata=mysqli_fetch_array($getnamquery);
        $getname=$fudata['user_firstname']." ".$fudata['user_lastname'];
        if($i%2==0)
        {
?>

            <div class='row card-row no-gutters results'>
<?php   } ?>
            
                <form method='post' action='signedbookdetails.php' class='col-md-6'>
                        <div class='row'>      
                            <div class='col-md-6'>
                                <img src="<?php echo $bookimage; ?>" class='extra__image' style="   height: 280px;    width: 100%;    max-width: 100%;">
                            </div>
                            <div class='col-md-6 bg__dark text__lite p-3'>
                                <h5 class='card-title'><?php echo $class."-".$bookdept." ".$semester;?>st semester</h5>
                                <p class='card-text'><strong>Book name:</strong><?php echo " ".$bokname; ?></p>
                                <p class='card-text'><strong>Price:<?php echo " ";?></strong><i class='fa fa-rupee'></i><?php echo $bookprice; ?></p>
                                <p class='card-text'><strong>Subject:</strong><?php echo " ".$booksubject; ?></p>
                                <p class='card-text'><strong>Name of seller:</strong><?php echo " ".$getname;?></p>
                                <input type='hidden' value="<?php echo (isset($buid))?$buid:'';?>" name='uid'>
                                <input type='hidden' value="<?php echo (isset($bk_id))?$bk_id:'';?>" name='bkid'>
                                <!--<input type='hidden' value="<?//php echo (isset($semester))?$semester:'';?>" name='sem'>
                                <input type='hidden' value="<?//php echo (isset($class))?$class:'';?>" name='class'>-->
                                <input type='submit' class='btn btn-primary' value='View details'/>  
                            </div>
                        </div>
                </form>
            <?php if($i%2!=0)
            { ?>
            </div>
<?php
            }
            $i++;
    }
}
?>
    
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
