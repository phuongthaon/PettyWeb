<?php
    echo "<div class='catalog'>
        <div class='item-catalog home'><a style='text-decoration: none;color: #ffff' href='../index.php'>Trang chủ</a></div>
        <div class='item-catalog about-petty'><a style='text-decoration: none;color: #ffff' href='about.php'>Giới thiệu</a></div>
        <div class='item-catalog online-shopping'>Mua hàng online</div>
        <div class='item-catalog dropdown service'>
            <div type='button' class='btn dropdown-toggle' data-toggle='dropdown' style='color: #fff;'>
                Dịch vụ
            </div>
            <div class='dropdown-menu'>";
                $sql = "SELECT * FROM serviceline WHERE 1 ORDER BY `order`";
                $query = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<a class='dropdown-item' href='serviceline.php?id=".$row['ID']."'>".$row['serviceLine']."</a>";
                }
    echo "
            </div>   
        </div>
        <div class='item-catalog'><a style='text-decoration: none;color: #ffff' href='contact.php'>Liên hệ</a></div>
        <div class='item-catalog'>Blog</div>
    </div>";
?>