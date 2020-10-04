<?php
// Initialize the session

session_start();
 
// Check if the user is already logged in, if yes then redirect him to account page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: account.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = '".$username."' AND password = PASSWORD(".$password.")";
        $query = mysqli_query($link, $sql);
        if($row = mysqli_fetch_assoc($query)){
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row['id'];
        $_SESSION["username"] = $row['username'];                                   
        // Redirect user to account page
        header("location: account.php");
        } else{
            // Display an error message if username doesn't exist
            $username_err = "Login error.";
        }
    }

    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Petty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="../Front-end/asset/css/base.css">
    <link rel="stylesheet" href="../Front-end/asset/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../Front-end/asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../Front-end/asset/css/owl.theme.default.min.css">
</head>
<body>
    <!--Header-->
    <?php
        include "header.php";
    ?>
    <!--Menu-->
    <?php
        include "menu.php";
    ?>
    <!--Content-->
    <div class="content container" style="min-height: 300px; display: flex; padding-top: 15px; padding-bottom: 15px;">
        <div class="mr-4">
            <img src="../Front-end/asset/resource/img/cat2.png">
        </div>
        <div>
            <div class="shadow" style="width: 500px;padding: 20px;">
                <h2 style="text-align: center; font-family: 'My Font Regular'; color: #ef5030;"><i class="fas fa-paw"></i>Đăng nhập<i class="fas fa-paw"></i></h2>
                <p style="text-align: center;">Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-group petty-form">
                    <div class="item-reg">
                        <label>Username(*)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                              </div>
                            <input class="form-control" type="text" name="username" placeholder="Enter your username..."  value="<?php echo $username; ?>" required>
                        </div>
                        <span><?php echo $username_err?></span>
                    </div>    
                    <div class="item-reg">
                        <label>Password(*)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input class="form-control" type="password" name="password" placeholder="Enter your password..."  value="<?php echo $password; ?>" required>
                        </div>
                        <span><?php echo $password_err?></span>
                    </div>
                    <div class="item-reg" style="margin-top: 30px;">
                        <input class="submit" type="submit" value="Login">
                    </div>
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php
        include "footer.php";
    ?>
</body>
</html>