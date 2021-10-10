<?php
include "../connection.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <title>Document</title>
</head>
<body>
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
    asdasd
    <div id="paypal-payment-button">

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


  <?php }else{?>
    <?php echo "error"?>
  <?php }?>


</body>
<script src="https://www.paypal.com/sdk/js?client-id=AY39CmurvQ07z6GuahuonFH6v4pQlUMe8Zb9bib0nj7sS6FYCGm-M6HviIlJ5L2-iUb0HgATLDQWt27w"></script>
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
                  value: '11'
                }
            }]
        });
    },
    onApprove: function(data,actions){
        return actions.order.capture().then(function(details){
            console.log(details)
            
            window.location.replace("http://localhost/final_hotel/back_end/success.php")

        })
    }
}).render('#paypal-payment-button')



</script>

</script>
</html>