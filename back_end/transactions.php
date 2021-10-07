<?php

include('../connection.php');
session_start();

$id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
</head>
<body>
    <a href="home.php">Back</a>
    <h2>Your Booking History</h2>
    <?php
    
    //results ng history

    $query_transaction = "SELECT book_info.guest, book_info.check_in, book_info.check_out,book_info.added_on, 
    users.last_name , users.first_name, rooms.room_number ,book_info.id
    FROM book_info 
    LEFT JOIN users ON book_info.users_id = users.id
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    WHERE users.id = '$id'";

    $run_transaction = mysqli_query($conn,$query_transaction);

    if($run_transaction){
        if(mysqli_num_rows($run_transaction) > 0){
            foreach($run_transaction as $row){
                ?>

                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Room Number</th>
                            <th>Number of Guest</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Date: Added On</th>
                        </tr>
                        <tr>
                            <td><?php echo $row ['id']. "."?> </td>
                            <td><?php echo $row ['room_number']?></td>
                            <td><?php echo $row['guest']?></td>
                            <td><?php echo $row ['check_in']?></td>
                            <td><?php echo $row ['check_out']?></td>
                            <td><?php echo $row ['added_on']?></td>
                        </tr>
                    </table>

                <?php
            }
        }else{
            echo "No transactions yet";
        }
    }

    ?>

<h2>Your Current Transactions</h2>


    <?php

    $query_pending = "SELECT proof_of_transaction.id , proof_of_transaction.image, proof_of_transaction.bank, 
    proof_of_transaction.added_on, proof_of_transaction.status,rooms.room_number
    FROM proof_of_transaction
    LEFT JOIN rooms ON proof_of_transaction.room_id = rooms.id
    WHERE user_id='$_SESSION[id]';";
    $run_pending = mysqli_query($conn,$query_pending);

    if($run_pending){
        if(mysqli_num_rows($run_pending) > 0){
            foreach ($run_pending as $row){
                ?>

                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Room</th>
                            <th>Bank</th>
                            <th>Date: Added On</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                           <td><?php echo $row ['id']. "."?></td>
                            <td><?php echo $row ['room_number']?>
                            <td><?php echo $row['bank']?></td>
                            <td><?php echo $row ['added_on']?></td>
                            <td><?php echo $row ['status']?></td>
                        </tr>
                    </table>

                <?php
            }
        }
    }

    ?>
</body>
</html>
