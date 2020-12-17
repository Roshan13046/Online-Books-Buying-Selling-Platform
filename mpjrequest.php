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
          <a href="mpjbooklist.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">My Books</a>
          <a href="mpjrequest.php" class="btn btn-outline-light my-2 my-sm-0" type="button" id="Signin">Requests</a>
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="logoutbtn">Logout</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
  <?php

   $ufid=$_SESSION['userid'];
   $con = get_connection();

   if($_GET && isset($_GET["sold"]))               //Sold button functionality
     {

        $buyerid = $_GET['buyerid'];
        $sid = $_GET['sellerid'];

        $bookids=$_GET['bookrid'];



        $con = get_connection();

    $bkinfos=" select *from book where book_id='$bookids' ";
    $bksquery=mysqli_query($con,$bkinfos);
    $bookinfosend=mysqli_fetch_array($bksquery);
    $sendbookname=$bookinfosend['book_name'];

    $usp1=" select *from user where user_id='$sid' ";
    $usp1query=mysqli_query($con,$usp1);
    $usp2=mysqli_fetch_array($usp1query);
    $sentsellername=$usp2['user_firstname']." ".$usp2['user_lastname'];

    $ub1=" select *from useremail where user_eid='$buyerid' ";
    $ub1query=mysqli_query($con,$ub1);
    $ub2=mysqli_fetch_array($ub1query);
    $buyeremailid=$ub2['user_emailid'];

    $headers = "From: dhamkeatharva@gmail.com";
    $tobuyer_email=$buyeremailid;
    $subjectbuy="Notification regarding your book request";
    $bodybuy="Thanks for buying book from BookShare.com".
             "\n".
             "\n Name of the book sold to you: ".$sendbookname.
             "\n".
             "\n Seller Name:".$sentsellername.
             "\n".
             "\nThere are more books to explore...".
             "\nVisit Again!!";
    mail($tobuyer_email,$subjectbuy,$bodybuy,$headers);

    $recheck=" select *from request where request_book_id='$bookids' and request_seller_id='$sid' and request_buyer_id<>'$buyerid' ";
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
                   $bodybuy="The book for which you had requested has been sold to another buyer by the seller".
                            "\n".
                            "\n Name of the requested book: ".$sendbookname.
                            "\n".
                            "\nTry contacting another seller";
                  mail($tobuyer_email,$subjectbuy,$bodybuy,$headers);
                  //echo "Buyer's email:".$buyeremailid;

           }
    }


        //$con = get_connection();
        $querys= " delete from request where request_book_id='$bookids' ";
        $results=mysqli_query($con,$querys);

        $enterquerysold=" insert into sold_books(sold_seller_id,sold_buyer_id,sold_book_id) values('$sid','$buyerid','$bookids') ";
        $resultsold=mysqli_query($con,$enterquerysold);
        $booksold="sold";
        $upbkquery=" update book set book_status='$booksold' where book_id='$bookids' ";
        $changestatus=mysqli_query($con,$upbkquery);

    echo '<meta http-equiv="refresh" content="0; url='. "mpjrequest.php" .'" />';
    exit;
  }



  if($_GET && isset($_GET["notsold"]))                //Not sold button functionality
   {

    $buyerid = $_GET['buyerid'];
    $sid = $_GET['sellerid'];
    $bookidns=$_GET['bookrid'];

    $con = get_connection();
    $queryns=" delete from request where request_buyer_id='$buyerid' and request_seller_id='$sid' and request_book_id='$bookidns' ";
    $resultns=mysqli_query($con,$queryns);


    echo '<meta http-equiv="refresh" content="0; url='. "mpjrequest.php" .'" />';
    exit;
}


