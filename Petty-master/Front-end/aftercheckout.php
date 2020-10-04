<?php
    session_start();
    include "config.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
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
        include 'header.php';
    ?>
    <!--Menu-->
    <?php
        include 'menu.php';
    ?>
    
    <div class=" container" style="min-height: 500px; padding: 30px">
        <div class="msg shadow" style="min-height: 400px;">
            <div style="text-align: center;"><img src="asset/resource/img/checklist.png" width= 300px height=300px></div>
            <div style="text-align: center;">Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đang được xử lý và sẽ sớm được giao tới bạn!</div>
            <div style="text-align: center;" class="mt-3"><button style="margin: 0 auto;" class="btn btn-info" onclick="window.location.href = '../index.php';">Tiếp tục mua hàng</button></div>
        </div>
    </div>
    <!--Footer-->
    <?php
        include 'footer.php';
    ?>
</body>
</html>