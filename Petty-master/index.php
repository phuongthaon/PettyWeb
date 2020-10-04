<?php
    session_start();
    require_once('Front-end/config.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Petty</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">  
    <link rel="stylesheet" href="./Front-end/asset/css/base.css">
    <link rel="stylesheet" href="./Front-end/asset/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="./Front-end/asset/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./Front-end/asset/css/owl.theme.default.min.css">
</head>
<body>
    <!--Header-->
    <div class='container-fluid'>
        <div class='container' id='petty-header' style='width: 100%; height: 100%;'>
            <a class='logo' href='index.php'></a>
            <form class='search' action='Front-end/search.php' method='GET'>
                <input class='txtSearch' name='key' type='text' placeholder='Tìm kiếm'>
                <button type='submit' id='btnSearch' onclick='window.location.href = "Front-end/search.php";'><i id='search-icon'></i></button>
            </form>
            <span><i class='fas fa-bell' style='color: white; position: absolute; right: 350px; font-size: 20px; top: 19px;'></i></span>
            <div class='user mt-2 ml-4'>
                <span><i class='fas fa-user-alt' style='color: #ef5030; font-size: 20px;'></i></span>
                <a href='Front-end/login.php' style='color: #fff;'>
                    <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                {
                    echo $_SESSION["username"];
                }
                else
                {
                    echo "Đăng ký/đăng nhập";
                }
                echo "</a>
                        </div>
                        <a href='Front-end/cart.php'>
                            <div class='cart'>
                                <i></i>
                                <span>Giỏ hàng</span>
                                <div class='product-count'>";
                                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && sizeOf($_SESSION['cart']) > 0)
                                {
                                    echo sizeOf($_SESSION['cart']);
                                }
                ?>
                </div>
                </div>
            </a>
        </div>
    </div>
    <!--Menu-->
    <div class='catalog'>
        <div class='item-catalog home'><a style="text-decoration: none;color: #ffff" href="index.php">Trang chủ</a></div>
        <div class='item-catalog about-petty'><a style="text-decoration: none;color: #ffff" href="Front-end/about.php">Giới thiệu<a/></div>
        <div class='item-catalog online-shopping'>Mua hàng online</div>
        <div class='item-catalog dropdown service'>
            <div type='button' class='btn dropdown-toggle' data-toggle='dropdown' style='color: #fff;'>
                Dịch vụ
            </div>
            <div class='dropdown-menu'>
                <?php
                    $sql = "SELECT * FROM serviceline WHERE 1 ORDER BY `order`";
                    $query = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<a class='dropdown-item' href='Front-end\serviceline.php?id=".$row['ID']."'>".$row['serviceLine']."</a>";
                    }
                ?>
            </div>   
        </div>
        <div class='item-catalog'><a style="text-decoration: none;color: #ffff" href="Front-end/contact.php">Liên hệ<a/></div>
        <div class='item-catalog'>Blog</div>
    </div>
    <!--Content-->
    <div class="content">
        <!--Slide giới thiệu tổng quan về cửa hàng-->
        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#demo" data-slide-to="0" class="active"></li>
              <li data-target="#demo" data-slide-to="1"></li>
              <li data-target="#demo" data-slide-to="2"></li>
              <li data-target="#demo" data-slide-to="3"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active" style="background-image: url('./Front-end/asset/resource/img/cat1.jpg');">
                
              </div>
              <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80');">
              </div>
              <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1536500152107-01ab1422f932?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80');">
              </div>
              <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1446730853965-62433e868929?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');">
              </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
          
          </div>
        <div class="item sale-product shadow-sm p-4 mb-4 bg-white container" style="padding: 30px;">
            <div class="sale-product-title" style="font-size: 1.5rem; margin-bottom: 20px;">Sản phẩm được yêu thích</div>
            <div class="owl-carousel owl-theme">
                <?php
                    $sql = "SELECT o.`productCode`, SUM(`quantityOrdered`), d.discountRate FROM `orderdetail` o LEFT JOIN discountproduct d ON o.productCode = d.productCode AND d.endTime > NOW() WHERE 1 GROUP BY `productCode` ORDER BY  SUM(`quantityOrdered`) DESC LIMIT 10";
                    $query = mysqli_query($link, $sql);
                    $result_count = mysqli_num_rows($query);
                    if($result_count > 0)
                    {
                        while($row = mysqli_fetch_assoc($query))
                        {
                            $sql = "SELECT image FROM products WHERE productCode =".$row['productCode'];
                            $query_t = mysqli_query($link, $sql);
                            $row_t = mysqli_fetch_assoc($query_t);
                            if($row_t != NULL)
                                    echo "<div><a href='Front-end/product-detail.php?id=".$row['productCode']."'>
                            <img src='".$row_t['image']."'>";
                            if($row['discountRate'] != NULL)
                                echo "<span class='product-discount-label'>-".$row['discountRate']."%</span> 
                            </a>
                            </div>";
                            else
                                echo "</a>
                            </div>";
                        }
                    }
                ?>
              </div>
        </div>
        <div class="item sale-product container" style="padding: 30px;">
            <div class="sale-product-title" style="font-size: 1.5rem; margin-bottom: 20px;">Sản phẩm đang giảm giá</div>
            <div class="owl-carousel owl-theme">
                <?php
                    $sql = "SELECT *,(SELECT image FROM products p WHERE p.productCode = d.productCode) as image FROM discountproduct d WHERE endTime > NOW() GROUP BY productCode ORDER BY endTime DESC";
                    $query = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<div><a href='Front-end/product-detail.php?id=".$row['productCode']."'>
                        <img src='".$row['image']."'>
                        <span class='product-discount-label'>-".$row['discountRate']."%</span>
                        </a> 
                        </div>";
                    }
                ?>
              </div>
        </div>
        <div class="item service shadow">
            <div class="title">Dịch vụ của chúng tôi</div>
            <div class="service-description">Những dịch vụ tuyệt vời cho thú cưng của bạn. Được thực hiện bởi các chuyên viên dày dặn kinh nghiệm về chăm sóc động vật, giúp thú cưng của bạn có những giờ phút thoải mái nhất.</div>
            <div class="service-list container owl-carousel owl-theme">
            <?php
                $sql = 'SELECT s.*, (SELECT serviceLine FROM serviceline sl WHERE s.serviceline = sl.ID) as serviceline_s FROM services s WHERE 1';
                $query = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='service-item shadow vet'>
                <div class='service-image' style='background-image:url(".$row['serviceImage'].");'></div>
                <div class='service-title'>".$row['serviceName']."</div>
                <div class='service-description-sub'>".$row['serviceline_s']."</div>
                <button class='more-info' onclick='window.location.href = \"Front-end/service-single.php?id=".$row['serviceID']."\";'>Đặt lịch</button>
                </div>";
                }    
            ?>
            </div>
        </div>
        <!--giới thiệu về petty-->
        <div class="item about container">
            <h2 style="font-family: 'My Font Bold'; color: #108896; font-size: 50px; margin: 50px;">Về Petty</h2>
            <div class="float-right" style="display: flex;">
                <div style="width: 500px; display: flex; flex-direction: column; align-items: center;">
                    <h2 style="font-family: 'My Font Bold'; font-size: 40px;">Dành cho thú cưng của bạn</h2>
                    <p style="text-align: center; color: #989797;">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam dolorem voluptatum maiores, officia nulla non sequi 
                        veritatis mollitia repudiandae qui nemo dolore eos vel fugit, consectetur illo ad tempore! Similique!
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam dolorem voluptatum maiores, officia nulla non sequi 
                        veritatis mollitia repudiandae qui nemo dolore eos vel fugit, consectetur illo ad tempore! Similique!
                    </p>
                    <div class="panel-group" id="accordion">

                        <div class="panel card">
                          <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                              Collapsible Group Item #1
                            </a>
                          </div>
                          <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, earum exercitationem? Magni 
                              nisi consequatur repellendus. Quis, reiciendis hic optio, ea ipsa tempora, iste animi velit 
                              repellendus nisi perspiciatis modi veniam.
                            </div>
                          </div>
                        </div>
                      
                        <div class="panel card">
                          <div class="card-header" >
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                              Collapsible Group Item #2
                            </a>
                          </div>
                          <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, earum exercitationem? Magni 
                                nisi consequatur repellendus. Quis, reiciendis hic optio, ea ipsa tempora, iste animi velit 
                                repellendus nisi perspiciatis modi veniam.
                            </div>
                          </div>
                        </div>
                      
                        <div class="panel card">
                          <div class="card-header" >
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                              Collapsible Group Item #3
                            </a>
                          </div>
                          <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, earum exercitationem? Magni 
                                nisi consequatur repellendus. Quis, reiciendis hic optio, ea ipsa tempora, iste animi velit 
                                repellendus nisi perspiciatis modi veniam.
                            </div>
                          </div>
                        </div>
                      
                      </div>
                </div>
                <img style="margin-left: 10px;"src="Front-end/asset/resource/img/cat.png">
            </div>
            <div class="list" style="display: flex;">
                <div class="list-about">
                    <div class="rounded-circle zoom">
                        <div class="good dog-and-pet-house"></div>
                    </div>
                    <h4>Housing</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Aliquam ipsam a corrupti optio dolore incidunt voluptate 
                        molestiae, eius illum perspiciatis soluta dolores ratione tenetur, 
                        ea earum ut voluptates voluptatibus sit.</p>
                </div>
                <div class="list-about">
                    <div class="rounded-circle zoom">
                        <div class="good high-quality"></div>
                    </div>
                    <h4>High Quality</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Aliquam ipsam a corrupti optio dolore incidunt voluptate 
                        molestiae, eius illum perspiciatis soluta dolores ratione tenetur, 
                        ea earum ut voluptates voluptatibus sit.</p>
                </div>
                <div class="list-about">
                    <div class="rounded-circle zoom">
                        <div class="good vet-services"></div>
                    </div>
                    <h4>Vet Services</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Aliquam ipsam a corrupti optio dolore incidunt voluptate 
                        molestiae, eius illum perspiciatis soluta dolores ratione tenetur, 
                        ea earum ut voluptates voluptatibus sit.</p>
                </div>
                <div class="list-about">
                    <div class="rounded-circle zoom">
                        <div class="good special-care"></div>
                    </div>
                    <h4>Special Care</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Aliquam ipsam a corrupti optio dolore incidunt voluptate 
                        molestiae, eius illum perspiciatis soluta dolores ratione tenetur, 
                        ea earum ut voluptates voluptatibus sit.</p>
                </div>
            </div>
        </div>
        <!--Phản hồi của khách hàng-->
        <div class="item feedback shadow">
            <h1 style="font-family: 'My Font Bold'; color: #108896; font-size: 50px; margin: 50px;">Khách hàng của Petty</h1>
            <div style="display: flex;">
                <img src="./Front-end/asset/resource/img/cat2.png">
                <div class="item sale-product container" style="padding: 30px; width: 700px;">
                    <div class="owl-carousel owl-theme" id="feedback">
                        <div class="feedback-item">
                            <img class="rounded-circle" src="https://avatarfiles.alphacoders.com/231/thumb-231160.jpg">
                            <p>Lương Thế Đại</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                        <div class="feedback-item"> 
                            <img class="rounded-circle" src="https://i1.sndcdn.com/avatars-000396329622-7evlwa-t500x500.jpg">
                            <p>Nguyễn Ngọc Chi</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                        <div class="feedback-item">
                            <img class="rounded-circle" src="https://www.nautiljon.com/images/perso/00/67/hijikata_toshiro_2876.jpg">
                            <p>Nguyễn Thảo</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                        <div class="feedback-item"> 
                            <img class="rounded-circle" src="https://avatarfiles.alphacoders.com/231/thumb-231160.jpg">
                            <p>Nguyễn Thị Hà</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                        <div class="feedback-item"> 
                            <img class="rounded-circle" src="https://www.nautiljon.com/images/perso/00/67/hijikata_toshiro_2876.jpg">
                            <p>Kenny Sang</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                        <div class="feedback-item"> 
                            <img class="rounded-circle" src="https://i1.sndcdn.com/avatars-000396329622-7evlwa-t500x500.jpg">
                            <p>Minh Béo</p>
                            <h6>Dog Lover</h6>
                            <div>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
            
        </div>
        <!--Phần liên hệ-->
        <div class="item contact">Liên hệ
        </div>

    </div>

    <!--Footer-->
    <div class='footer' style='width:100%;'>
        <div id='petty-logo'></div>
        <div class='information'>
            <p><i id='mobile'></i>000-000-000</p>
            <p><i id='email'></i>Email: nnchi@gmail.com</p>
            <p><i id='address'></i>144, Xuan Thuy, Cau Giay, Ha Noi</p>
        </div>
        <div class='media'>
            <p class='media-text'>Follow Us</p>
            <i id='facebook'></i>
        </div>
    </div>
    </div>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='Front-end/JS/owl.carousel.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='Front-end/main.js'></script>
</body>
</html>