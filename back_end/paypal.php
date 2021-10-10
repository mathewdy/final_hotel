<?php


//MAY ERROR SA PAYPAL

//Paki ayos yung pag insert sa DB JIDI
session_start();
include('../connection.php');
include('./includes/header.php');


if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}

if(isset($_POST['paypal'])){
    $id = $_POST['id'];
    $account_id = $_POST['account_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];

    // date format
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // parse date to integer
    $chck_in = strtotime($_POST['check_in']);
    $chck_out = strtotime($_POST['check_out']);
    //time check in & check out.
    $time_check_in = $_POST['time_check_in'] . ":00";
    $time_check_out = $_POST['time_check_out'] . ":00";

    $date_time_check_in = "".$check_in." ".$time_check_in."";
    $date_time_check_out = "".$check_out." ".$time_check_out."";

        $tax = 7.4;
        $difference = $chck_out - $chck_in;
        $price = $_POST['price'];
        $days = floor($difference/(60*60*24));
        $sub_total = $days * $price;
        $total = $sub_total + $tax;


    $room_id = $_POST['room_id'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $name_package = $_POST['name_package'];

    $number_of_guest = $_POST['number_of_guest'];
    $default_payment_method = "paypal";
}
?>
        
    
    <div class="container p-lg-5">
        <a href="home.php" class="btn btn-light">Cancel</a>
        <p class="fw-regular display-3 text-center text-muted"> Billing Summary</p>
        <hr class="featurette-divider">
            <div class="container py-lg-5" >
                <div class="row mx-lg-5">
                    <div class="col-lg-6">
                        <p class="lead fw-bold"> <?php echo 'Room Type :  ' .  $name_of_room ?></p>
                    </div>
                    <div class="col-lg-6">
                        <p class="lead fw-bold"> <?php echo 'Room Number :  '. $room_number?></p>
                    </div>
                    <div class="col-lg-6 ">
                        <p class="lead fw-bold"> <?php echo 'No. of guest/s :  '. $number_of_guest ?></p>
                    </div>
                    <div class="col-lg-6">
                        <p class="lead fw-bold"> <?php echo 'Day/s of stay :  ' . $days. ' Day/s'?></p>
                    </div>
                    <div class="col-lg-12">
                        <p class="lead fw-bold"> <?php echo 'Price : '.  $total?></p>
                    </div>
                </div>
            </div>  
            <hr class="featurette-divider">
            <span class="mt-5" style="display: grid; place-items:center;">
                <div class="d-flex justify-content-center" id="paypal-payment-button"></div> 
            </span>
        </div>
    </div>
</body>

<?php
/*
require_once __DIR__.'/vendor/autoload.php';
SAKA KO NA TO LALAGYAN NG CLIENT ID
$messagebird = new MessageBird\Client('ekh0GGx1wn6n2pGHn6MSovwdu');
$message = new MessageBird\Objects\Message;
$message->originator = '+639156915704';
$message->recipients = $mobile_number;
$message->body = "Dear Mr/Mrs: $last_name, we would like you to inform your reservation from ProCreations is from $check_in to $check_out. Please check your email to inbox/spam, thank you.";
$response = $messagebird->messages->create($message);


link ito!

//BAKA WALA NA LAMAN SANDBOX

*/

?>

<!-----error pa paypal--->

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
                    value: '<?php echo $total?>'
                }
            }]
        });
    },
    onApprove: function(data,actions){
        return actions.order.capture().then(function(details){
            console.log(details)
            
            window.location.replace("http://<?php echo $_SERVER['SERVER_NAME']?>/final_hotel/back_end/success.php?success&id=<?php echo $id?>&email=<?php echo $email?>&room_id=<?php echo $room_id?>&in=<?php echo $date_time_check_in?>&out=<?php echo $date_time_check_out?>&guest=<?php echo $number_of_guest?>&originator=<?php echo $mobile_number?>&recipients=<?php echo $mobile_number?>&mod=<?php echo $default_payment_method?>")

        })
    }
}).render('#paypal-payment-button')



</script>

</script>
<?php
include('./includes/footer.php');
?>