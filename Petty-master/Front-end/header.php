<?php
	echo "<!--Header-->
    <div class='container-fluid'>
        <div class='container' id='petty-header' style='width: 100%; height: 100%;'>
            <a class='logo' href='../index.php'></a>
            <form class='search' action='search.php' method='GET'>
                <input class='txtSearch' name='key' type='text' placeholder='Tìm kiếm'>
                <button type='submit' id='btnSearch' onclick='window.location.href = 'search.php';'><i id='search-icon'></i></button>
            </form>
            <span><i class='fas fa-bell' style='color: white; position: absolute; right: 350px; font-size: 20px; top: 19px;'></i></span>
            <div class='user mt-2 ml-4'>
                <span><i class='fas fa-user-alt' style='color: #ef5030; font-size: 20px;'></i></span>
                <a href='login.php' style='color: #fff;'>";
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
            <a href='cart.php'>
                <div class='cart'>
                    <i></i>
                    <span>Giỏ hàng</span>
                    <div class='product-count'>";
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && sizeOf($_SESSION['cart']) > 0)
                    {
                        echo sizeOf($_SESSION['cart']);
                    }
    echo "
                </div>
                </div>
            </a>
        </div>
    </div>";  

    // <div class="container-fluid">
    //     <div class="container" id="petty-header" style="width: 100%; height: 100%;">
    //         <div class="logo"></div>
    //         <form class="search" action="search.php" method="GET">
    //             <input class="txtSearch" type="text" placeholder="Tìm kiếm">
    //             <button type="submit" id="btnSearch" onclick="window.location.href = 'search.php';"><i id="search-icon"></i></button>
    //         </form>
    //         <span><i class="fas fa-bell" style="color: white; position: absolute; right: 334px; font-size: 20px; top: 19px;"></i></span>
    //         <div class="user">
    //             <span style="color: white; margin-right: 10px;">ecchi123</span>
    //             <img class="rounded-circle" src="https://static.wikia.nocookie.net/a3dddab1-5138-4786-ad66-03920667dc3a" style="width: 45px; height: auto; border: 1px solid #ef5030;">
    //             <i class="fas fa-caret-down"></i>
    //         </div>
    //         <div class="cart">
    //             <i></i>
    //             <span>Giỏ hàng</span>
    //         </div>
    //     </div>
    // </div>    
?>