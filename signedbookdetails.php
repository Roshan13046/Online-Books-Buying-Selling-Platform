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


   //include('db.php');
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


<?php 
/*$buid=$_SESSION['userid'];
$suid = $_POST['uid'];
$bookid=$_POST['bkid'];*/
$bodysel='';
$bodybuy='';

if($_SESSION['rldlog']==1)
 {
     $suid=$_SESSION['rsuid'];
     $buid=$_SESSION['rbuid'];
     $bookid=$_SESSION['rbookid'];

  if(isset($_POST['sndml']))
     {
         include('connection.php');
        $us1=" select *from useremail where user_eid='$suid' ";
        $us1query=mysqli_query($con,$us1);
        $us2=mysqli_fetch_array($us1query);
        $selleremailid=$us2['user_emailid'];
        $ub1=" select *from useremail where user_eid='$buid' ";
        $ub1query=mysqli_query($con,$ub1);
        $ub2=mysqli_fetch_array($ub1query);
        $buyeremailid=$ub2['user_emailid'];

        $usp1=" select *from user where user_id='$suid' ";
        $usp1query=mysqli_query($con,$usp1);
        $usp2=mysqli_fetch_array($usp1query);
        $sellerphone=$usp2['user_contact'];
        $sentsellername=$usp2['user_firstname']." ".$usp2['user_lastname'];
        $usb1=" select *from user where user_id='$buid' ";
        $usb1query=mysqli_query($con,$usb1);
        $usb2=mysqli_fetch_array($usb1query);
        $buyerphone=$usb2['user_contact'];
        $sentbuyername=$usb2['user_firstname']." ".$usb2['user_lastname'];

        $bkinfos=" select *from book where book_id='$bookid' ";
        $bksquery=mysqli_query($con,$bkinfos);
        $bookinfosend=mysqli_fetch_array($bksquery);

        $toseller_email=$selleremailid;
        $subjectsel="Request for buying of books";

        $bodysel="You have received a request for the following book you uploaded:".
                 "\n".
                 "\nBook details:".
                 "\nBook name: ".$bookinfosend['book_name'].
                 "\nSubject: ".$bookinfosend['subject'].
                 "\nAuthor Name: ".$bookinfosend['author_name'].
                 "\nEdition: ".$bookinfosend['edition'].
                 "\nClass: ".$bookinfosend['year'].
                 "\nBranch: ".$bookinfosend['department'].
                 "\n".
                 "\nBuyer Details:".
                 "\nBuyer name:".$sentbuyername.
                 "\nBuyer email-address:".
                 "\n".$buyeremailid.
                 "\nBuyer contact number:".$buyerphone.
                 "\n".
                 "\nAfter selling the book please update the status of the book sold on our platform".
                 "\nGo to 'Requests' section on our platform to update the status";

         $tobuyer_email=$buyeremailid;
         $subjectbuy="Verification of request";
         $bodybuy="You request has been successfully sent to the seller".
                  "\n".
                  "\nDetails of the book for which the request has been sent are:".
                  "\nBook name: ".$bookinfosend['book_name'].
                  "\nSubject: ".$bookinfosend['subject'].
                  "\nAuthor Name: ".$bookinfosend['author_name'].
                  "\nEdition: ".$bookinfosend['edition'].
                  "\nClass: ".$bookinfosend['year'].
                  "\nBranch: ".$bookinfosend['department'].
                  "\n".
                  "\nSeller Details:".
                  "\nSeller name:".$sentsellername.
                  "\nSeller email-id:".
                  "\n".$selleremailid.
                  "\nSeller contact number:".$sellerphone;

                  $headers = "From: dhamkeatharva@gmail.com";
      if($suid!=$buid)
       {
            $rcheck=" select *from request where request_seller_id='$suid' and request_buyer_id='$buid' and request_book_id='$bookid' ";
            $rcheckquery=mysqli_query($con,$rcheck);
            $rchecknum=mysqli_num_rows($rcheckquery);

            if($rchecknum)
                  {
                    echo "<h5 class='alert alert-danger'>You have aldready sent the request to seller!!</h5><hr>";
                  }
            else
               {
                $rinsert=" insert into request(request_seller_id,request_buyer_id,request_book_id) values('$suid','$buid','$bookid') ";
                $rinsertquery=mysqli_query($con,$rinsert);
                if($rinsertquery)
                   {
                     
                       if(mail($toseller_email, $subjectsel, $bodysel, $headers))
                         {

                            echo "<h5 class='alert alert-success'>Your request has been mailed successfully to the seller</h5>";
                              if(mail($tobuyer_email, $subjectbuy, $bodybuy, $headers))
                                {
                                   echo "<h5 class='alert alert-success'>Verfication of your request is sent to your mail box</h5><hr>";  
                                }

                     
                      }
                     else
                     {
                    echo "<h5 class='alert alert-danger'>There was some error sending request to the seller!!</h5><hr>";
                     }
                      //echo "<h5 class='alert alert-success'>Verfication of your request is sent to your mail box</h5><hr>";  
                       
                   }
                else
                   {
                        echo "<h5 class='alert alert-danger'>There was some error sending request to the seller!!</h5><hr>";
                   }
               }

          }
          else
            {
              echo "<h5 class='alert alert-danger'>You cannot send request to yourself!!</h5><hr>";
            }
     }
 }

 else
   {
       $_SESSION['rsuid']='';
       $_SESSION['rbuid']='';
       $_SESSION['rbookid']='';
  
       $buid=$_SESSION['userid'];
       $suid = $_POST['uid'];
       $bookid=$_POST['bkid'];
       
       $_SESSION['rsuid']=$_POST['uid'];
       $_SESSION['rbuid']=$_SESSION['userid'];
       $_SESSION['rbookid']=$_POST['bkid'];

   }

   
