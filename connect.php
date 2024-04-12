<?php

$con = new mysqli('localhost','root','','crudoperation');

if($con){
    echo "Connected";}
else{  
    die(mysqli_error($con));
}

?>