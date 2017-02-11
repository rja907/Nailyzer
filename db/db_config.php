<?php

function Connect_DB()
{
    $db_host="localhost";
    
    $db_user="root";
    
    $db_password="";
    $db_name="nailyzer";
    if(@$db_link=mysqli_connect($db_host,$db_user,$db_password,$db_name))
    {
        //Connected Successfully;
        return $db_link;
    }

    else
    {
        die("Connection Error");
    }

}

?>