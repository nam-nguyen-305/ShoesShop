<?php
session_start();
require_once('../database/dbhelper.php');

//get the k parameter from URL
$k = $_GET["k"];

$htmlText = "";
//lookup all links from the xml file if length of k>0
if (strlen($k) > 0) {
    $sql = "select * from products where ProductName like '%$k%'";
    $listProduct = executeResult($sql);

    foreach ($listProduct as $product) {
        $htmlText = $htmlText . '<div class="grid__column-2-4">  
            <a class="home-product-item" href="product.php?ProductId=' . $product['ProductId'] . '">
                <div class="home-product-item__img" style="background-image: url(' . $product['thumbnail'] . ');"></div>
                <h4 class="home-product-item__name">' . $product['ProductName'] . '</h4>
                <h5 class="home-product-item__name">Size: ' . $product['SIZE'] . '</h5>
                <div class="home-product-item__price">
                    <span class="home-product-item__price-current">' . $product['Price'] . 'đ/' . $product['Unit'] . '</span>
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


}

echo $htmlText;
if ($htmlText == "") {
    $response = "no suggestion";
} else {
    $response = $htmlText;
}

//output the response
echo $response;
