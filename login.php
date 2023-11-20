<?php
    require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        function input_filter($inputt) {
            $inputt = trim($inputt);
            $inputt = stripslashes($inputt);
            $inputt = htmlspecialchars($inputt);
            return $inputt;
        }

        if (isset($_POST['signIn'])) {
            #filtering user input
            $username = input_filter($_POST['adminUsername']);
            $password = input_filter($_POST['adminPassword']);
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            #searching username and password in database
            $stmt = $conn->prepare("SELECT * FROM `admins` WHERE `username`=? AND `apassword`=?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            
            
            if (!$result) {
                die("query failed: ".$conn->error);
            } 
            else {                

                if (mysqli_num_rows($result)==1) {
                    session_start();

                    $actualName = '';
                    $uniqueID = '';
                    while ($row = mysqli_fetch_assoc($result)) {$actualName = $row['name']; $uniqueID = $row['uniqueID'];}

                    if (!empty($actualName) && !empty($uniqueID)) {$_SESSION['AdminLoginId']=$actualName; $_SESSION['uniqueId']=$uniqueID;}

                    header("location: panel.php");
                } else {
                    echo "<script>alert('incorrect password')</script>";
                }
            }
            
            // Close prepared statement
            $stmt->close();
                        
        }
                
        // Close connection
        $conn->close();
    ?>

    <!-- Login Form -->
    <div class="login-form">
        <h2>ADMIN LOGIN PANEL</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="input-field">
                <i class="fa fa-user"></i>
                <input type="text" placeholder="Admin Name" name="adminUsername">
            </div>

            <div class="input-field">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="Password" name="adminPassword">
            </div>

            <button type="submit" name="signIn">Sign In</button>

            <div class="forget">
                <a href="#">Forgot Password ?</a>
            </div>
        </form>
    </div>
    
</body>
</html>