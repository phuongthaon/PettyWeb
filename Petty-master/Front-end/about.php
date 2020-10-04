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
        include "header.php";
    ?>
    <!--Menu-->
    <?php
        include "menu.php";
    ?>
    <!--Content-->
    <div class="content container about-page" style="min-height: 500px;">
        <div style="text-align: center;">
            <h3 class="title-about"><span class="fas fa-paw"></span>Những điều cần biết về Petty<span class="fas fa-paw"></span></h3>
        </div>
        <div class="underline"></div>
        <div class="about-logo-petty"></div>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In laborum, sapiente cum temporibus ex dolorem totam exercitationem quia, 
            laudantium amet omnis ab nobis excepturi architecto fugiat non pariatur? Corporis, deserunt!
        </p>
        <br>
        <div style="text-align: center;">
            <h3 class="title-about"><span class="fas fa-paw"></span>Nơi cung cấp những trải nghiệm tốt nhất<span class="fas fa-paw"></span></h3>
        </div>
        <div class="underline"></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti, dolor! Odio illo molestias corporis? Dolorum cumque in reiciendis distinctio veniam maxime perspiciatis nulla magni atque. 
            Eius iusto consectetur minima facilis.
        </p>
        <ul>
            <li>
                <div class="item-about many"></div>
                <p>Các mặt hàng phong phú</p>
            </li>
            <li>
                <div class="item-about service-quality"></div>
                <p>Nhiều dịch vụ chất lượng</p>
            </li>
            <li>
                <div class="item-about advice"></div>
                <p>Tư vấn 24/24</p>
            </li>
        </ul>
        <br>
        <div style="text-align: center;">
            <h3 class="title-about"><span class="fas fa-paw"></span>Khám phá ngay kho hàng và dịch vụ tại Petty<span class="fas fa-paw"></span></h3>
        </div>
        <div class="underline"></div>
        <div class="button-group">
            <div class="card" style="width:400px; margin-right: 50px;">
                <div class="card-img-top shop-img"></div>
                <div class="card-body">
                  <h4 class="card-title">Mua sắm online</h4>
                  <p class="card-text">Hãy sắm ngay cho thú cưng của bạn những vật dụng cần thiết với Petty</p>
                  <button class="btn btn-warning">Mua sắm ngay!</button>
                </div>
              </div>
              <div class="card" style="width:400px">
                <div class="card-img-top service-img"></div>
                <div class="card-body">
                  <h4 class="card-title">Dịch vụ của chúng tôi</h4>
                  <p class="card-text">Hãy đến ngay với các dịch vụ tốt của Petty để thú cưng của bạn có những trải nghiệm tốt nhất</p>
                  <button class="btn btn-info" onclick='window.location.href = "serviceline.php?id=4";''>Đặt lịch dịch vụ!</button>
                </div>
              </div>
        </div>
    </div>

    <!--Footer-->
    <?php
        include "footer.php";
    ?>
</body>
</html>