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
        include "header.php";
    ?>
    <!--Menu-->
    <?php
        include "menu.php";
    ?>
    
    <div class="container" style="min-height: 500px; padding: 30px;" >
        <div class="msg shadow bookservice" style="min-height: 400px;">
            <div class="mb-3" style="text-align: center;"><img class="mt-2" src="asset/resource/img/call.png" width= 250px height=250px></div>
            <div style="text-align: center;">Cảm ơn quý khách đã đăng ký sử dụng dịch vụ</div>
            <div style="text-align: center;" class="mt-3"><button style="margin: 0 auto;" class="btn btn-info" onclick="window.location.href = '../index.php';">Tiếp tục mua hàng</button></div>
        </div>
    </div>
    <!--Footer-->
    <?php
        include "footer.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>