<?php
include "email_status.php";
include "../connection.php";
include "./includes/header.php";
?>
  <?php 
  if(isset($_GET['paypal']) && isset($_GET['id']) && isset($_GET['uid']) && isset($_GET['g']) && isset($_GET['in']) && isset($_GET['out'])){
    $room_id = $_GET['id'];
    $user_id = $_GET['uid'];
    $guest = $_GET['g'];
    $check_in = $_GET['in'];
    $check_out = $_GET['out'];
    

    $date_in = date("Y-m-d", strtotime($check_in));
    $time_in = date("h:i A", strtotime($check_in));
    
    $date_out = date("Y-m-d", strtotime($check_out));
    $time_out = date("h:i A", strtotime($check_out));

    $in = strtotime($check_in);
    $out = strtotime($check_out);

    $sql_user = "SELECT * FROM users WHERE id = '$user_id'";
    $query_user = mysqli_query($conn, $sql_user);
    $ROWS = mysqli_fetch_array($query_user);
    $mobile_number = $ROWS['mobile_number'];
    $last_name = $ROWS['last_name'];


    $sql = "SELECT rooms.room_number, room_types.name_of_room, room_types.price FROM rooms
    LEFT JOIN room_types ON rooms.room_type_id = room_types.id WHERE rooms.id = '$room_id'";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_array($query);

        $tax = 7.4;
        $difference = $out - $in;
        $price = $rows['price'];
        $days = floor($difference/(60*60*24));
        $sub_total = $days * $price;
        $total = $sub_total + $tax;
    
    if(empty($room_id) && empty($user_id) && empty($guest) && empty($check_in) && $check_out){
      header("Location:index.php");
    }else{
      $check_account = "SELECT id FROM users WHERE id = '$user_id'";
      $query_check = mysqli_query($conn, $check_account);
      if(mysqli_num_rows($query_check) == 0){
        echo "wala sa db";
      }
    }
    ?>
    <div class="container px-lg-5">
      
      <h2 class="p-3 display-1 text-muted text-center">Payment Summary</h2>
      <hr class="featurette-divider">
      <div class="container pt-3 d-flex flex-column justify-content-center w-50">

        <p >Room Type: <?php echo ucwords($rows['name_of_room'])?></p>
        <p>Room Number: <?php echo $rows['room_number']?></p>
        <p >No. of Guest/s: <?php echo $guest?></p>
        <p>Day/s of Stay: <?php echo $days?></p>
        <p class="pb-3">Price: <?php echo $total?></p>
  
        <div id="paypal-payment-button"></div>
      </div>
    </div>
   


  <?php }else if(isset($_GET['other']) && isset($_GET['id']) && isset($_GET['uid']) && isset($_GET['g']) && isset($_GET['in']) && isset($_GET['out'])){
    $room_id = $_GET['id'];
    $user_id = $_GET['uid'];
    $guest = $_GET['g'];
    $check_in = $_GET['in'];
    $check_out = $_GET['out'];

    $date_in = date("Y-m-d", strtotime($check_in));
    $time_in = date("h:i A", strtotime($check_in));
    
    $date_out = date("Y-m-d", strtotime($check_out));
    $time_out = date("h:i A", strtotime($check_out));

   
    if(empty($room_id) && empty($user_id) && empty($guest) && empty($check_in) && $check_out){
      header("Location:index.php");
    }else{
      $check_account = "SELECT id FROM users WHERE id = '$user_id'";
      $query_check = mysqli_query($conn, $check_account);
      if(mysqli_num_rows($query_check) == 0){
        echo "wala sa db";
    }
  }
  ?>
  <div class="container">
    <h3 class="display-1 text-muted text-center pb-0">Bank Partners</h3>
    
    <div class="container pt-3">
      <hr class="featurette-divider">

    
    
    <form action="#" method=POST enctype="multipart/form-data">
        <div class="row pt-2">
          <div class="col-6">



          
        <label for="">Select Bank</label>
        <!---di pa to tapos--->
        <!---yung deposit slip dapat to -->
        <select class="form-select" name="bank" id="">
            <option value="">-Select-</option>
            <option value="BDO">BDO Unibank Inc.</option>
            <option value="Metro bank">Metropolitan Bank and Trust Company</option>
            <option value="BPI">Bank of the Philippine Islands</option>
            <option value="Land Bank">Land Bank of the Philippines</option>
            <option value="PNB">Philippine National Bank</option>
            <option value="Security Bank">Security Bank Corporation</option>
            <option value="China Bank">China Banking Corporation</option>
            <option value="DBP">Development Bank of the Philippines</option>
            <option value="Union Bank">Union Bank of the Philippines</option>
            <option value="Rizal Bank">Rizal Commercial Banking and Corporation</option>
        </select>
          </div>
          <div class="col-6">
        <label for="">Upload Image</label>
        <input class="form-control" type="file" name="image_transaction"><br>
    </div>
        </div> 
        <button class="btn btn-outline-dark" type="submit" name="pay">Submit</button>
      </form>
</div>
  </div>
  <?php }else{?>
    <?php echo "error"?>
  <?php }?>


