<?php
session_start();
include('../connection.php');
include('./includes/header.php');


$id = $_SESSION['id'];

?>
<div class="container p-lg-5">
<a href="home.php" class="btn btn-dark mb-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg><small>Back</small></a>
    <p class="lead display-3 text-muted">Booking History</p>
    <?php
    
    //results ng history

<<<<<<< HEAD
    $query_transaction = "SELECT transactions.guest, transactions.check_in, transactions.check_out,transactions.added_on, 
    users.last_name , users.first_name, rooms.room_number ,transactions.id, transactions.status
    FROM transactions 
    LEFT JOIN users ON transactions.users_id = users.id
    LEFT JOIN rooms ON transactions.room_id = rooms.id
    WHERE users.id = '$id' AND transactions.status= 'done'";

=======
    $query_transaction = "SELECT book_info.guest, book_info.check_in, book_info.check_out,book_info.added_on, 
    users.last_name , users.first_name, rooms.room_number ,book_info.id, book_info.status
    FROM book_info 
    LEFT JOIN users ON book_info.users_id = users.id
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    WHERE users.id = '$id' AND book_info.status= 'reserved'"; ?>
    <table class="table table-hover">
        <thead class="text-muted">
            <tr>
                <th>Room Number</th>
                <th>Number of Guest</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Date: Added On</th>
            </tr>
        </thead>
    <?php
>>>>>>> a4424bf10fa5479bcbfb646dba80f6ecb414de30
    $run_transaction = mysqli_query($conn,$query_transaction);

    if($run_transaction){
        if(mysqli_num_rows($run_transaction) > 0){
            foreach($run_transaction as $row){
                ?>

    <tbody>
        <tr>
            <td><?php echo $row ['room_number']?></td>
            <td><?php echo $row['guest']?></td>
            <td><?php echo $row ['check_in']?></td>
            <td><?php echo $row ['check_out']?></td>
            <td><?php echo $row ['added_on']?></td>
        </tr>
    </tbody>
    </table>

                <?php
            }
        }else{
            echo "No transactions yet";
        }
    }
    ?>
</div>
<div class="container p-lg-5">
<p class="lead display-3 text-muted">Current Transaction</p>

    <?php

<<<<<<< HEAD
    $query_pending = "SELECT  transactions.guest, transactions.check_in,transactions.check_out,
    transactions.added_on,transactions.status, rooms.room_number,users.id, transactions.payment_method, transactions.bank
    FROM transactions 
    LEFT JOIN rooms ON transactions.room_id = rooms.id
    LEFT JOIN users ON transactions.users_id = users.id
    WHERE transactions.status = 'pending' OR transactions.status='reserved' AND transactions.users_id ='$_SESSION[id]' ";
    $run_pending = mysqli_query($conn,$query_pending);

=======
    $query_pending = "SELECT  book_info.guest, book_info.check_in,book_info.check_out,
    book_info.added_on,book_info.status, rooms.room_number,users.id, book_info.payment_method, book_info.bank
    FROM book_info 
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    LEFT JOIN users ON book_info.users_id = users.id
    WHERE book_info.status = 'pending' AND book_info.users_id ='$_SESSION[id]' ";
    $run_pending = mysqli_query($conn,$query_pending); ?>
    <table class="table table-hover">
        <thead class="text-muted">
            <tr>
                <th>Room</th>
                <th>Payment Method</th>
                <th>Bank</th>
                <th>Date: Added On</th>
                <th>Status</th>
            </tr>
        </thead>
    <?php
>>>>>>> a4424bf10fa5479bcbfb646dba80f6ecb414de30
    if($run_pending){
        if(mysqli_num_rows($run_pending) > 0){
            foreach ($run_pending as $row){
                ?>
<<<<<<< HEAD
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Room</th>
                            <th>Payment Method</th>
                            <th>Bank</th>
                            <th>Date: Added On</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                           <td><?php echo $row ['id']. "."?></td>
                            <td><?php echo $row ['room_number']?>
                            <td><?php echo $row['payment_method']?></td>
                            <td><?php echo $row ['bank']?></td>
                            <td><?php echo $row ['added_on']?></td>
                            <td><?php echo $row ['status']?></td>
                        </tr>
                    </table>
=======
            <tbody>
                <tr>
                    <td><?php echo $row ['room_number']?>
                    <td><?php echo $row['payment_method']?></td>
                    <td><?php echo $row ['bank']?></td>
                    <td><?php echo $row ['added_on']?></td>
                    <td><?php echo $row ['status']?></td>
                </tr>
            </tbody>
        </table>
>>>>>>> a4424bf10fa5479bcbfb646dba80f6ecb414de30

                <?php
            }
        }else{
            echo "No transactions yet" . $conn->error;
        }
    }

    ?>
</div>
</div>
<?php
include('./includes/footer.php');
?>