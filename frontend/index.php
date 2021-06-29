<?php
//include auth.php file on all secure pages
// include("../auth.php");
session_start();
require_once('../database/dbhelper.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" href="https://cdn2.iconfinder.com/data/icons/sneakers-2/100/17-512.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                            <input type="text" id="search-value" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                        </div>
                        <button class="header__search-btn" id="btn-search">
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


    <!-- Block Element Modifier-->
    <div class="header">
        <div class="app__container">
            <div class="grid">
                <div class="grid__row app__content">
                    <div class="grid__column-2">
                        <nav class="category">
                            <h3 class="category__heading">
                                <i class="category__heading-icon fas fa-list"></i>
                                Danh Mục
                            </h3>

                            <ul class="category-list">
                                <?php
                                $cateSql = "select * from categories";
                                $categoryList = executeResult($cateSql);

                                foreach ($categoryList as $item) {
                                    echo ' <li class="category-item category-item--active">
                                                <a href="#" class="category-item__link">' . $item['CategoryName'] . '</a>
                                            </li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>

                    <div class="grid__column-10">
                        <div class="home-filter">
                            <span class="home-filter__label">Sắp xếp theo</span>
                            <button class="home-filter__btn btn">Phổ biến</button>
                            <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                            <button class="home-filter__btn btn">Bán chạy</button>

                            <div class="select-input">
                                <span class="select-input__label">Giá</span>
                                <i class=".select-input__icon fas fa-angle-down"></i>

                                <!-- List options-->
                                <ul class="select-input__list">
                                    <li class="select-input__item">
                                        <a href="" class="select-input__link">Giá: Thấp đến cao</a>
                                    </li>
                                    <li class="select-input__item">
                                        <a href="" class="select-input__link">Giá: Cao đến thấp</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="home-filter__page">
                                <span class="home-filter__page-num">
                                    <span class="home-filter__page-current">1</span>/14
                                </span>

                                <div class="home-filter__page-control">
                                    <a href="" class="home-filter__page-btn home-filter__page-btn--disabled">
                                        <i class="home-filter__page-icon fas fa-angle-left"></i>
                                    </a>
                                    <a href="" class="home-filter__page-btn">
                                        <i class="home-filter__page-icon fas fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="home-product">
                            <div class="grid__row" id="lst-product">
                                <!-- Product item-->

                                <?php
                                $productSql = 'select * from products';
                                $listProduct = executeResult($productSql);

                                foreach ($listProduct as $product) {
                                    echo '<div class="grid__column-2-4">  
                                            <a class="home-product-item" href="product.php?ProductId=' . $product['ProductId'] . '">
                                                <div class="home-product-item__img" style="background-image: url(' . $product['thumbnail'] . ');"></div>
                                                <h4 class="home-product-item__name">' . $product['ProductName'] . '</h4>
                                                <h5 class="home-product-item__name">Size: ' . $product['SIZE'] . '</h5>
                                                <div class="home-product-item__price">
                                                    <span class="home-product-item__price-current">' . number_format($product['Price']) . 'đ/' . $product['Unit'] . '</span>
                                                </div>
                                                <div class="home-product-item__action">
                                                    <span class="home-product-item__like home-product-item__like--liked">
                                                        <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                                        <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                                                    </span>
                                                    <div class="home-product-item__rating">
                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                        <i class="home-product-item__star--gold fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <span class="home-product-item__sold">' . $product['TotalSellQuantity'] . ' đã bán</span>
                                                </div>
                                                <div class="home-product-item__origin">
                                                    <span class="home-product-item__brand">' . $product['Brand'] . '</span>
                                                </div>
                                                <div class="home-product-item__favourite">
                                                    <i class="fas fa-check"></i>
                                                    <span>Yêu thích</span>
                                                </div>
                                            </a>
                                        </div>';
                                }
                                ?>

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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function Search(key) {
        if (key == "") {
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#lst-product").empty().append(this.responseText);

                }
            }
            xmlhttp.open("GET", "productSearch.php?k=" + key, true);
            xmlhttp.send();
        }
    }

    $('#btn-search').on('click', function() {
        var keySearch = $('#search-value').val();

        Search(keySearch);
    })
</script>