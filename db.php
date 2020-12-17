<?php
    // connection

    function get_connection()
    {
        $con = mysqli_connect("localhost", "root", "", "bookshare") or 
        die("<div class='alert alert-danger'>Error! Unable to connect. " . mysqli_connect_error(). "</div>");
        return $con;
    }


    // fetch data
    function fetch_data($strTable, $string, $strSelect = "*", $debug=false)
    {
        $con = get_connection();
        $query = "SELECT {$strSelect} FROM {$strTable} {$string}";
        if($debug)
        {
            echo $query;
            exit;
        }
        $result = mysqli_query($con, $query);

        $num = mysqli_num_rows($result);
        if($num > 0)
        {
            return $result;
        }
        else
        {
            return FALSE;
        }
    }

?>