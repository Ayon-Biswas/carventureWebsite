<?php 
require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

if(isset($_GET['seen']))
{
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){ //all is for implementing Mark all as read
        $q="UPDATE `user_queries` SET `seen`=?";
        $values=[1]; //we have passed 1 to `seen` which will mark all as read
        if(update($q,$values,'i')){   //'ii' means data type.integer(i).update is coded in db_config.php
          alert('success','Marked all as read');
        }
        else{
          alert('error','Operation Failed');
        } 
    }
    else{
      $q="UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
      $values=[1,$frm_data['seen']]; //we have to pass 1 to `seen`
      if(update($q,$values,'ii')){   //'ii' means data type.integer(i).update is coded in db_config.php
        alert('success','Marked as read');
      }
      else{
        alert('error','Operation Failed');
      }    
    }
}

if(isset($_GET['del']))
{
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){ //all is for implementing delete all 
        $q="DELETE FROM `user_queries`";
        if(mysqli_query($con,$q)){   //in delete all we have no values to pass.
          alert('success','All Data deleted!');
        }
        else{
          alert('error','Operation Failed');
        }
    }
    else{
      $q="DELETE FROM `user_queries` WHERE `sr_no`=?";
      $values=[$frm_data['del']]; //we have to pass the id `del`
      if(delete($q,$values,'i')){   //'i' means data type.integer(i).delete is coded in db_config.php
        alert('success','Data deleted!');
      }
      else{
        alert('error','Operation Failed');
      }    
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require ('inc/links.php');?>
</head>

<body class="bg-light">
    <?php require ('inc/header.php');?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User Queries</h3>

                <!-- User Queries section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                     <!-- Mark all as read & Delete all button -->
                     <!-- text-end means data will be alligned to right side -->
                        <div class="text-end mb-4"> 
                          <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                            <i class="bi bi-check-all"></i> Mark all read
                          </a>
                          <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                            <i class="bi bi-trash"></i> Delete all
                          </a>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="30%">Massage</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $q= "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC"; //DESC stands for descending order.So that we can see new data first.
                                     $data = mysqli_query($con,$q); //manual query no value passed all fixed.
                                     $i=1; //number of rows present till that will counting go
                                     
                                     //mark as seen and delete button section
                                     while($row = mysqli_fetch_assoc($data)){
                                        $seen ='';
                                        if($row['seen']!=1){
                                          $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Mark as read</a> <br>";//anchor tag sends GET request to mark as seen
                                        }
                                         $seen.="<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";//anchor tag sends GET request to delete
                                        //heredoc method of printing 
                                        echo<<<query
                                          <tr>
                                           <td>$i</td>
                                           <td>$row[name]</td>
                                           <td>$row[email]</td>
                                           <td>$row[subject]</td>
                                           <td>$row[message]</td>
                                           <td>$row[date]</td>
                                           <td>$seen</td>
                                          </tr>
                                        query;
                                        $i++;
                                     }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require ('inc/scripts.php');?>
</body>

</html>