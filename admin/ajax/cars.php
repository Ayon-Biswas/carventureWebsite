<?php
require ('../inc/db_config.php');
require ('../inc/essentials.php');
adminLogin();


if(isset($_POST['add_car']))
{
  $frm_data = filteration($_POST); // Use the original POST data for further processing
  $flag = 0;

  $q1 = "INSERT INTO `cars`(`name`, `milage`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
  $values = [$frm_data['name'], $frm_data['milage'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['desc']];

  if (insert($q1, $values, 'siiiiis')) {
    $flag = 1;
  }

  $car_id = mysqli_insert_id($con);

  $q2 = "INSERT INTO `car_facilities`(`car_id`, `facilities_id`) VALUES (?,?)";
  if ($stmt = mysqli_prepare($con, $q2))
  {
    // Use json_decode to convert the JSON string back to an array
    $facilities = json_decode($_POST['facilities'], true);

    foreach ($facilities as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $car_id, $f);
      mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
  }
  else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  $q3 = "INSERT INTO `car_features`(`car_id`, `features_id`) VALUES (?,?)";
  if ($stmt = mysqli_prepare($con, $q3))
  {
    // Use json_decode to convert the JSON string back to an array
    $features = json_decode($_POST['features'], true);

    foreach ($features as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $car_id, $f);
      mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
  }
  else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  if ($flag) {
    echo 1;
  }
  else {
    echo 0;
  }
}

if(isset($_POST['get_all_cars'])){
  $res = selectAll('cars');
  $i=1;

  $data = "";

  while($row = mysqli_fetch_assoc($res))
  { 

   if($row['status']==1){
     $status = "
     <button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>
     ";
   }
   else{
    $status = "
     <button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>
     ";
   }

    $data.="
    <tr class='align-middle'>
     <td>$i</td>
     <td>$row[name]</td>
     <td>$row[milage] mpg</td>
     <td>
      <span class='badge rounded-pill bg-light text-dark'>
       Adult:$row[adult]
      </span><br>
      <span class='badge rounded-pill bg-light text-dark'>
       children:$row[children]
      </span>
     </td>
     <td>৳$row[price]</td>
     <td>$row[quantity]</td>
     <td>$status</td>
     <td>
        <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-car'>
         <i class='bi bi-pencil-square'></i> Edit
        </button>
     </td>
    </tr>
    ";
    $i++;
  }
  echo $data;
}

if(isset($_POST['get_car'])){ //getting all room data of selected room in edit room modal input field
  $frm_data= filteration($_POST);
  $res1 = select("SELECT * FROM `cars` WHERE `id`=?",[$frm_data['get_car']],'i');
  $res2 = select("SELECT * FROM `car_features` WHERE `car_id`=?",[$frm_data['get_car']],'i'); 
  $res3 = select("SELECT * FROM `car_facilities` WHERE `car_id`=?",[$frm_data['get_car']],'i');

  $cardata = mysqli_fetch_assoc($res1);
  $features =[]; //making empty array and passing it in ajax.features are many so storing in array and converting in json.
  $facilities =[]; //making empty array and passing it in ajax.facilities are many so storing in array and converting in json.
  
  if(mysqli_num_rows($res2)>0)
  {
    while($row = mysqli_fetch_assoc($res2)){
     array_push($features,$row['features_id']);
    }
  }

  if(mysqli_num_rows($res3)>0)
  {
    while($row = mysqli_fetch_assoc($res3)){
     array_push($facilities,$row['facilities_id']);
    }
  }

  $data=["cardata" => $cardata, "features" => $features, "facilities" => $facilities]; //this is an associative array.

  $data = json_encode($data); //convert $data to json and store in the same variable.

  echo $data;
}

if(isset($_POST['edit_car']))
{
  $frm_data = filteration($_POST); // Use the original POST data for further processing
  $flag = 0;

  $q1 = "UPDATE `cars` SET `name`=?,`milage`=?,`price`=?,`quantity`=?,`adult`=?,`children`=?,`description`=? WHERE `id` =?";
  $values = [$frm_data['name'], $frm_data['milage'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['desc'], $frm_data['car_id']];
  if(update($q1,$values,'siiiiisi')){
    $flag = 1;
  }
  $del_features = delete("DELETE FROM `car_features` WHERE `car_id`=?",[$frm_data['car_id']], 'i');
  $del_facilities = delete("DELETE FROM `car_facilities` WHERE `car_id`=?",[$frm_data['car_id']], 'i');

  if(!( $del_facilities && $del_features)){
   $flag=0;
  }

  $q2 = "INSERT INTO `car_facilities`(`car_id`, `facilities_id`) VALUES (?,?)";
  if ($stmt = mysqli_prepare($con, $q2))
  {
    // Use json_decode to convert the JSON string back to an array
    $facilities = json_decode($_POST['facilities'], true);

    foreach ($facilities as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $car_id, $f);
      mysqli_stmt_execute($stmt);
    }
    $flag=1;
    mysqli_stmt_close($stmt);
  }
  else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  $q3 = "INSERT INTO `car_features`(`car_id`, `features_id`) VALUES (?,?)";
  if ($stmt = mysqli_prepare($con, $q3))
  {
    // Use json_decode to convert the JSON string back to an array
    $features = json_decode($_POST['features'], true);

    foreach ($features as $f) {
      mysqli_stmt_bind_param($stmt, 'ii', $car_id, $f);
      mysqli_stmt_execute($stmt);
    }
    $flag = 1;
    mysqli_stmt_close($stmt);
  }
  else {
    $flag = 0;
    die('query cannot be prepared - insert');
  }

  if ($flag) {
    echo 1;
  }
  else {
    echo 0;
  }

}

if(isset($_POST['toggle_status'])){ //toggeling room status with button click
  $frm_data= filteration($_POST);

  $q = "UPDATE `cars` SET `status`=? WHERE  `id`=?";
  $v = [$frm_data['value'],$frm_data['toggle_status']];

  if(update($q,$v,'ii')){
    echo 1;
  }
  else{
    echo 0;
  }

}

?>