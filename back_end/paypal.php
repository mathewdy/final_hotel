<?php


//MAY ERROR SA PAYPAL

//Paki ayos yung pag insert sa DB JIDI

include('../connection.php');
session_start();

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global-style.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-xxl">
                <a class="navbar-brand" href="home.php">
                ProCreation Hotel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg> Home</a>
                        <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                            <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                        </svg> Rooms</a>
                        <a class="nav-link" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg> Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        
        <a href="home.php" class="btn btn-danger" style="margin-left: 100px; margin-top: 50px">Cancel</a>
    <div class="container-xxl mt-lg-5 mb-5 mb-md-0 bg-light" style="border-radius:20px;">
    <div class="title text-center"><p class="display-4">------Summary------</p></div>
    <div class="container">
    <div class="row px-xxl-5">
        <div class="col-md-12 text-start">
        <p class="lead"> <?php echo 'Room Type: ' .  $name_of_room ?></p>
        <p class="lead"> <?php echo 'Room Number: '. $room_number?></p>
        <p class="lead"> <?php echo 'No. of guest/s: '. $number_of_guest ?></p>
        <p class="lead"> <?php echo 'Day/s of stay: ' . $days. ' Day/s'?></p>
        <p class="lead"> <?php echo 'Price: '.  $total?></p>
        <hr class="featurette-divider">
        </div>
        <div class="col-md-12 text-center border-dark">
            <div id="paypal-payment-button"></div>
        </div>
    </div>

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
            
            window.location.replace("http://localhost/final_hotel/back_end/success.php?success&id=<?php echo $id?>&email=<?php echo $email?>&room_id=<?php echo $room_id?>&in=<?php echo $date_time_check_in?>&out=<?php echo $date_time_check_out?>&guest=<?php echo $number_of_guest?>&originator=<?php echo $mobile_number?>&recipients=<?php echo $mobile_number?>")

        })
    }
}).render('#paypal-payment-button')



</script>

</script>
</html>