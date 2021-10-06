<?php
session_start();
include('../connection.php');
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

<a href="home.php">Back</a>
    <?php

    $query_user = "SELECT * FROM users WHERE id='$_SESSION[id]'";
    $run_user = mysqli_query($conn,$query_user);

    if($run_user){
        if(mysqli_num_rows($run_user) > 0){
            foreach($run_user as $row){
                ?>

                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Mobile Number</th>
                        <th>Email Address</th>
                        <th>Edit</th>
                    </tr>
                    <tr>
                        <td><?php echo $row ['first_name']?></td>
                        <td><?php echo $row ['last_name']?></td>
                        <td><?php echo $row ['mobile_number']?></td>
                        <td><?php echo $row ['email']?></td>

                        <td>
                            <a href="edit_profile.php?id=<?php echo $row ['id']?>">Edit</a>
                        </td>
                    </tr>
                </table>


                <?php
            }
        }
    }

    ?>
</body>
</html>