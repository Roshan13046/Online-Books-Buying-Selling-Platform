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

<body style="background-image: url(assets/SigninFormBack.jpg); background-attachment: fixed; background-size: cover;">

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
          <li class="nav-item active">
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


     <div class="container" style="margin-top: 60px; background-color: rgb(0,0,0,0.72); padding: 20px;">
            <h1 style="padding-top: 5px; color: orange; text-align: center;">Please fill in the following details</h1>
            <hr>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="formupload"  onsubmit="return checkprice()" method="POST" enctype="multipart/form-data">

          <?php

                $upid=$_SESSION['userid'];
                include('connection.php');
                $retname=" select * from user where user_id='$upid' ";
                $retnamequery=mysqli_query($con,$retname);
                $retnamefetch=mysqli_fetch_assoc($retnamequery);
                $rfname=$retnamefetch['user_firstname'];
                $rlname=$retnamefetch['user_lastname'];

                
                if(isset($_POST['subup']))
                   {
                       $branch=$_POST['branch'];
                       $class=$_POST['classyear'];
                       $pattern=$_POST['pattern'];
                       $semester=$_POST['sem'];
                       $bookname=$_POST['bookname'];
                       $bookimage=$_FILES['bookimage'];
                       $subject=$_POST['subjectname'];
                       $author=$_POST['authname'];
                       $edition=$_POST['edition'];
                       $price=$_POST['price'];  
                       //print_r($bookimage);
                       //$imagename=$bookimage['name']."_". date("Y-m-d-H-i-s");
                       //$imagename=$bookimage['name'];
                       $imagename=$rfname."_".$rlname."_".date("Y-m-d-H-i-s")."_".$bookimage['name'];
                       //print_r($imagename);
                       $imagepath=$bookimage['tmp_name'];
                       $imageerror=$bookimage['error'];
                       $file_ext=explode('.',$imagename);
                       $file_ext_check=strtolower(end($file_ext));
                       $valid_file_ext=array('png','jpg','jpeg');
                       //print_r($bookimage);

                       if($imageerror==0)
                          {
                            //print_r($bookimage);
                            //include('connection.php');
                            if(in_array($file_ext_check,$valid_file_ext))
                              {
                                $destfile='upload/'.$imagename;
                                /*$verim=" select *from book where bookimage='$destfile' and email='$upemail' ";
                                $verimquery=mysqli_query($con,$verim);
                                $imgcount=mysqli_num_rows($verimquery);
                                if($imgcount>0)
                                     {
                                          echo "<h5 class='alert alert-danger'>You have aldready uploaded this book!!</h5><hr>";
                                     }
                                else 
                                     {
                                         move_uploaded_file($imagepath,$destfile);

                                         $emailup=mysqli_real_escape_string($con,$upemail);
                                         $branch=mysqli_real_escape_string($con,$_POST['branch']);
                                         $class=mysqli_real_escape_string($con,$_POST['classyear']);
                                         $pattern=mysqli_real_escape_string($con,$_POST['pattern']);
                                         $semester=mysqli_real_escape_string($con,$_POST['sem']);
                                         $bookname=mysqli_real_escape_string($con,$_POST['bookname']);
                                         $destfile=mysqli_real_escape_string($con,$destfile);
                                         $subject=mysqli_real_escape_string($con,$_POST['subjectname']);
                                         $author=mysqli_real_escape_string($con,$_POST['authname']);
                                         $edition=mysqli_real_escape_string($con,$_POST['edition']);
                                         $price=mysqli_real_escape_string($con,$_POST['price']);
 
                                         $uploadquery=" insert into bookinfo(bookname,bookimage,author,subject,edition,branch,class,semester,pattern,price,email) values('$bookname','$destfile','$author','$subject','$edition','$branch','$class','$semester','$pattern','$price','$emailup') ";
                                         $upquery=mysqli_query($con,$uploadquery);
                                         if($upquery)
                                           {
                                               echo "<h5 class='alert alert-success'>Book information uploaded sucessfully</h5><hr>";
                                           }
                                         else
                                           {
                                               echo "<h5 class='alert alert-danger'>There was some error in uploading book information!!</h5><hr>";
                                           }      
                                       
                                      }*/

                                       move_uploaded_file($imagepath,$destfile);

                                       $branch=mysqli_real_escape_string($con,$_POST['branch']);
                                       $class=mysqli_real_escape_string($con,$_POST['classyear']);
                                       $pattern=mysqli_real_escape_string($con,$_POST['pattern']);
                                       $semester=mysqli_real_escape_string($con,$_POST['sem']);
                                       $bookname=mysqli_real_escape_string($con,$_POST['bookname']);
                                       $destfile=mysqli_real_escape_string($con,$destfile);
                                       $subject=mysqli_real_escape_string($con,$_POST['subjectname']);
                                       $author=mysqli_real_escape_string($con,$_POST['authname']);
                                       $edition=mysqli_real_escape_string($con,$_POST['edition']);
                                       $price=mysqli_real_escape_string($con,$_POST['price']);
                                       $status="active";
  
                                       $uploadquery=" insert into book(book_name,book_image,author_name,subject,edition,department,year,semester,course,price,book_status,book_seller_id) values('$bookname','$destfile','$author','$subject','$edition','$branch','$class','$semester','$pattern','$price','$status','$upid') ";
                                       $upquery=mysqli_query($con,$uploadquery);
                                       if($upquery)
                                          {
                                              echo "<h5 class='alert alert-success'>Book information uploaded sucessfully</h5><hr>";
                                          }
                                       else
                                          {
                                              echo "<h5 class='alert alert-danger'>There was some error in uploading book information!!</h5><hr>";
                                          }

                              }
                            else
                              {
                                  echo "<h5 class='alert alert-danger'>Invalid file extension!!<br>Image should be of one of the followiing  formats only!<br>i. png<br>ii. jpg<br>iii. jpeg</h5><hr>";
                              }
            
                          }
                        else
                          {
                             echo "<h5 class='alert alert-danger'>There was some error in uploading book information!!</h5><hr>";
                          }
                       
                   }

             

                

          ?>

          <div class="form-row">
              <div class="form-group row float-left">
                  <!-- <h3 class="">Select your branch :</h3> -->
                  <label for="branch" style="margin-left: 20px;"><h3 style="color: yellow;">Select the branch:</h3></label>
                  <select name="branch" id="branch" class="box" style="margin-left: 60px; height: 40px; width: 200px;">
                    <option class="branchlist" value="Computer">Computer Engineering</option>
                    <option class="branchlist" value="Mechanical">Mechanical Engineering</option>
                    <option class="branchlist" value="IT">Information Technology</option>
                    <option class="branchlist" value="Electrical">Electrical Engineering</option>
                    <option selected class="branchlist" value="E&TC">E&TC Engineering</option>
                    <option class="branchlist" style="background-color: white;" value="Printing">Printing Engineering</option>
                  </select>
              </div><br>
      
                  <div class="form-group row float-right" style="margin-left: 130px;">
                     <!-- <h3 class="float-left" style="margin-right: 700px;">Select your class :</h3> -->
                     <label for="classyear"><h3 style="color: yellow;">Select class:</h3></label>
                     <select name="classyear" id="classyear" class="box" style="margin-left: 50px; height: 40px; width: 80px; color: black; background-color: white">
                       <option  value="FE">FE</option>
                       <option  value="SE">SE</option>
                       <option  value="TE">TE</option>
                       <option  value="BE">BE</option>
                     </select>
                  </div><br>
           </div><br>

            <!-- <div style="margin-top: 160px"> -->
          <div class="form-row">
            <div class="form-group row float-left">
              <!-- <h3>Choose syllabus pattern :</h3><br> -->
              <label for="pattern"><h3 style="color: yellow; margin-left: 15px;">Select syllabus pattern:</h3></label>
              <select name="pattern" id="pattern" style="margin-left: 20px; background-color: white; color: black">
                <option value="2008">2008 Pattern</option>
                <option value="2012">2012 Pattern</option>
                <option value="2015" selected>2015 Pattern</option>
                <option value="2019">2019 Pattern</option>
              </select>
            </div><br>
            <div class="form-group row float-right" style="margin-left: 180px;">
              <label for="sem"><h3 style="color: yellow; margin-left: 15px;">Select semester:</h3></label>
              <select name="sem" id="pattern" style="margin-left: 20px; background-color:white; color: black">
                <option value="1" selected>Semester 1</option>
                <option value="2">Semester 2</option>
              </select>
            </div><br>
          </div><br>

          <div class="form-group">
              <label for="usrb"><h3 style="color: yellow;"><i class="fa fa-book"></i> Enter book name:</h3></label>
              <input type="text" class="form-control" id="usrb" name="bookname" style="color: black; background-color: white;" required>
          </div><br>
          <div class="form-group">
              <label for="usim"><h3 style="color: yellow;"><i class="fa fa-camera"></i>  Upload the image of the book:</h3></label>
              <input type="file" class="form-control" id="usim" name="bookimage" style="color: black; background-color: white;" required>
          </div><br>
          <div class="form-group">
              <label for="ubs"><h3 style="color: yellow;">Enter subject:</h3></label>
              <input type="text" class="form-control" id="ubs" name="subjectname" style="color: black; background-color: white;" required>
          </div><br> 
          <div class="form-group">
              <label for="usra"><h3 style="color: yellow;"><i class="fa fa-pencil-square-o"></i>  Enter author's name:</h3></label>
              <input type="text" class="form-control" id="usra" name="authname" style="color: black; background-color: white;" required>
          </div><br>
          <div class="form-group">
              <label for="ube"><h3 style="color: yellow;">Enter edition:</h3></label>
              <input type="text" class="form-control" id="ube" name="edition" style="color: black; background-color: white;" required>
          </div><br> 
          <div class="form-group">
              <label for="ubp"><h3 style="color: yellow;"><i class="fa fa-rupee"></i>  Enter price (in rupees):</h3></label>
              <input type="text" class="form-control" id="ubp" name="price" style="color: black; background-color: white;" required>
          </div><br> 
          <input type="submit" name="subup" class="pull-center" value="Upload Book" id="subtnup" style="height: 50px; width: 180px; cursor: pointer; border-radius: 20px; font-size: 25px; background-color: rgb(255, 51, 0); color: whitesmoke;"><br>
         </form>
          


     </div>

    <footer class="container" style="background-color: yellow;">
        <hr>
        <p>© 2020-2021 BooksShare.com</p>
    </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>



</html>
