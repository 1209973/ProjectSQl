

    <?php

    // Include config file

    require_once 'config.php';



    // Define variables and initialize with empty values

    $username = $password = "";

    $username_err = $password_err = "";

     

    // Processing form data when form is submitted

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo '<script language="javascript">';

        echo '</script>';
        echo $_POST["username"];

        // Check if username is empty

        if(empty(trim($_POST["username"]))){

            $username_err = 'Please enter username.';

        } else{

            $username = trim($_POST["username"]);

        }

        

        // Check if password is empty

        if(empty(trim($_POST['password']))){

            $password_err = 'Please enter your password.';

        } else{

            $password = trim($_POST['password']);

        }

        

        // Validate credentials

        if(empty($username_err) && empty($password_err)){

            // Prepare a select statement

            $sql = "SELECT username, password FROM log_in WHERE username = ?";

            

            if($stmt = $mysqli->prepare($sql)){

                // Bind variables to the prepared statement as parameters

                $stmt->bind_param("s", $param_username);

                

                // Set parameters

                $param_username = $username;

                

                // Attempt to execute the prepared statement

                if($stmt->execute()){

                    // Store result

                    $stmt->store_result();

                    

                    // Check if username exists, if yes then verify password

                    if($stmt->num_rows == 1){                    

                        // Bind result variables

                        $stmt->bind_result($username, $hashed_password);

                        if($stmt->fetch()){
                            echo '<script language="javascript">';

                            echo '</script>';
                            if(password_verify($password, $hashed_password)){

                                /* Password is correct, so start a new session and

                                save the username to the session */

                                session_start();

                                $_SESSION['ID'] = $username;


								if(substr( $username, 0, 1 ) === "S"){
                                    $_SESSION['role']= "Student";
                                    $student_status=mysqli_fetch_array($mysqli->query("select status from student WHERE Student_id ='{$_SESSION['ID']}'"));
                                    $_SESSION['status']= $student_status['status'];
                                    header("location: Student/welcome.php");
								}

                               elseif(substr( $username, 0, 1 ) === "P"){
                                   $_SESSION['role']= "Professor";
                                   $_SESSION['status']= "";
                                   header("location: Proffessor/welcome.php");
								}

                                elseif(substr( $username, 0, 1 ) === "M"){
                                    $_SESSION['role']= "Admin";
                                    $_SESSION['status']= "";
									header("location: Manager/welcome.php");
								}

                            } else{

                                // Display an error message if password is not valid

                                $password_err = 'The password you entered was not valid.';

                            }

                        }

                    } else{

                        // Display an error message if username doesn't exist

                        $username_err = 'No account found with that username.';

                    }

                } else{

                    echo "Oops! Something went wrong. Please try again later.";

                }

            }

            

            // Close statement

            $stmt->close();

        }

        

        // Close connection

        $mysqli->close();

    }

    ?>

     

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Login</title>

				<link rel="stylesheet" href="
				css/bootstrap.css">

        <style type="text/css">

            body{ font: 14px sans-serif;background: url("images/frontpage.jpg") no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover;  -o-background-size: cover;  background-size: cover; }

            .wrapper{    float: left;
                text-align: center;
                width: 350px;
                padding: 20px;
                background-color: #75717166;
                height: 100vh;
                color: #fff; }

        </style>


    </head>

    <body>

        <div class="wrapper">

            <h2>Login</h2>

            <p>Please fill in your credentials to login.</p>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">

                    <label>Username</label>

                    <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">

                    <span class="help-block"><?php echo $username_err; ?></span>

                </div>    

                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                    <label>Password</label>

                    <input type="password" name="password" class="form-control">

                    <span class="help-block"><?php echo $password_err; ?></span>

                </div>

                <div class="form-group">

                    <input type="submit" class="btn btn-primary" value="Login">

                </div>
                <div style="position: fixed;bottom: 13%;">
                    <p>Email  : andersonsuniversity@gmail.com</p>
                   <p>TEL    : +9600000124578</p>
                    <p>FAX    : +2654782145</p>
                </div>

<!--                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->

            </form>

        </div>    

    </body>

    </html>



