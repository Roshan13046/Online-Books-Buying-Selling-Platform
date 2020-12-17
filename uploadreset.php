<?php
   session_start();

   error_reporting(E_ERROR); 
    
   $base_url = "localhost/phpprog/";

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
  <script>
          function checkprice()
				   {
             var numid=document.formupload.price.value;

					   var number = /^\d*\.?\d*$/;

					   if((!number.test(numid)))
                {
                    alert("Enter a valid price value!!")
                    return false;
                }
						else
						  {
							  return true;
						  }
				   }

   </script>
</head>

<body style="background-image:url(assets/SigninFormBack.jpg);">

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
            <a class="nav-link " href="#">FAQs  <i class="fa fa-commenting"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="#"><i class="fa fa-support"></i>  Help</a>
          </li>
        </ul>
        <div class="logsign">
          <form action="#" method="POST">
          <a href="mpjprofile.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Profile</a>
          <a href="mpjbooklist.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Books</a>
           <!--<a href="mpjbooks.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Books</a>-->
          <a href="mpjrequest.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">Requests</a>
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logoutbtn">Logout</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
<?php
  $uprid = $_SESSION['userid'];
$book_upid = $_GET['bookid'];


//$_SESSION['book_upid']=$_GET['bookid'];
//echo $_GET['bookid'];
 //echo $book_upid;
$con = get_connection();
/*if($_SESSION['upback']==1)
{
  $book_upid=$_SESSION['book_uplid'];*/
if($_POST && isset($_POST["submit"]))
{
  $con = get_connection();

  //$fm=$_FILES['bookimage'];

  $getim=" select book_image from book where book_id='$book_upid' ";
  $getimquery=mysqli_query($con,$getim);
  $getar=mysqli_fetch_assoc($getimquery);
  $getimage=$getar['book_image'];


   if(($_FILES['bookimage']['name'])=='')
      {
        $destfile=$getimage;
      }
   else
      {
        $retname=" select * from user where user_id='$uprid' ";
        $retnamequery=mysqli_query($con,$retname);
        $retnamefetch=mysqli_fetch_assoc($retnamequery);
        $rfname=$retnamefetch['user_firstname'];
        $rlname=$retnamefetch['user_lastname'];

        $bookimage=$_FILES['bookimage'];
        $imagename=$rfname."_".$rlname."_".date("Y-m-d-H-i-s")."_".$bookimage['name'];
        //print_r($imagename);
        $imagepath=$bookimage['tmp_name'];
        $destfile='upload/'.$imagename;
        move_uploaded_file($imagepath,$destfile);
         
      }

    
    $name = $_POST["bookname"];
    $author = $_POST["author"];
    $branch = $_POST["branch"];
    $course= $_POST["pattern"];
    $edition= $_POST["edition"];
    $class = $_POST["classyear"];
    $sem = $_POST["sem"];
    $price = $_POST["price"];
    $subject = $_POST["subject"];


    
    //$status = $_POST["status"];
    //$book_upid = $_GET['bookid'];
    // $book_upid;
    //$query= " update book set book_name='$name',author_name='$author',department='$branch',course='$course',year='$class',semester='$sem',price='$price',book_status='$status' where book_id='$book_upid' and book_seller_id='$uprid'";
    
   $query= " update book set book_name='$name',author_name='$author',subject='$subject',department='$branch',book_image='$destfile',edition='$edition',course='$course',year='$class',semester='$sem',price='$price' where book_id='$book_upid' and book_seller_id='$uprid'";
  
   //$query= " update book set book_name='$name',author_name='$author',subject='$subject',book_image='$destfile',edition='$edition',price='$price' where book_id='$book_upid' and book_seller_id='$uprid'";
  
   /*$query = "UPDATE book 
            SET book_name='{$name}', 
                author_name='{$author}', 
                department='{$branch}', 
                year='{$class}', 
                semester='{$sem}', 
                price='{$price}',
                book_status='{$status}'
            WHERE book_id = '{$book_upid}' AND book_seller_id= '{$uprid}'";*/
    $result = mysqli_query($con, $query);
    //echo mysqli_error($con);
    // status='{$status}',
    if($result)
     {
        $_SESSION["profile_msg"] = "Success";
        
        echo '<meta http-equiv="refresh" content="0; url='. "uploadreset.php?bookid={$book_upid}" .'" />';
        exit;
        //echo "<script>location.href='uploadreset.php'</script>";
        //exit;

    }
    // if($status == 'sold')
    //     echo "sold";
    // else
    //     echo $status;

    
}

/*}

else
{
      $_SESSION['book_uplid']='';
      $book_upid = $_GET['bookid'];
      $_SESSION['book_uplid']=$_GET['bookid'];

}*/

$_SESSION['upback']=1;