?>



  <?php

  $con=get_connection();
  $sid=$ufid;
  $tmrequest=" select *from request where request_seller_id='$sid'";
  $result=mysqli_query($con,$tmrequest);
  $shoreqnum=mysqli_num_rows($result);
  $i=0;
  if($shoreqnum>0)
{   
    ?>
    <div class="container booktables">
    <h2 style="margin:6px;">Following buyers have shown interest in buying your books</h2>
    <h2 style="margin:6px;">Buyer's information along with name of book requested by the buyer is shown below:</h2>
    <table class='table table-hover table-bordered'>
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Buyer's Name</th>
                    <th>Buyer's Email</th>
                    <th>Buyer's Phone no.</th>
                    <th>Book Name</th>
                    <th>Action</th>
                </tr>
            </thead>
      <?php
        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
          {
              $i++;
              $buyerid = $row["request_buyer_id"]; 
              $bookrid = $row["request_book_id"];

              $strTable = "user";
              $string = "WHERE user_id = '{$buyerid}'";
              $strSelect = "user_firstname, user_lastname, user_contact";
              $result2 = fetch_data($strTable, $string, $strSelect);
              $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

              $strTable = "useremail";
              $string = "WHERE user_eid = '{$buyerid}'";
              $strSelect = "user_emailid";
              $result2 = fetch_data($strTable, $string, $strSelect);
              $rowe2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

              $strTable = "book";
              $string = "WHERE book_id = {$bookrid}";
              $strSelect = "book_name";
              $result3 = fetch_data($strTable, $string, $strSelect);
              $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);  
              
              ?>

              
<tbody>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row2["user_firstname"] ." ".$row2["user_lastname"] ;?></td> 
                    <td><?php echo $rowe2["user_emailid"];?></td> 
                    <td><?php echo $row2["user_contact"];?></td> 
                    <td><?php echo $row3["book_name"];?></td> 
                    
                    <td>
                    <a href="<?php echo "mpjrequest.php?sellerid=".$sid."&buyerid=".$buyerid."&bookrid=".$bookrid."&sold=1"; ?>" class='btn btn-success btn-sm' style="margin:6px;">SOLD</a>
                    <a href="<?php echo "mpjrequest.php?sellerid=".$sid."&buyerid=".$buyerid."&bookrid=".$bookrid."&notsold=1"; ?>" class='btn btn-danger btn-sm' style="margin:6px;">NOT SOLD</a>
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
     // echo "<h2 style='margin:6px;'>No results</h2>"; 
     $_SESSION['myr']=1;
}      
 ?>




<?php
$fname = " ";
$lname = " ";


$bid = $ufid;
$strTable = "request";
$string = "WHERE request_buyer_id = '{$bid}'";
$strSelect = "request_seller_id";
$result = fetch_data($strTable, $string, $strSelect);
$i=1;
$new = 0;
if($result)
{
    
?> 
         <div class="container booktables">
            <h2 style="margin:6px;">Your requests:</h2>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Seller's Name</th>
                        <th>Seller's Email</th>
                        <th>Seller's Phoneno</th>
                        <th>Book Names</th>
                    </tr>
                </thead>
                <?php
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                                            
    
                        $sellerid = $row["request_seller_id"]; 

                        $strTable = "user";
                        $string = "WHERE user_id = '{$sellerid}'";
                        $strSelect = "user_firstname, user_lastname, user_contact";
                        $result2 = fetch_data($strTable, $string, $strSelect);
                        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                        $strTable = "useremail";
                        $string = "WHERE user_eid = '{$sellerid}'";
                        $strSelect = "user_emailid";
                        $result2 = fetch_data($strTable, $string, $strSelect);
                        $rowe2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                              
                        ?>
                <tbody>
                    
                       
                        <?php if(strcmp($fname , $row2["user_firstname"])!=0 && strcmp($lname, $row2["user_lastname"])!=0 || $new == 1)
                                {

                        ?>
                            <tr>   
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $row2["user_firstname"] ." ".$row2["user_lastname"] ;?></td> 
                                    <td><?php echo $rowe2["user_emailid"];?></td> 
                                    <td><?php echo $row2["user_contact"];?></td> 
                        
                        <?php 
                                   $fname = $row2["user_firstname"];
                                   $lname = $row2["user_lastname"];         
                                
                        ?>
                                    <td>
                                        <?php
                                                $strTable = "request";
                                                $string = "WHERE request_seller_id = '{$sellerid}' AND request_buyer_id = '{$bid}'";
                                                $strSelect = "request_book_id";
                                                $result3 = fetch_data($strTable, $string, $strSelect);
                                                while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC))
                                                {
                                                   

                                                    
                                                    $strTable = "book";
                                                    $string = "WHERE book_id = {$row3["request_book_id"]}";
                                                    $strSelect = "book_name";
                                                    $result4 = fetch_data($strTable, $string, $strSelect);
                                                    $row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC);    
                                                    echo $row4["book_name"].", ";

                                                }
                                        ?>
                                    </td>
                              
                            </tr>
                        <?php  $i++;
                        }
                    
                }
                ?> 
                </tbody>           
            </table>
        </div>         
    </div>
<?php   

}
else
{
   $_SESSION['tmr']=1;
}
?>

<?php

     if($_SESSION['myr']==1 && $_SESSION['tmr']==1)
        {
          echo "<h2 class='alert alert-danger' style='margin:10px;'>No results</h1>"; 
        }


     $_SESSION['myr']=0;
     $_SESSION['tmr']=0;
?>

  
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </div>
</body>

