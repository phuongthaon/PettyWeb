<?php
    session_start();
    require_once "config.php";
    $name = $productLine = $n_price = $price = $image = $producer = $description = '';
    $star = 0;
    $star_1 = 0;
    $star_2 = 0;
    $star_3 = 0;
    $star_4 = 0;
    $star_5 = 0;
    $count_review = 0;
    if(!isset($_SESSION['cart']) || !isset($_SESSION['number']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['number'] = array();
        $_SESSION['price'] = array();
    }

    if(isset($_GET['id']) && $_GET['id'] != '')
    {
        $query_string = "SELECT COUNT(*) as c FROM productreview WHERE productCode =".$_GET['id'];
        $query = mysqli_query($link, $query_string);
        if($row = mysqli_fetch_assoc($query))
        {
            $count_review = $row['c'];
        }
        $query_string = "SELECT *,FORMAT(price, 0) as f_price FROM products WHERE productCode =".$_GET['id'];
        $query = mysqli_query($link, $query_string);
        if(mysqli_num_rows($query) > 0)
        {
            $row = mysqli_fetch_assoc($query);
            $name = $row['productName'];
            $productLine = $row['productLine'];
            $image = $row['image'];
            $n_price = $row['price'];
            $price = $row['f_price']."đ";
            $producer = $row['producer'];
            $description = $row['productDescription'];
        }
        $sql = "SELECT FORMAT(AVG(`stars`), 0) as avg FROM `productreview` WHERE `productCode` = ".$_GET['id']." ORDER BY `productCode`";
        $query = mysqli_query($link, $sql);
        if($row = mysqli_fetch_assoc($query))
        {
            $star = $row['avg'];
            $sql = "SELECT FORMAT(100*COUNT(*)/(SELECT COUNT(*) FROM productreview WHERE productCode = ".$_GET['id']."), 0) as rate FROM productreview WHERE productCode = ".$_GET['id']." AND stars = 1";
            $query = mysqli_query($link, $sql);
            if($row_t = mysqli_fetch_assoc($query))
            {
                $star_1 = $row_t['rate'];
            }
            $sql = "SELECT FORMAT(100*COUNT(*)/(SELECT COUNT(*) FROM productreview WHERE productCode = ".$_GET['id']."), 0) as rate FROM productreview WHERE productCode = ".$_GET['id']." AND stars = 2";
            $query = mysqli_query($link, $sql);
            if($row_t = mysqli_fetch_assoc($query)){
                $star_2 = $row_t['rate'];
            }
            $sql = "SELECT FORMAT(100*COUNT(*)/(SELECT COUNT(*) FROM productreview WHERE productCode = ".$_GET['id']."), 0) as rate FROM productreview WHERE productCode = ".$_GET['id']." AND stars = 3";
            $query = mysqli_query($link, $sql);
            if($row_t = mysqli_fetch_assoc($query))
            {
                $star_3 = $row_t['rate'];
            }
            $sql = "SELECT FORMAT(100*COUNT(*)/(SELECT COUNT(*) FROM productreview WHERE productCode = ".$_GET['id']."), 0) as rate FROM productreview WHERE productCode = ".$_GET['id']." AND stars = 4";
            $query = mysqli_query($link, $sql);
            if($row_t = mysqli_fetch_assoc($query))
            {
                $star_4 = $row_t['rate'];
            }
            $sql = "SELECT FORMAT(100*COUNT(*)/(SELECT COUNT(*) FROM productreview WHERE productCode = ".$_GET['id']."), 0) as rate FROM productreview WHERE productCode = ".$_GET['id']." AND stars = 5";
            $query = mysqli_query($link, $sql);
            if($row_t = mysqli_fetch_assoc($query))
            {
                $star_5 = $row_t['rate'];
            }
        }
    }
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
    <div class="container-fluid">
        <div class='container' id='petty-header' style='width: 100%; height: 100%;'>
            <a class='logo' href='../index.php'></a>
            <form class='search' action='search.php' method='GET'>
                <input class='txtSearch' name='key' type='text' placeholder='Tìm kiếm'>
                <button type='submit' id='btnSearch' onclick='window.location.href = "search.php";'><i id='search-icon'></i></button>
            </form>
            <span><i class='fas fa-bell' style='color: white; position: absolute; right: 350px; font-size: 20px; top: 19px;'></i></span>
            <div class='user mt-2 ml-4'>
                <span><i class='fas fa-user-alt' style='color: #ef5030; font-size: 20px;'></i></span>
                <a href='login.php' style='color: #fff;'>
                <?php
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                {
                    echo $_SESSION["username"];
                }
                else
                {
                    echo "Đăng ký/đăng nhập";
                }
                ?>
                </a>
            </div>
            <a href="cart.php">
                <div class="cart">
                    <i></i>
                    <span>Giỏ hàng</span>
                    <div class="product-count"><?php 
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && sizeOf($_SESSION['cart']) > 0)
                    echo sizeOf($_SESSION['cart']);?></div>
                </div>
            </a>
        </div>
        <div class="container" style="position: relative;">
            <div class="toast" data-autohide="false" style="position: absolute; right: 0px;">
                <div class="toast-header">
                    <span class="fas fa-check-circle mr-2 text-success"></span>
                    <strong class="mr-auto text-success">Thêm vào giỏ hàng thành công!</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                </div>
                <div class="toast-body" style="text-align: center;">
                    <a href="cart.php"><button>Xem giỏ hàng và thanh toán</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--Menu-->
    <?php
        include "menu.php";
    ?>
    <!--Content-->
    <div class="product-detail-page content container" style="min-height: 300px;">
        <h3 class="title-catalog">Danh mục</h3>
        <div class="view-product">
            <div class="product-image">
                <img src="<?php echo $image?>">
            </div>
            <div class="product-detail">
                <div class="product-name">
                    <h3><?php echo $name?></h3>
                </div>
                <div class="product-status">
                    <!-- rating -->
                    <div class="rating">
                        <span class="level"><?=$star?></span>
                        <span class="label">
                            <?php
                                for ($i=0; $i < 5; $i++) { 
                                    if($i < $star)
                                    {
                                        echo "<i class='fas fa-star'></i>";
                                    }
                                    else
                                    {
                                        echo "<i class='fas fa-star' style='color:black;'></i>";
                                    }
                                }
                            ?>
                        </span>
                    </div>
                    <div class="number-of-rating"><a href="#demo"><?=$count_review?><span>đánh giá</span></a></div>
                </div>
                <div class="product-price">
                    <h2><?php echo $price;?></h2>
                </div>
                <div class="product-description">
                    <p>
                        <span style="font-family: 'My Font Paragraph Bold';">Thương hiệu: </span>
                        <span><?php echo $producer;?></span>
                    </p>    
                    <p>
                        <?php echo $description;?>
                    </p>
                </div>
                <!-- change quantity button -->
                <div class="product-quantity">
                    <div class="input-group quantity-block">
                        <span class="left" style="border: 1px solid #ccc; border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                            <button type="button" id="minus-quantity" class="btn">
                                <i class="fas fa-minus">
                                </i>
                            </button>
                        </span>
                        <input type="number" id="quantity" class="input-number" name="quantity"  min="1" max="100" value="1" oninput="validity.valid||(value=0);" style="text-align: center; width: 50px;">
                        <span class="right" style="border: 1px solid #ccc; border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                            <button type="button" id="plus-quantity" class="btn">
                                <i class="fas fa-plus">
                                </i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="add-cart" style="margin-top: 20px;">
                    <button type="button" id="addcart">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Chọn mua</span>
                    </button>
                    <span class="add-wishlist">
                        <i class="far fa-heart"></i>
                    </span>
                </div>
            </div>
       </div>
       <div class="detailed-description">
            <h3 class="title">Mô tả sản phẩm</h3>
            <div class="text">
                <?php
                    echo $description;
                ?>
            </div>
       </div>
       <!--Phần review của khách hàng-->
       <div class="customer-review">
            <h3 class="title">Nhận xét của khách hàng</h3>
            <div class="rating-overview row shadow">
                <div class="rating-average col-3" style="padding: 30px;">
                    <p>Đánh giá trung bình</p>
                    <h1 style="color: #ef5030;"><?=$star?>/5</h1>
                    <span class="label">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                </div>
                <div class="rating-percentage col-5">
                    <div class="rate-item rate-5">
                        <div class="rating-num" style="margin-right: 5px;">5<i class="fas fa-star"></i></div>
                        <div class="progress" style="width: 300px;">
                            <div class="progress-bar" style="width:<?php if($star_5 > 10) echo $star_5; else echo "15";?>%"><?=$star_5?>%</div>
                        </div>
                    </div>
                    <div class="rate-item rate-4">
                        <div class="rating-num" style="margin-right: 5px;">4<i class="fas fa-star"></i></div>
                        <div class="progress" style="width: 300px;">
                            <div class="progress-bar" style="width:<?php if($star_4 > 10) echo $star_4; else echo "15";?>%"><?=$star_4?>%</div>
                        </div>
                    </div>
                    <div class="rate-item rate-3">
                        <div class="rating-num" style="margin-right: 5px;">3<i class="fas fa-star"></i></div>
                        <div class="progress" style="width: 300px;">
                            <div class="progress-bar" style="width:<?php if($star_3 > 10) echo $star_3; else echo "15";?>%"><?=$star_3?>%</div>
                        </div>
                    </div>
                    <div class="rate-item rate-5">
                        <div class="rating-num" style="margin-right: 5px;">2<i class="fas fa-star"></i></div>
                        <div class="progress" style="width: 300px;">
                            <div class="progress-bar" style="width:<?php if($star_2 > 10) echo $star_2; else echo "15";?>%"><?=$star_2?>%</div>
                        </div>
                    </div>
                    <div class="rate-item rate-5">
                        <div class="rating-num" style="margin-right: 5px;">1<i class="fas fa-star"></i></div>
                        <div class="progress" style="width: 300px;">
                            <div class="progress-bar" style="width:<?php if($star_1 > 10) echo $star_1; else echo "15";?>%"><?=$star_1?>%</div>
                        </div>
                    </div>

                </div>
                <div class="sharing-comment col">
                    <p>Chia sẻ nhận xét của bạn</p>
                    <!--Button để mở modal nhận xét-->
                    <button data-toggle="modal" data-target="#comment-modal">Viết nhận xét của bạn</button>
                </div>
            </div>
            <div class="product-review-box" style="padding: 20px;">
                <div class="review-filter">
                    <form>
                        <label for="filter" class="mr-3 ml-5">Chọn xem nhận xét</label>
                        <select id="filter" style="width: 200px; height: 30px; border-radius: 5px;">
                            <option value="all">Tất cả</option>
                            <option value="5sao">5 sao</option>
                            <option value="4sao">4 sao</option>
                            <option value="3sao">3 sao</option>
                            <option value="2sao">2 sao</option>
                            <option value="1sao">1 sao</option>
                        </select>
                    </form>
                </div>
                <?php
                    $sql = 'SELECT * FROM productreview WHERE productCode = '.$_GET['id'];
                    $query = mysqli_query($link, $sql);
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $sql = 'SELECT * FROM users WHERE ID = '.$row['customerID'];
                        $query_t = mysqli_query($link, $sql);
                        if($row_t = mysqli_fetch_assoc($query_t))
                        {
                            echo "<div class='item-review row' style='padding: 20px;'>
                            <div class='col-2' style='text-align: center;'>
                                <img src='https://cdn4.iconfinder.com/data/icons/interface-14/256/interface_user-512.png' class='rounded-circle' style='width: 80px;'>
                                    <div class='customer-name'>".$row_t['username']."</div>
                                    <div class='posted-time'>2 tháng trước</div>
                            </div>
                            <div class='col review-description'>
                                <div>
                                    <span class='label'>";
                            for($i=0; $i<5; ++$i)
                            {
                                if($i < $row['stars'])
                                {
                                    echo "<i class='fas fa-star'></i>";
                                }
                                else
                                {
                                    echo "<i class='fas fa-star' style='color:black'></i>";
                                }
                            }
                            echo " 
                                    </span>
                                    <span class='ml-2'>".$row['subtitle']."</span>
                                </div>
                                <div style='color: #ccc;'><i>Đã mua sản phẩm</i></div>
                                <div>".
                                    $row['comments']   
                                ."</div>
                            </div>
                            </div>";
                        } 
                    }
                ?>
            </div>
        </div>
        <!--Đây là modal cho comment-->
        <div class="modal fade" id="comment-modal">
            <div class="modal-dialog">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Viết nhận xét</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                  <form>
                    <label for="star-rating" style="margin-right: 10px;">1.Đánh giá của bạn về sản phẩm này: </label>
                    <span id="star-row">
                        <i id="s1" class="vote-star fas fa-star"></i>
                        <i id="s2" class="vote-star fas fa-star"></i>
                        <i id="s3" class="vote-star fas fa-star"></i>
                        <i id="s4" class="vote-star fas fa-star"></i>
                        <i id="s5" class="vote-star fas fa-star"></i>
                    </span>
                    <br>
                    <label for="comment-heading">2.Tiêu đề của nhận xét: </label>
                    <input class="form-control" id='subtitle' type="text" placeholder="Tiêu đề..."></input><br>
                    <label for="comment">3.Viết nhận xét của bạn bên dưới:</label>
                    <textarea class="form-control" rows="5" id="comment" placeholder="Viết nhận xét của bạn ở đây..."></textarea>
                  </form>
                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn" id='submit-comment' data-dismiss="modal" style="background-color: #f19f1f; color: #fff;">Gửi nhận xét</button>
                </div>
          
              </div>
            </div>
        </div>
        <!--Hết phần review của khách hàng-->
        <!--Phần sản phẩm liên quan-->
        <!--Chỗ này cho hiện 4 sản phẩm liên quan nhất thôi, nhiều hơn thì bấm xem thêm-->
        <div class="related-products" style="position: relative;">
            <h3 class="title related-title m-4">Sản phẩm liên quan</h3>
            <div class="row">
                <?php
                $sql = "SELECT *, FORMAT(price, 0) as f_price FROM products WHERE productLine = '".$productLine."' AND producer ='".$producer."' AND productCode <> ".$_GET['id']." LIMIT 4";
                $query_relate = mysqli_query($link, $sql);
                while($row_relate = mysqli_fetch_assoc($query_relate))
                {
                    echo "
                    <div class='col-md-3 col-sm-6'>
                    <div class='product-grid'>
                        <div class='product-image'>
                            <a href='product-detail.php?id=".$row_relate['productCode']."' class='image'>
                                <img class='pic-1' src='".$row_relate['image']."'>
                                <img class='pic-2' src='".$row_relate['image']."'>
                            </a>
                        </div>
                        <div class='product-content'>
                            <ul class='rating'>
                                <li class='fa fa-star'></li>
                                <li class='fa fa-star'></li>
                                <li class='fa fa-star'></li>
                                <li class='fa fa-star disable'></li>
                                <li class='fa fa-star disable'></li>
                            </ul>
                            <h3 class='title'><a href='product-detail.php?id=".$row_relate['productCode']."'>".$row_relate['productName']."</a></h3>
                            <div class='price'>".$row_relate['f_price']."đ</div>
                            <ul class='social'>
                                <li><a href='#'><i class='fa fa-shopping-cart'></i></a></li>
                                <li><a href='#'><i class='fa fa-heart'></i></a></li>
                                <li><a href='#'><i class='fa fa-eye'></i></a></li>
                                <li><a href='#'><i class='fa fa-random'></i></a></li>
                            </ul>
                        </div>
                    </div>  
                    </div>
                    ";
                }
                ?>
            </div>
            <!--Chỗ hiện mặt hàng-->
            <form class="more"><button type="button">Xem thêm</button></form>
       </div> 
    </div>

    <!--Footer-->
    <?php
        include "footer.php";
    ?>
    <script>
        $(document).ready(function(){
            var starNumber = 0;
            $(".vote-star").click(function(){
                var n = parseInt(this.getAttribute("id").substring(1, 2));
                starNumber = n;
                for (var i = 1; i <= 5; ++i) {
                    if(i <= n)
                    {
                        $('#s'+i).css("color", "#FFC400");
                    }
                    else
                    {
                        $('#s'+i).css("color", "black");
                    }
                }
            });
            $('#submit-comment').click(function(){
                if(<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) echo"true"; else echo "false";?>)
                {
                    var subtitle = document.getElementById('subtitle').value;
                    var comment = document.getElementById('comment').value;
                    var userID = <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) echo $_SESSION['id']; else echo 0;?>;
                    var productCode = <?=$_GET['id']?>;
                    if(starNumber != 0 && subtitle != '' && comment != '')
                    {
                        $.ajax({
                            url:'addComment.php',
                            method:'POST',
                            data:{userID:userID, productCode:productCode, subtitle:subtitle, comment:comment, starNumber:starNumber},
                            success:function(data)
                            {
                            }
                        })  
                    }
                }
            });
            $('#addcart').click(function(){
                var check = <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) echo"true"; else echo "false";?>;
                if(check == true)
                {
                    $('.toast').toast('show');
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                    var number = document.getElementById("quantity").value;
                    var id = <?php echo $_GET['id'];?>;
                    var price = <?php echo $n_price;?>;
                    $.ajax({
                        url:"addToCart.php",
                        method:"POST",
                        data: {number: number, id: id, price:price},
                        success: function(data)
                        {
                            $('.product-count').html(data);
                        }
                    });
                }
            }); 
            $('#minus-quantity').click(function(){
                if(parseInt(document.getElementById("quantity").value) > 1)
                {
                    var i = parseInt(document.getElementById("quantity").value) - 1;
                    document.getElementById("quantity").value = i;
                }
            });
            $('#plus-quantity').click(function(){
                var i = parseInt(document.getElementById("quantity").value) + 1;
                document.getElementById("quantity").value = i;
            });
        });
    </script>
</body>
</html>