</body>


<script>
    paypal.Buttons({
    style : {
        size: 'responsive',
        color: 'silver',
        shape: 'rect',
        
    },
    createOrder: function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amount: {
                  value: '<?php echo $total?>'
                }
            }]
        });
    },
    onApprove: function(data,actions){
        return actions.order.capture().then(function(details){
            console.log(details)
            
            window.location.replace("http://localhost/final_hotel/guest/approved.php?id=<?php echo $room_id?>&uid=<?php echo $user_id?>&g=<?php echo $guest?>&in=<?php echo $check_in?>&out=<?php echo $check_out?>&mobile_number=<?php echo $mobile_number?>&last_name=<?php echo $last_name?>")

        })
    }
}).render('#paypal-payment-button')

</script>
</html>
<?php 
  if(isset($_POST['pay'])){
    $bank_type = $_POST['bank'];
    $image_transaction = $_FILES['image_transaction']['name'];
    $transaction_status = "pending";
    $payment_method = "bank";

    date_default_timezone_set('Asia/Manila');
    $added_on = date("Y-m-d H:i:s");

  $allowed_extension = array('png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG');
  $filename = $image_transaction;
  $file_extension = pathinfo($filename , PATHINFO_EXTENSION);
  if(!in_array($file_extension, $allowed_extension)){
    echo "<script>swal({
      title: 'Oops invalid request!',
      text: 'Invalid image format',
      icon: 'warning',
      }).then(function() {
      // Redirect the user
      window.location.href='payment.php?other&id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out';
      });</script>";
  }

  $sql_insert = "INSERT INTO transactions (`room_id`, `users_id`, `guest`, `check_in`, `check_out`, `added_on`, `status`, `payment_method`, `image`, `bank`) VALUES ('$room_id', '$user_id', '$guest', '$check_in', '$check_out', '$added_on', '$transaction_status', '$payment_method', '$image_transaction', '$bank_type')";
  $query_insert = mysqli_query($conn, $sql_insert);move_uploaded_file($_FILES["image_transaction"]["tmp_name"], "../back_end/receipt/".$_FILES["image_transaction"] ["name"]);

  if($query_insert){
    echo "<script>swal({
      title: 'Transaction Success!',
      text: 'Wait for administrator to confirm your request',
      icon: 'success',
      }).then(function() {
      // Redirect the user
      window.location.href='index.php';
      });</script>";
  }else{
    echo "<script>swal({
      title: 'Oops invalid request!',
      text: 'Something went wrong',
      icon: 'warning',
      }).then(function() {
      // Redirect the user
      window.location.href='payment.php?other&id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out';
      });</script>";
  }

}
?>
