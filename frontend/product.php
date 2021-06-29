<?php
session_start();
require_once('../database/dbhelper.php');
$ProductId = '';
if (isset($_GET['ProductId'])) {
    $ProductId      = $_GET['ProductId'];
    $sql     = 'select * from products where ProductId = ' . $ProductId;
    $products = executeSingleResult($sql);
    if ($products != null) {
        $ProductName = $products['ProductName'];
        $Price       = $products['Price'];
        $thumbnail   = $products['thumbnail'];
        $CategoryId  = $products['CategoryId'];
        $Unit        = $products['Unit'];
        $SIZE        = $products['SIZE'];
        $Brand       = $products['Brand'];
        $Quantity    = $products['Quantity'];
        $TotalSellQuantity     = $products['TotalSellQuantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $ProductName ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/sneakers-2/100/17-512.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="header__navbar">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item header__navbar-item--has-qr  header__navbar-item--separate">
                            <a href="index.php" class="header__navbar-item header__navbar-item--has-qr">Trang chủ</a>
                            <div class="header__qr">
                                <img src="./assets/img/QR_code.png" alt="QR code" class="header__qr-img">
                                <div class="header__qr-apps">
                                    <a href="" class="header__qr-link">
                                        <img src="./assets/img/GooglePlay.png" alt="GooglePlay" class="header__qr-download-img">
                                    </a>
                                    <a href="" class="header__qr-link">
                                        <img src="./assets/img/AppStory.png" alt="AppStory" class="header__qr-download-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nối</span>
                            <a href="https://www.facebook.com/namnguyen30" class="header__navbar-icon-link" target="_blank">
                                <i class="header__navbar-icon fab fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/n_nguyen305/" class="header__navbar-icon-link" target="_blank">
                                <i class="header__navbar-icon fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-bell"></i>
                                Thông báo</a>
                        </li>
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon fas fa-question-circle"></i>
                                Trợ giúp</a>
                        </li>
                        <?php
                        if (isset($_SESSION['login'])) {
                            $userName = $_SESSION['login'];

                            echo "<li class='header__navbar-item nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' color: #fff>
                                                $userName
                                            </a>
                                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <a class='dropdown-item' href='#'>Thông tin tài khoản</a>
                                                <a class='dropdown-item' href='../admin/index.php'>Admin</a>
                                                <a class='dropdown-item' href='../logout.php'>Đăng xuất</a>
                                            </div>
                                        </li>";
                        } elseif (isset($_SESSION['login1'])) {
                            $userName = $_SESSION['login1'];

                            echo "<li class='header__navbar-item nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' color: #fff>
                                                $userName
                                            </a>
                                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                                <a class='dropdown-item' href='#'>Thông tin tài khoản</a>
                                                <a class='dropdown-item' href='../logout.php'>Đăng xuất</a>
                                            </div>
                                        </li>";
                        } else {
                            echo '<li class="header__navbar-item">
                                        <a href="../register.php" class="header__navbar-item-link">
                                         <li class="header__navbar-item header__navbar-item--bold header__navbar-item--separate">Đăng ký</li>
                                        </a>
                                        <a href="../login.php" class="header__navbar-item-link">
                                        <li  class="header__navbar-item header__navbar-item--bold">Đăng nhập</li>
                                        </a>
                                    </li>';
                        }
                        ?>
                    </ul>
                </nav>

                <!--Header with search-->
                <div class="header-with-search">
                    <div class="header__logo">
                    </div>

                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                            <!-- Search history -->
                            <div class="header__search-history">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list">
                                    <li class="header__search-history-item">
                                        <a href="">Giày nike</a>
                                    </li>
                                    <li class="header__search-history-item">
                                        <a href="">Giày adidas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <button class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                    </div>
                    <!-- Cart layout -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <i class="header__cart-icon fas fa-shopping-cart"></i>
                            <!-- <span class="header__cart-notice">0</span> -->
                            <!-- No cart : header__cart-list--no-cart -->
                            <div class="header__cart-list">
                                <img src="https://www.braithwaitedesign.com/assets/empty-cart.png" alt="" class="header__cart-no-cart-img">
                                <span class="header__cart-list-no-cart-msg">
                                    Chưa có sản phẩm
                                </span>

                                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                <ul class="header__cart-list-item">
                                    <!-- Cart item -->
                                </ul>
                                <!-- <img src="https://www.braithwaitedesign.com/assets/empty-cart.png" alt="" class="header__cart-no-cart-img"> -->
                                <a href="#" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="policy">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="item" >
                                <div class="breadcrumb">
                                    <ul class="breadcrumb-list">
                                        <li class="breadcrumb-item">
                                            <a href="index.php" class="breadcrumb-item_link">Trang chủ</a>
                                        </li>
                                        <!-- <li class="breadcrumb-item">
                                            <a href="#" class="breadcrumb-item-link">CagetoryName</a>
                                        </li> -->
                                        <li class="breadcrumb-item">
                                            <span class="breadcrumb-item_span"><?=$ProductName?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="intro">
                    <div class="row row-align">
                        <div class="col-lg-6">
                            <img src="<?= $thumbnail ?>" alt="" width="100%">
                        </div>
                        <div class="col-lg-6">
                            <h1>
                                <span><?= $ProductName ?></span>
                            </h1>
                            <p>
                                <span class="price">
                                    <?php echo number_format($Price) . 'đ/ ' . $Unit ?>
                                </span>
                            </p>
                            <ul>
                                <li class="elementor-icon-list-item">
                                    <span class="elementor-icon-list-icon">
                                        <i aria-hidden="true" class="fas fa-check">
                                        </i>
                                    </span>
                                    <span class="elementor-icon-list-text">
                                        Đổi trả hàng dễ dàng nếu size không vừa hoặc giao hàng không đúng.
                                    </span>

                                </li>
                                <li class="elementor-icon-list-item">
                                    <span class="elementor-icon-list-icon">
                                        <i aria-hidden="true" class="fas fa-check">
                                        </i>
                                    </span>
                                    <span class="elementor-icon-list-text">
                                        Giao hàng và thu tiền tận nơi. Khu vực HN có thể giao nhanh trong 2H.
                                    </span>

                                </li>
                                <li class="elementor-icon-list-item">
                                    <span class="elementor-icon-list-icon">
                                        <i aria-hidden="true" class="fas fa-check">
                                        </i>
                                    </span>
                                    <span class="elementor-icon-list-text">
                                        Sản phẩm có sẵn tại cửa hàng. Số lượng giới hạn và có thể hết hàng mà không thông báo trước.
                                    </span>
                                </li>
                            </ul>

                            <table class="variation" cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td class="label">
                                            <label for="pa_size-giay">
                                                Size giày :
                                            </label>
                                        </td>
                                        <td class="value ">
                                            <select name="attribute_pa_size-giay" id="pa_size-giay" data-show_option_none="yes">
                                                <option value="">Chọn một tùy chọn</option>
                                                <option value="<?= $SIZE ?>"><?= $SIZE ?></option>
                                                <option value="<?= $SIZE ?>"><?= $SIZE ?></option>
                                                <option value="<?= $SIZE ?>"><?= $SIZE ?></option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="add-to-cart">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" id="quantity_5ff1c0deeb4d0" class="input-text qty text" step="1" min="1" max="11" name="quantity" value="1" title="SL" size="4" placeholder="" inputmode="numeric">
                                    <input type="button" value="+" class="plus">
                                </div>
                                <button type="submit" class="single_add_to_cart_button button alt disabled wc-variation-selection-needed">Đặt hàng ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="grid">
                <div class="grid__row">
                    <div class="grid__column-0-4">
                        <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Mail</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Hướng dẫn mua hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-1-4">
                        <h3 class="footer__heading">Giới thiệu</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giới thiệu</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Tuyển dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-2-4">
                        <h3 class="footer__heading">Danh mục</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giày thể thao</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giày da</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giày trẻ em</a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-3-4">
                        <h3 class="footer__heading">Theo dõi</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-facebook"></i>
                                    Facebook
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-instagram"></i>
                                    Instagram
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-linkedin"></i>
                                    Linkedin
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="grid__column-4-4">
                        <h3 class="footer__heading">Vào cửa hàng trên ứng dụng</h3>
                        <div class="footer__download">
                            <img src="./assets/img/QR_code.png" alt="Download QR" class="footer__download-qr">
                            <div class="footer__download-apps">
                                <a href="" class="footer__download-app-link">
                                    <img src="./assets/img/GooglePlay.png" alt="Google Play" class="footer__download-app-img" style="height:28px;">
                                </a>
                                <a href="" class="footer__download-app-link">
                                    <img src="./assets/img/AppStory.png" alt="App store" class="footer__download-app-img" style="height:30px;">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="footer__bottom">
                    <div class="grid__row">
                        <p class="footer__text">2019 - Bản quyền thuộc về công ty tại gia</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>