$strTable = "book";
$string = "WHERE book_id = '{$book_upid}' AND book_seller_id= '{$uprid}'";
$strSelect = "department, year, book_image, course, semester, book_name, author_name, edition, price, subject";
$result = fetch_data($strTable, $string, $strSelect);
if($result)
{
    while ($fdata = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
    {
    ?>
<!--<a href="http://localhost/miniproject/pro/profile/list.php" class="btn btn-primary">Back</a>-->
   <a href="mpjbooklist.php" class="btn btn-primary" style="margin-left: 12px;">Back</a>
        <div class="container" style="margin-top:90px; background-color: rgb(255, 255, 26); margin-bottom:40px; opacity:0.9;">
        <h1 style='margin-top:10px; color:purple;' align="center">Book details:</h1>
        <hr>
            <form method="POST" name="formupload" style="margin-top:30px; padding:25px;" onsubmit="return checkprice()" enctype="multipart/form-data">
                

                    <?php
                        if($_SESSION["profile_msg"])
                        {   ?>
                            <div class="col-md-12 alert alert-success">
                                Updated Successfully!
                                <?php
                                    // echo $_SESSION["profile_msg"];
                                    ($_SESSION["profile_msg"] = '');
                                ?>
                            </div>
                    <?php
                        }   ?>

                    <div class="form-group row">
                        <label for="bookname" class="col-sm-2 col-form-label"><strong><h5>Name of Book:</h5></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="bookname" class="form-control" value="<?php echo $fdata['book_name'];?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subject" class="col-sm-2 col-form-label"><strong><h5>Subject:</h5></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="subject" class="form-control" value="<?php echo $fdata['subject'];?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label"><strong><h5>Name of Author:</h5></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="author" class="form-control" value="<?php echo $fdata['author_name'];?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch" class="col-sm-2 col-form-label"><strong><h5>Name of branch:</h5></strong></label>
                        <div class="col-sm-10">
                        <!--<input type="text" name="branch" class="form-control" value="<?php //echo $fdata['department'];?>" required>-->
                        <input type="text" class="form-control" placeholder="<?php echo $fdata['department'];?>" disabled><br>
                        <select name="branch" id="branch" class="box" style="height: 40px; width: 200px;">
                           <option selected class="branchlist" value="<?php echo $fdata['department'];?>">Select Branch:</option>
                           <option class="branchlist" value="Computer">Computer Engineering</option>
                           <option class="branchlist" value="Mechanical">Mechanical Engineering</option>
                           <option class="branchlist" value="IT">Information Technology</option>
                          <option class="branchlist" value="Electrical">Electrical Engineering</option>
                          <option class="branchlist" value="E&TC">E&TC Engineering</option>
                          <option class="branchlist" style="background-color: white;" value="Printing">Printing Engineering</option>
                       </select>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="class" class="col-sm-2 col-form-label"><strong><h5>Class:</h5></strong></label>
                        <div class="col-sm-10">
                        <!--<input type="text" name="class" class="form-control" value="<?php //echo $fdata['year'];?>" required>-->
                        <input type="text" class="form-control" placeholder="<?php echo $fdata['year'];?>" disabled><br>
                          <select name="classyear" id="classyear" class="box" style="height: 40px; width: 130px; color: black; background-color: white">
                             <option selected value="<?php echo $fdata['year'];?>">Select Class:</option>
                             <option value="FE">FE</option>
                             <option value="SE">SE</option>
                             <option value="TE">TE</option>
                             <option value="BE">BE</option>
                          </select>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="edition" class="col-sm-2 col-form-label"><strong><h5>Edition:</h5></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="edition" class="form-control" value="<?php echo $fdata['edition'];?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pattern" class="col-sm-2 col-form-label"><strong><h5>Pattern:</h5></strong></label><br><br>
                        <div class="col-sm-10">
                        <!--<input type="text" name="pattern" class="form-control" value="<?php //echo $fdata['course'];?>" required>-->
                        <input type="text" class="form-control" placeholder="<?php echo $fdata['course'];?>" disabled><br>
                        <select name="pattern" id="pattern" style="height: 40px; width: 140px; background-color: white; color: black">
                          <option selected value="<?php echo $fdata['course'];?>">Select Pattern:</option>
                          <option value="2008">2008 Pattern</option>
                          <option value="2012">2012 Pattern</option>
                          <option value="2015">2015 Pattern</option>
                          <option value="2019">2019 Pattern</option>
                        </select>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="sem" class="col-sm-2 col-form-label"><strong><h5>Semester:</h5></strong></label><br><br>
                        <div class="col-sm-10">
                        <!--<input type="text" name="sem" class="form-control" value="<?php //echo $fdata['semester'];?>" required>-->
                        <input type="text" class="form-control" placeholder="<?php echo $fdata['semester'];?>" disabled><br>
                        <select name="sem" id="pattern" style="height: 40px; width: 150px; background-color:white; color: black">
                           <option selected value="<?php echo $fdata['semester'];?>">Select Semester:</option>
                           <option value="1">Semester 1</option>
                           <option value="2">Semester 2</option>
                        </select>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label"><strong><h5>Price:</h5></strong></label>
                        <div class="col-sm-10">
                        <input type="text" name="price" class="form-control" value="<?php echo $fdata['price'];?>" required>
                        </div><br>
                    </div>


                    <div class="form-group row">
                        <label for="bookimage" class="col-sm-2 col-form-label"><strong><h5>Book Image:</h5></strong></label>
                        <div class="col-sm-10">
                        <img src="<?php echo $fdata['book_image']; ?>" height="300px" width="400px" style="margin-bottom:10px;"><br>
                        <input type="file" name="bookimage" class="form-control">
                        </div>
                    </div>


                    <!--<div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status:</label><br><br>
                        <div class="col-sm-10">
                            <input type="radio" name="status" value="sold"
                            <?php
                                /*if($fdata["book_status"]=="sold")
                                {
                                    echo "checked";
                                }*/
                            ?>
                            > Sold
                            <input type="radio" name="status" value="active"
                            <?php
                                /*if($fdata["book_status"]=="active")
                                {
                                    echo "checked";
                                }*/
                            ?>
                            > Active
                            
                        </div>
                    </div>-->
                <button class="btn btn-primary" style="margin-left:190px; margin-top:20px;" type="submit" name="submit">Submit</button>
                <!--</div>-->
            </form>
        </div>
    <?php 
    }
}

?>
 
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
