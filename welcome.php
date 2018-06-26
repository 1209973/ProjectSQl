

    <?php

    // Initialize the session

require_once 'config.php';
    session_start();

     

    // If session variable is not set it will redirect to login page

    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

      header("location: login.php");

      exit;

    }
//echo $_SESSION['username'];
$result= $mysqli->query("select * from users WHERE username ='{$_SESSION['username']}'");
//$result= $mysqli->query("select * from users WHERE username ='me1'");
//$user=$result->fetch_assoc();
//
//		
//		echo $user['username'];


    ?>

     

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Welcome</title>

        <link rel="stylesheet" href="css/bootstrap.css">

        <style type="text/css">

            body{ font: 14px sans-serif; text-align: center; }

        </style>

    </head>

    <body>

        <div class="page-header">

            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>

        </div>
        
         <table width='80%' border=0>
        <tr bgcolor='#CCCCCC'>
           	<td>ID</td>
            <td>Name</td>
            <td>Password</td>
            <td>created on</td>
            <td>Update</td>
        </tr>
        <?php 
        
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['id']."</td>";
            echo "<td>".$res['username']."</td>";
            echo "<td>".$res['password']."</td>"; 
			echo "<td>".$res['created_at']."</td>"; 
            echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
        }
			 print_r($res);
        ?>
    </table>

        <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>

    </body>

    </html>

