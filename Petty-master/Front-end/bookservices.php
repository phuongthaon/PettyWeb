<?php
    session_start();
    include "config.php";

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
    $subtotal = 0;
    $name = 'Họ và tên';
    $phonenumber = 'Số điện thoại';
    $address = 'Địa chỉ';
    for ($i=0; $i < sizeof($_SESSION['price']); $i++) { 
        $subtotal+=$_SESSION['price'][$i]*$_SESSION['number'][$i];
    }
    $sql = 'SELECT *, (SELECT phoneNumber FROM users u WHERE u.ID = ud.ID) as phoneNumber  
            FROM userdetail ud WHERE ud.ID = '.$_SESSION['id'];
    $query = mysqli_query($link, $sql);
    if($row = mysqli_fetch_assoc($query))
    {
        $name = $row['customerName'];
        $phonenumber = $row['phoneNumber'];
        $address = $row['address'];
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $sql = "INSERT INTO orderservices(serviceID, customerID, orderDate, requiredDate) VALUES (?,?,NOW(),?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_serviceID, $param_customerID, $param_requiredDate);
                    
            // Set parameters
            $param_serviceID = $_GET['id'];
            $param_customerID = $_SESSION['id'];
            $param_requiredDate = $_POST['date'];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: afterbook.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
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
    <link rel="stylesheet" href="../Front-end/asset/css/checkout.css">
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
    
    <div class="my-5">
        <div class="row justify-content-center ">
            <div class="col-xl-10">
                <div class="card shadow-lg ">
                    <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                        <div class="col">
                            <p class="text-muted space mb-0 shop"> Shop Petty</p>
                        </div>
                        <div class="col">
                            <div class="row justify-content-center text-center">
                                <div class="col"> <img class="irc_mi img-fluid cursor-pointer " src="../Front-end/asset/resource/icon/logo.png" width="100" height="100" style="margin: 0 auto;"> </div>
                            </div>
                        </div>
                        <div class="col"> <img class="irc_mi img-fluid bell" src="" width="30" height="30"> </div>
                    </div>
                    <div class="row mx-auto justify-content-center text-center">
                        <div class="col-12 mt-3 ">
                            <nav aria-label="breadcrumb" class="second ">
                                <ol class="breadcrumb indigo lighten-6 first ">
                                    <li class="breadcrumb-item font-weight-bold "><a class="black-text text-uppercase " href="../index.php"><span class="mr-md-3 mr-1">Trang chủ</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                    <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase active-2" href="bookservices.php"><span class="mr-md-3 mr-1">Đặt dịch vụ</span></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div class="col-md-5">
                            <div class="card border-0">
                                <div class="card-header checkout-title pb-0">
                                    <h2 class="card-title space ">Đặc lịch</h2>
                                    <p class="card-text text-muted mt-4 space">Thông tin dịch vụ</p>
                                    <hr class="my-0">
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?='bookservices.php?id='.$_GET['id']?>" method="post">
                                    <div class="row justify-content-between">
                                        <div class="information col-auto mt-0">
                                            <div class="form-group"> <label for="NAME" class="small text-muted mb-1">TÊN NGƯỜI ĐẶT</label> <input type="text" class="form-control form-control-sm" name="name" id="NAME" aria-describedby="helpId" value="<?=$name?>" required> </div>
                                        </div>
                                        <div class="information col-auto">
                                            <div class="form-group"> <label for="NAME" class="small text-muted mb-1">SỐ ĐIỆN THOẠI</label> <input type="text" class="form-control form-control-sm" name="phonenumber" id="NAME" aria-describedby="helpId" value="<?=$phonenumber?>" required> </div>
                                        </div>
                                        <div class="information col-auto">
                                            <div class="form-group"> <label for="NAME" class="small text-muted mb-1">NGÀY SỬ DỤNG DỊCH VỤ</label> <input type="datetime-local" class="form-control form-control-sm" name="date" id="NAME" aria-describedby="helpId" value="<?=$address?>" required> </div>
                                        </div>
                                    </div>
                                    <div class="row mb-md-5 mt-4">
                                        <div class="col"> <button type="submit" name="" id="" class="btn btn-lg btn-block ">Xác nhận đặt lịch</button> </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card border-0 ">
                                <div class="card-header card-2">
                                    <p class="card-text text-muted mt-md-4 mb-2 space">Danh mục dịch vụ </p>
                                    <hr class="my-2">
                                </div>
                                <div class="card-body pt-0">
                                        <?php
                                        $total = 0;
                                        if(!empty((trim($_GET['id']))))
                                        {
                                            $sql = 'SELECT * FROM services WHERE serviceID ='.$_GET['id'];
                                            $query = mysqli_query($link, $sql);
                                            if($row = mysqli_fetch_assoc($query))
                                            {
                                                $total = $row['price'];
                                                echo "<div class='row justify-content-between'>
                                                    <div class='col-auto col-md-7'>
                                                        <div class='media flex-column flex-sm-row'> <img class=' img-fluid' src='".$row['serviceImage']."' width='62' height='62'>
                                                            <div class='media-body my-auto'>
                                                                <div class='row '>
                                                                    <div class='col-auto'>
                                                                        <p class='mb-0'><b>".$row['serviceName']."</b></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=' pl-0 flex-sm-col col-auto my-auto '>
                                                        <p><b>".number_format($row['price'])."đ</b></p>
                                                    </div>
                                                </div>
                                                <hr class='my-2'>";
                                            }
                                        }
                                        ?>
                                    <div class="row ">
                                        <div class="col">
                                            <div class="row justify-content-between">
                                                <div class="col-4">
                                                    <p class="mb-1"><b>Tổng giá trị</b></p>
                                                </div>
                                                <div class="flex-sm-col col-auto">
                                                    <p class="mb-1"><b><?=number_format($total)?>đ</b></p>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                        </div>
                                    </div>
                                    <div class="row mb-5 mt-4 ">
                                        <div class="col-md-7 col-lg-6 mx-auto"><button type="button" class="btn btn-block btn-outline-primary btn-lg">ADD GIFT CODE</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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