<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CustomerController
{
    // Trang hiển thị thông tin tài khoản
    function show()
    {
        $email = $_SESSION['email'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        require 'view/customer/show.php';
    }

    function updateAccount()
    {
        $email = $_SESSION['email'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        // update customer & lưu xuống database
        $customer->setName($_POST['fullname']);
        $customer->setMobile($_POST['mobile']);
        if (!$customerRepository->update($customer)) {
            $_SESSION['error'] = $customerRepository->getError();
            // về trang chủ
            header('location: /');
            exit;
        }
        $_SESSION['success'] = "Đã cập nhật tài khoản thành công";
        // cập nhật lại session
        $_SESSION['name'] = $customer->getName();
        // về trang chủ
        header('location: ?c=customer&a=show');
        exit;
    }

    // Trang hiển thị thông giao hàng mặc định
    function shippingDefault()
    {
        require 'view/customer/shippingDefault.php';
    }

    // Trang hiển thị danh sách đơn hàng
    function orders()
    {
        $email = $_SESSION['email'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        $customer_id = $customer->getId();

        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getByCustomerId($customer_id);
        require 'view/customer/orders.php';
    }

    // Trang hiển thị chi tiết đơn hàng
    function orderDetail()
    {
        $order_id = $_GET['id'];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);
        require 'view/customer/orderDetail.php';
    }

    function notExistingEmail()
    {
        $email = $_GET['email'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if ($customer) {
            echo 'false';
            return;
        }
        echo 'true';
    }

    function register()
    {
        $data = [];
        $data["name"] = $_POST['fullname'];
        $data["password"] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $data["mobile"] = $_POST['mobile'];
        $data["email"] = $_POST['email'];
        $data["login_by"] = 'form';
        $data["shipping_name"] = $_POST['fullname'];
        $data["shipping_mobile"] = $_POST['mobile'];
        $data["ward_id"] = null;
        $data["is_active"] = 0;
        $data["housenumber_street"] = '';
        $customerRepository = new CustomerRepository();
        if (!$customerRepository->save($data)) {
            $_SESSION['error'] = $customerRepository->getError();
            header('location: /');
            exit;
        }
        $email = $data["email"];
        $_SESSION['success'] = "Đã tạo tài khoản thành công, vui lòng vào email $email để kích hoạt tài khoản";

        // Gởi mail kích hoạt tài khoản
        $emailService = new EmailService();
        $to = $email;
        $domain = get_domain();
        // mã hóa email
        $key = JWT_KEY;
        $payload = [
            'email' => $email,
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');

        $activeAccountLink = get_domain_site() . "?c=customer&a=active&token=$jwt";
        $subject = 'Godashop - Verify account';
        $content = "
        Dear $email, <br>
        Vui lòng click vào link bên dưới để kích hoạt tài khoản <br>
        <a href='$activeAccountLink'>Active Account</a> <br>
        Được gởi từ trang web $domain

        ";
        $emailService->send($to, $subject, $content);

        header('location: /');
    }

    function active()
    {
        // giải mã lấy email và active account tương ứng với email đó
        $jwt = $_GET['token'];
        $key = JWT_KEY;
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $email = $decoded->email;
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        $customer->setIsActive(1);
        if (!$customerRepository->update($customer)) {
            $_SESSION['error'] = $customerRepository->getError();
            header('location: /');
            exit;
        }
        $_SESSION['success'] = "Tài khoản $email đã được kích hoạt";
        header('location: /');
        exit;
    }

    function test1()
    {
        // mã hóa
        $key = 'Con chó đang gặm xương';
        $payload = [
            'email' => 'abc@gmail.com'
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        echo $jwt; //token
    }

    function test2()
    {
        // giải mã
        $jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFiY0BnbWFpbC5jb20ifQ.HeaeUr5Hm76_eoAgRF3D6tKUm3eeIaokSZeOYHsCTLU';
        $key = 'Con chó đang gặm xương';
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        var_dump($decoded);
    }
}
