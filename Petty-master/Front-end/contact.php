<?php
    session_start();
    require_once('config.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Petty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="./asset/css/base.css">
    <link rel="stylesheet" href="./asset/css/main.css">
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
    <!--Content-->
    <div class="content container about-page" style="min-height: 500px;">
        <div style="text-align: center;">
            <h3 class="title-about" style="font-size: 40px;"><span class="fas fa-paw"></span>Liên hệ với chúng tôi<span class="fas fa-paw"></span></h3>
        </div>
        <div class="underline"></div>
        <div class="serviceline-overview" >
            <!--chỗ này ảnh của nhóm dịch vụ: nếu là mèo thì thay mèo, chó thì thay chó, chung thì thay hình chung-->
            <div class="img-serviceline" style="background-image: url('https://images.unsplash.com/photo-1507682520764-93440a60e9b5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1525&q=80');"></div>
            <div class="description-serviceline">
                <h3>Thông tin liên lạc</h3>
                <p>Liên hệ trao đổi công việc, hợp tác, thắc mắc về sản phẩm và dịch vụ, vui lòng liên hệ theo thông tin bên dưới:
                </p>
                <ul style="display: block; text-align: center;" class="list">
                    <!--Chỗ list này thì tùy nhóm dịch vụ sẽ có những list nào-->
                    <li style="font-size: 30px; font-family: 'My Font Paragraph';">
                        <div class="mobile-information fas fa-phone-volume" style="margin-right: 10px; color: #108896;"></div>
                        <span style="color: #333;">012.345.678</span>
                    </li>
                    <li style="font-size: 30px; font-family: 'My Font Paragraph';"> 
                        <div class="email-information fas fa-envelope" style="margin-right: 10px; color: #108896;"></div>
                        <span style="color: #333;">nnchi@gmail.com</span>
                    </li>
                    <li style="font-size: 30px; font-family: 'My Font Paragraph';">
                        <div class="location-information fas fa-compass" style="margin-right: 10px; color: #108896;"></div>
                        <span style="color: #333;">143 Xuan Thuy, Cau Giay, Ha Noi</span>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
    
    <!--Footer-->
    <?php
        include"footer.php";
    ?>
</body>
</html>