?>

  <?php

    include('connection.php');
      
       $bkinfo=" select *from book where book_id='$bookid' ";
       $bkquery=mysqli_query($con,$bkinfo);
       $bookinfo=mysqli_fetch_array($bkquery);
       $usinfo=" select *from user where user_id='$suid' ";
       $usquery=mysqli_query($con,$usinfo);
       $userinfo=mysqli_fetch_array($usquery);

?>
  <a href="signedsearchres.php" class="btn btn-primary" style="margin-top: 1%; margin-left: 1%;">Back</a>

  <?php

  $_SESSION['gobacklog']=1;
  $_SESSION['rldlog']=1;

  ?>


 <h1 align="center"><u>Book Details</u></h1>

   <!--<div class="container" style="margin-left:300px; margin-top:30px; margin-bottom:30px; padding:35px; border: 1px solid red; border-radius:20px; width:55%">-->
<div class="container-fluid" style="margin-top:30px; margin-bottom:30px;">
  <div class="container float-left" style=" border: 1px solid red; margin-left:60px; padding:20px; margin-bottom:20px; border-radius:20px; width:55%">
      <h3>Book Image:<h3>   
      <img src="<?php echo $bookinfo['book_image']; ?>" height="400" width="400"><br><br>

      <h3><strong>Book Name:</strong><?php echo " ".$bookinfo['book_name']; ?></h3><br>

      <h3><strong>Subject:</strong><?php echo " ".$bookinfo['subject']; ?></h3><br>

      <h3><strong>Author Name:</strong><?php echo " ".$bookinfo['author_name']; ?></h3><br>

      <h3><strong>Edition:</strong><?php echo " ".$bookinfo['edition']; ?></h3><br>

      <h3><strong>Price:<?php echo " "; ?></strong><i class='fa fa-rupee'></i><?php echo $bookinfo['price']; ?></h3><br>

      <h3><strong>Syllabus Pattern:</strong><?php echo " ".$bookinfo['course']; ?></h3><br>

      <h3><strong>Class:</strong><?php echo " ".$bookinfo['year']; ?></h3><br>

      <h3><strong>Branch:</strong><?php echo " ".$bookinfo['department']; ?></h3><br>

  </div>

  <div class="container float-right" style=" border: 1px solid red; margin-right:35px; padding:15px; border-radius:20px; width:35%">

      <h3><i class="fa fa-user"></i><strong>  Seller's Name:</strong></h3>
      <h3><?php echo $userinfo['user_firstname']." ".$userinfo['user_lastname']; ?></h3><br>
      <form method="post">
      <input type="submit" name="sndml" value="Contact Seller" class="btn btn-primary" style="margin:left:150px; height:40px;">
      </form>

  </div>

</div>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
  

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>



</html>
