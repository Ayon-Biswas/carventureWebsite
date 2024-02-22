<?php

require ('../admin/inc/db_config.php');
require ('../admin/inc/essentials.php');
date_default_timezone_set("Asia/Dhaka"); //php supported timezone under asia,dhaka the closest region to us.

if(isset($_POST['check_availability']))
{
  $frm_data = filteration($_POST);   
  $status = "";
  $result = "";

  //pickup and dropoff validation.php DateTime interface used because only date function returns string.we need to compare dates in below operation.
 
  $today_date = new DateTime(date("Y-m-d"));
  $pickup_date = new DateTime($frm_data['pick_up']);
  $dropoff_date = new DateTime($frm_data['drop_off']);

  if($pickup_date == $dropoff_date)
  {
    $status = 'pick_up_drop_of_equal';
    $result = json_encode(["status"=>$status]);
  }
  else if($dropoff_date < $pickup_date)
  {
    $status = 'drop_of_earlier';
    $result = json_encode(["status"=>$status]);
  }
  else if($pickup_date <  $today_date)
  {
    $status = 'pick_up_earlier';
    $result = json_encode(["status"=>$status]);
  }

  //check booking availability if status is blank else return the error
  
  if($status!=''){
    echo $result;
  }
  else{
    session_start();
    $_SESSION['car'];
    

   $count_days = date_diff($pickup_date,$dropoff_date)->days; // "->" it means that an object is returned from which we are extracting "days" value.
   $payment = $_SESSION['car']['price'] * $count_days;

   $_SESSION['car']['payment'] = $payment;
   $_SESSION['car']['available'] = true;

   $result = json_encode(["status"=>'available',"days"=>$count_days, "payment"=>$payment]);
   echo $result;
  }

}
?>