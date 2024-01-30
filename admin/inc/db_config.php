<?php

$hname='localhost';
$uname='root';
$pass='';
$db='carventurewebsite';

$con = mysqli_connect($hname,$uname,$pass,$db);

if(!$con){
    die("cannot connect to Database".mysqli_connect_error());
}

#data filtered is array#
function filteration($data){
  foreach($data as $key => $value){
    $value=trim($value);
    $value=stripslashes($value);
    $value=strip_tags($value);
    $value=htmlspecialchars($value);
    $data[$key] = $value;
  }  
  return $data;
}

function select($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values); //binding values and "..." is php splat operator to dynamically bind values to bind param
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
           die("Query cannot be executed -select");
        }
    }
    else{
        die("Query cannot be prepared -select");
    }
}

function update($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values); //binding values and "..." is php splat operator to dynamically bind values to bind param
        if(mysqli_stmt_execute($stmt)){
            $res= mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
           die("Query cannot be executed -update");
        }
    }
    else{
        die("Query cannot be prepared -update");
    }
}

?>