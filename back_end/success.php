<?php
session_start();
include('../connection.php');

if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global-style.css"/>
    <title>Document</title>
    
</head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<body style="background:rgba(0,0,0,0.7);">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-xxl">
                <a class="navbar-brand" href="home.php">
                    ProCreation
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
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendPDF($send_pdf, $email, $acc_id, $full_name){
    require("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
    
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'cmdyzxcvbnm123@gmail.com';                     //SMTP username
        $mail->Password   = 'mathewpogi123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('cmdyzxcvbnm123@gmail.com', 'Hotel De Luna');
        $mail->addAddress($email);     //Add a recipient
        //add pdf attachment
        $mail->addStringAttachment($send_pdf,'Hotel Receipt.pdf');
        //Content
        $mail->isHTML(true);
        
        //Set email format to HTML
        $mail->Subject = 'Book Receipt from Hotel De Luna ';
        $mail->Body = "<span style=font-size:18px;letter-spacing:0.5px;color:black;>Good day <b>$full_name</b>!</span><br><span style=font-size:15px;letter-spacing:0.5px;color:black;>Your account id is <b>$acc_id</b><br> Below of this message is your receipt please print it out before entering in our fucking hotel u shit motherfucker!</span>";
    
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    
}




$error = NULL;
?>  

</div>
    <?php
        if(isset($_GET['success']) && isset($_GET['id']) && isset($_GET['email']) && isset($_GET['room_id']) && isset($_GET['in']) && isset($_GET['out']) && isset($_GET['guest']) && isset($_GET['mod'])){
            $id = $_GET['id'];
            $email = $_GET['email'];
            $room_id = $_GET['room_id'];
            $check_in = $_GET['in'];
            $check_out = $_GET['out'];
            $number_of_guest = $_GET['guest'];
            $default_payment_method = $_GET['mod'];
        
            $chck_in = strtotime($_GET['in']);
            $chck_out = strtotime($_GET['out']);

            date_default_timezone_set('Asia/Manila');
            $date = date("Y-m-d h:i:s A");

            $change_room_status = "reserved";

            //pending ito sa book_info
            $book_info_status = "reserved";

            $query_user = "SELECT * FROM users WHERE id = '$id' AND email = '$email'";
            $q_user = mysqli_query($conn, $query_user);
            $rows = mysqli_fetch_array($q_user);
            $acc_id = $rows['account_id'];
            $mobile_number = $rows['mobile_number'];
            $f_name = $rows['first_name'];
            $l_name = $rows['last_name'];
            $f_name = ucwords($f_name);
            $l_name = ucwords($l_name);
            $full_name = "".$f_name." ".$l_name."";

            if(mysqli_num_rows($q_user) == 1){
    
                $get_room_info = "SELECT rooms.id,rooms.room_number, room_types.name_of_room, room_types.price, packages.name_package, packages.description
                FROM rooms 
                LEFT JOIN room_types ON rooms.room_type_id = room_types.id
                LEFT JOIN packages ON room_types.package_id = packages.id
                WHERE rooms.id = $room_id";
                $q_get_room = mysqli_query($conn, $get_room_info);
                $room_row = mysqli_fetch_array($q_get_room);

                $tax = 520;
                $difference = $chck_out - $chck_in;
                $price = $room_row['price'];
                $days = floor($difference/(60*60*24));
                $sub_total = $days * $price;
                $total = $sub_total + $tax;
                
                $insert_booking = "INSERT INTO transactions (`room_id`, `users_id`, `guest`, `check_in`, `check_out`, `added_on`, `status`, `payment_method`) VALUES 
                ('$room_id', '$id', '$number_of_guest', '$check_in', '$check_out' , '$date','$book_info_status','$default_payment_method')";
                $sql_booking = mysqli_query($conn, $insert_booking);
                if($sql_booking){
                    require('fpdf184/fpdf.php');
                    // Format ng pag gawa ng pdf
                    // Cell(width, height, 'text', border(boolean to 1 & 0 lang), new line,'text align')
                    
                    $pdf = new FPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', '', 25);
                    $pdf->Ln(2);
                    $pdf->Cell(125, 5, 'ProCreation Hotel', 0, 0);
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->Cell(10, 5, 'Date', 0, 0);
                    $pdf->Cell(52, 5, ': ' . $date, 0, 1);
                    $pdf->SetFont('Arial', '', 9);
                    $pdf->Cell(0, 5, '154 Sun Gigilead luang St. Sampaloc, Manila', 0, 1);
                    $pdf->Cell(0, 2, 'Manila', 0, 0);
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->Ln(14);
                    $pdf->Cell(55, 5, 'Account No.', 0, 0);
                    $pdf->Cell(58, 5, ': '. $acc_id, 0, 1);
                    $pdf->Cell(55, 5, 'Full Name', 0, 0);
                    $pdf->Cell(58, 5, ': '. $full_name, 0, 1);
                    $pdf->Cell(55, 5, 'Email', 0, 0);
                    $pdf->Cell(58, 5, ': '. $email, 0, 1);
                    $pdf->Cell(55, 5, 'Mobile No.', 0, 0);
                    $pdf->Cell(58, 5, ': '. $mobile_number, 0, 1);
                    $pdf->Line(10, 32, 200, 32);
                    $pdf->Ln(6);
                    $pdf->SetFont('Arial', '', 18);
                    $pdf->Cell(0, 15, 'Room Info', 0, 1);
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->Line(10, 60, 200, 60);
                    $pdf->Cell(55, 5, 'Room No.', 0, 0);
                    $pdf->Cell(58, 5, ': '. $room_row['room_number'], 0, 1);
                    $pdf->Cell(55, 5, 'Room Type', 0, 0);
                    $pdf->Cell(58, 5, ': '. ucwords($room_row['name_of_room']), 0, 1);
                    $pdf->Cell(55, 5, 'Package', 0, 0);
                    $pdf->Cell(58, 5, ': '. ucwords($room_row['name_package']), 0, 1);
                    $pdf->Cell(55, 5, 'Inclusive', 0, 0);
                    $pdf->MultiCell(140, 5, ': '. $room_row['description'], 0, 1);
                    $pdf->Line(10, 110, 200, 110);
                    $pdf->Ln(15);
                    $pdf->SetFont('Arial', '', 18);
                    $pdf->Cell(0, 15, 'Book Info', 0, 1);
                    $pdf->SetFont('Arial', '', 12);
                    $pdf->Cell(55, 5, 'No. of Guest', 0, 0);
                    $pdf->Cell(58, 5, ': '. $full_name, 0, 1);$pdf->Cell(55, 5, 'Check-in', 0, 0);
                    $pdf->Cell(58, 5, ': '. $check_in, 0, 1);
                    $pdf->Cell(55, 5, 'Check-out', 0, 0);
                    $pdf->Cell(58, 5, ': '. $check_out, 0, 1);
                    $pdf->Cell(55, 5, 'Days of Stay', 0, 0);
                    $pdf->Cell(58, 5, ': '. $days, 0, 1);
                    $pdf->Cell(55, 5, 'Request Status', 0, 0);
                    $pdf->Cell(58, 5, ': '. ucwords($change_room_status), 0, 1);
                    $pdf->Ln(5);
                    $pdf->Cell(130, 5, '', 0, 0);
                    $pdf->Cell(30, 5, 'Sub Total', 0, 0);
                    $pdf->Cell(58, 5, ': $ '. $sub_total, 0, 1);
                    $pdf->Cell(130, 5, '', 0, 0);
                    $pdf->Cell(30, 5, 'Tax', 0, 0);
                    $pdf->Cell(58, 5, ': $ '. $tax, 0, 1);
                    $pdf->Cell(130, 5, '', 0, 0);
                    $pdf->Cell(30, 5, 'Total', 0, 0);
                    $pdf->Cell(58, 5, ': $ '. $total, 0, 1);
                    $pdf->Ln(21.05);
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->Cell(0, 5, 'Thank you for booking!', 0, 0, "C");
                    $pdf->Line(10, 195, 84, 195);
                    $pdf->Line(126, 195, 200, 195);
                    $send_pdf = $pdf->Output('', 'S');
                    
                    sendPDF($send_pdf, $email, $acc_id, $full_name);
                    echo '<script>swal({
                        title: "Transaction Success!",
                        text: "Check your email for your receipt",
                        type: "success"
                        }).then(function() {
                        // Redirect the user
                        window.location.href="home.php";
                    });</script>';

                    
                }else{
                    echo "May mali sa code pm mo ako -jade";
                    
                }
            }
        }
    ?>

</body>
</html>