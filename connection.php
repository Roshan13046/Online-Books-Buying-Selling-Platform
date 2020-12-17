<?php

$con=mysqli_connect("localhost","root","","bookshare");

if(mysqli_connect_error()){
    die("<div class='alert alert-danger'>Error! Unable to connect. " . mysqli_connect_error(). "</div>");
}

?>