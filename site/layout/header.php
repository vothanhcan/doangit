<!DOCTYPE html>
<html>

<head>
    <title>Trang chủ - Mỹ Phẩm Goda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../upload/logo.jpg" />
    <link rel="stylesheet" href="public/vendor/fontawesome-free-5.11.2-web/css/all.min.css">
    <link rel="stylesheet" href="public/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="public/vendor/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="public/vendor/star-rating/css/star-rating.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/vendor/jquery.min.js"></script>
    <script src="public/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/vendor/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script type="text/javascript" src="public/vendor/star-rating/js/star-rating.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="public/vendor/format/number_format.js"></script>
    <script src="public/vendor/jquery-validation-1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
</head>
<?php
global $c, $a;
?>

<body>
    <header>
        <!-- use for ajax -->
        <input type="hidden" id="reference" value="">
        <!-- Top Navbar -->
        <div class="top-navbar container-fluid">
            <div class="menu-mb">
                <a href="javascript:void(0)" class="btn-close" onclick="closeMenuMobile()">×</a>
                <a class="<?= $c == 'home' ? 'active' : '' ?>" href="/">Trang chủ</a>
                <a class="<?= $c == 'product' ? 'active' : '' ?>" href="?c=product">Sản phẩm</a>
                <a class="<?= $a == 'returnPolicy' ? 'active' : '' ?>" href="?c=information&a=returnPolicy">Chính sách
                    đổi trả</a>
                <a class="<?= $a == 'paymentPolicy' ? 'active' : '' ?>" href="?c=information&a=paymentPolicy">Chính sách
                    thanh toán</a>
                <a class="<?= $a == 'deliveryPolicy' ? 'active' : '' ?>" href="?c=information&a=deliveryPolicy">Chính
                    sách giao hàng</a>
                <a class="<?= $a == 'form' ? 'active' : '' ?>" href="?c=contact&a=form">Liên hệ</a>
            </div>
            <div class="row">
                <div class="hidden-lg hidden-md col-sm-2 col-xs-1">
                    <span class="btn-menu-mb" onclick="openMenuMobile()"><i
                            class="glyphicon glyphicon-menu-hamburger"></i></span>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/HocLapTrinhWebTaiNha.ThayLoc"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-10 col-xs-11">
                    <ul class="list-inline pull-right top-right">
                        <li class="account-login">
                            <?php if (empty($_SESSION['email'])) : ?>
                            <!-- chưa login -->
                            <a href="javascript:void(0)" class="btn-register">Đăng Ký</a>
                            <?php else : ?>
                            <!-- đã login -->
                            <a href="?c=customer&a=orders" class="btn-logout">Đơn hàng của tôi</a>
                            <?php endif ?>
                        </li>
                        <li>
                            <?php if (empty($_SESSION['email'])) : ?>
                            <!-- chưa login -->
                            <a href="javascript:void(0)" class="btn-login">Đăng Nhập </a>
                            <?php else : ?>
                            <!-- đã login -->
                            <a href="javascript:void(0)" class="btn-account dropdown-toggle" data-toggle="dropdown"
                                id="dropdownMenu"><?= $_SESSION['name'] ?></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                <li><a href="?c=customer&a=show">Thông tin tài khoản</a></li>
                                <li><a href="?c=customer&a=shippingDefault">Địa chỉ giao hàng</a></li>
                                <li><a href="?c=customer&a=orders">Đơn hàng của tôi</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="?c=auth&a=logout">Thoát</a></li>
                            </ul>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End top navbar -->
        <!-- Header -->
        <div class="container">
            <div class="row">
                <!-- LOGO -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 logo">
                    <a href="#"><img src="../upload/goda450x170_1.jpg" class="img-responsive"></a>
                </div>
                <div class="col-lg-4 col-md-4 hidden-sm hidden-xs call-action">
                    <a href="#"><img src="../upload/godakeben450x170.jpg" class="img-responsive"></a>
                </div>
                <!-- HOTLINE AND SERCH -->
                <div class="col-lg-4 col-md-4 hotline-search">
                    <div>
                        <p class="hotline-phone"><span><strong>Hotline: </strong><a
                                    href="tel:0932.538.468">0932.538.468</a></span></p>
                        <p class="hotline-email"><span><strong>Email: </strong><a
                                    href="mailto:nguyenhuulocla2006@gmail.com">nguyenhuulocla2006@gmail.com</a></span>
                        </p>
                    </div>
                    <form class="header-form" action="?c=product">
                        <div class="input-group">
                            <input type="search" class="form-control search" placeholder="Nhập từ khóa tìm kiếm"
                                name="search" autocomplete="off" value="<?= $search ?? '' ?>">
                            <div class="input-group-btn">
                                <button class="btn bt-search bg-color" type="submit"><i class="fa fa-search"
                                        style="color:#fff"></i>
                                </button>
                            </div>
                            <input type="hidden" name="c" value="product">

                        </div>
                        <div class="search-result">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End header -->
    </header>
    <!-- NAVBAR DESKTOP-->
    <nav class="navbar navbar-default desktop-menu">
        <div class="container">
            <ul class="nav navbar-nav navbar-left hidden-sm hidden-xs">
                <li class="<?= $c == 'home' ? 'active' : '' ?>">
                    <a href="/">Trang chủ</a>
                </li>
                <li class="<?= $c == 'product' ? 'active' : '' ?>"><a href="?c=product">Sản phẩm </a></li>
                <li class="<?= $a == 'returnPolicy' ? 'active' : '' ?>"><a href="?c=information&a=returnPolicy">Chính
                        sách đổi trả</a></li>
                <li class="<?= $a == 'paymentPolicy' ? 'active' : '' ?>"><a href="?c=information&a=paymentPolicy">Chính
                        sách thanh toán</a></li>
                <li class="<?= $a == 'deliveryPolicy' ? 'active' : '' ?>"><a
                        href="?c=information&a=deliveryPolicy">Chính sách giao hàng</a></li>
                <li class="<?= $a == 'form' ? 'active' : '' ?>"><a href="?c=contact&a=form">Liên hệ</a></li>
            </ul>
            <span class="hidden-lg hidden-md experience">Trải nghiệm cùng sản phẩm của Goda</span>
            <ul class="nav navbar-nav navbar-right">
                <li class="cart"><a href="javascript:void(0)" class="btn-cart-detail" title="Giỏ Hàng"><i
                            class="fa fa-shopping-cart"></i> <span class="number-total-product"> </span></a></li>
            </ul>
        </div>
    </nav>
    <?php require 'layout/message.php' ?>