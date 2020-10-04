<?php
    session_start();
    require_once "config.php";
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");

        
        exit;
    }
    if(!isset($_SESSION['cart']) || !isset($_SESSION['number']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['number'] = array();
        $_SESSION['price'] = array();
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
    <?php
        include "header.php";
    ?>
    <!--Menu-->
    <?php
        include "menu.php";
    ?>
    <!--Content-->
    <div class="content" style="min-height: 300px;">
        <div class="title-image-cart" style="position: relative;">
            <p>Giỏ hàng của tôi</p>
        </div>
        <div class="home-cart" style="padding: 20px;">
            <div class="detail-cart">Giỏ hàng</div>
            <div class="productInCart">
                <div class="row heading">
                    <div class="col-7 product-name-title">Sản phẩm</div> 
                    <div class="col product-price-title">Giá</div>
                    <div class="col product-quantity-title">Số lượng</div>
                    <div class="col-1 product-subtotal-title">Tạm tính</div>
                </div>
            <?php
                $id_array = array();
                $number_array = array();
                $price_array = array();
                for($i = 0; $i < sizeof($_SESSION['cart']); ++$i)
                {
                    if($_SESSION['number'][$i] != 0)
                    {
                        for($j = $i + 1; $j < sizeof($_SESSION['cart']); ++$j)
                        {
                            if($_SESSION['cart'][$i] == $_SESSION['cart'][$j])
                            {
                                $_SESSION['number'][$i] += $_SESSION['number'][$j];
                                $_SESSION['number'][$j] = 0;
                                $_SESSION['price'][$j] = 0;
                            }
                        }
                    }
                }
                for($i = 0; $i < sizeof($_SESSION['cart']); ++$i)
                {
                    if($_SESSION['number'][$i] != 0)
                    {
                        $id_array[] = $_SESSION['cart'][$i];
                        $number_array[] = $_SESSION['number'][$i];
                        $price_array[] = $_SESSION['price'][$i];
                    }
                }

                $_SESSION['cart'] = $id_array;
                $_SESSION['number'] = $number_array;
                $_SESSION['price'] = $price_array;
                $total = 0;
                for($i = 0; $i < sizeof($id_array); ++$i)
                {
                    $sql = "SELECT *, FORMAT(price, 0) as f_price FROM products WHERE productCode=".$id_array[$i];
                    $query = mysqli_query($link, $sql);
                    if($row = mysqli_fetch_assoc($query))
                    {
                        $total+= $number_array[$i]*$row['price'];
                        echo "<div class='row' id='row-".$id_array[$i]."'>
                    <div class='col-1 product-image'>
                        <i name='delete".$id_array[$i]."' class='far fa-times-circle delete'></i>
                        <a href='product-detail.php?id=".$row['productCode']."'><img style='width: 100px; height: 100px;' src='".$row['image']."'></a>
                    </div>
                    <div class='col-6 product-name'>
                        <a href='product-detail.php?id=".$row['productCode']."'>".$row['productName']."</a><br>
                        <div class='btn btn-link shop-next-time'>Mua sau</div>
                    </div>
                    <div class='col product-price'>".$row['f_price']."</div>
                    <div class='col product-quantity'>
                        <div class='input-group quantity-block'>
                            <span class='input-group-btn left'>
                                <button type='button' name='minus-".$id_array[$i]."' class='btn changeQuantity'>
                                    <i class='fas fa-minus'>
                                    </i>
                                </button>
                            </span>
                            <input type='number' name='value-".$id_array[$i]."' class='form-control input-number' value='".$number_array[$i]."' min='1' oninput='validity.valid||(value=1);' max='100' style='text-align: center;'>
                            <span class='input-group-btn right'>
                                <button type='button' name='plus-".$id_array[$i]."' class='btn changeQuantity'>
                                    <i class='fas fa-plus'>
                                    </i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div id='total-".$id_array[$i]."'  class='col-1 product-subtotal'>".(number_format($number_array[$i]*$row['price']))."</div>
                </div>";
                    }
                }

            ?>
            <i></i>
            <div class="checkout-card row">
                <div class="col-5" style="padding: 10px;" role="form">
                    <label>Mã giảm giá</label>
                    <input type="text" class="coupon-code">
                    <button type="submit" class="accept-coupon">Đồng ý</button>
                </div>
                <div class="col"></div>
                <div class="col-1">
                    Thành tiền:
                </div>
                <div class="col">
                    <h2 class="submoney" id='totalPrice' style="color: #ef5030;"><?php echo number_format($total)?></h2>
                </div>
                <div class="col">
                    <button style="width: 170px; padding: 12px; background-color: #ef5030; border: none; border-radius: 5px; color: #fff;" onclick='window.location.href = "checkout.php" '>Mua hàng</button>
                </div>
                
            </div>
            <button class="continue-shop" onclick='window.location.href = "../index.php" '><i class="fas fa-long-arrow-alt-left"></i>Tiếp tục xem hàng</button>
        </div>
    </div>
    <div id='test'></div>
    <!--Footer-->
    <?php
        include "footer.php";
    ?>
    <script>
        $(document).ready(function(){
            $('.changeQuantity').click(function(){
                var name = this.getAttribute("name");
                if(name.substring(0, 1) == 'm')
                {
                    var id = name.substring(6, name.length);
                    var i = parseInt(document.getElementsByName("value-"+ id)[0].value);
                    if(i > 1)
                    {
                        document.getElementsByName("value-"+ id)[0].value = --i;
                        $.ajax({
                            url:"changeQuantity.php",
                            method:"GET",
                            data: {number: i, id: id},
                            success: function(data)
                            {
                                var ar = data.split(" ");
                                $('#total-'+id).html(ar[0]);
                                $('#totalPrice').html(ar[1]);
                            }
                        });
                    }
                }
                else
                {
                    var id = name.substring(5, name.length);
                    var i = parseInt(document.getElementsByName("value-"+ id)[0].value);
                    document.getElementsByName("value-"+ id)[0].value = ++i;
                    $.ajax({
                        url:"changeQuantity.php",
                        method:"GET",
                        data: {number: i, id: id},
                        success: function(data)
                        {
                            var ar = data.split(" ");
                            $('#total-'+id).html(ar[0]);
                            $('#totalPrice').html(ar[1]);
                        }
                    });
                }  
            });
            $('.delete').click(function(){
                var id = this.getAttribute("name");
                id= id.substring(6, id.length);
                var row = document.getElementById('row-'+id);
                row.remove();
                $.ajax({
                        url:"changeQuantity.php",
                        method:"GET",
                        data: {number: 0, id: id},
                        success: function(data)
                        {
                            $('#totalPrice').html(data);
                        }
                    });
            });
        });
    </script>
</body>
</html>