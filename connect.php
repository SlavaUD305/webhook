<?php

$connection = mysqli_connect('localhost:3306','root','root','integration');
if ($connection == false){
    console.error(mysqli_connect_error());
    exit;
}