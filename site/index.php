<?php
session_start(); //để dùng biến $_SESSION (luật)
require '../vendor/autoload.php';

$c = $_GET['c'] ?? 'home';
$a = $_GET['a'] ?? 'index';

$strController = ucfirst($c) . 'Controller'; //HomeController

// require "controller/HomeController.php";
require "controller/$strController.php";

// import config
require '../config.php';
require '../connectDb.php';

// require model
require '../bootstrap.php';

// Tạo đối tượng controller tương ứng với tham số c
$controller = new $strController();

// Gọi hàm của controller đó tương ứng tham số a
$controller->$a();
