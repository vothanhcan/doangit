<?php
class AuthController
{

    function login()
    {
        // 1. Kiểm tra email có tồn tại không?
        $email = $_POST['email'];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if (!$customer) {
            $_SESSION['error'] = "Lỗi: Email $email không tồn tại trong hệ thống";
            // về trang chủ
            header('location: /');
            exit;
        }

        // 2. Kiểm tra mật khẩu
        $password = $_POST['password'];
        if (!password_verify($password, $customer->getPassword())) {
            $_SESSION['error'] = "Lỗi: Sai mật khẩu";
            // về trang chủ
            header('location: /');
            exit;
        }

        // 3. Kiểm tra tài khoản đã được kích hoạt chưa?
        if (!$customer->getIsActive()) {
            $_SESSION['error'] = "Lỗi: Tài khoản chưa được kích hoạt.";
            // về trang chủ
            header('location: /');
            exit;
        }
        // Mọi thứ ok, cho login vào hệ thống
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $customer->getName();
        header('location: ?c=customer&a=show');
    }

    function logout()
    {
        // hủy session
        session_destroy();
        header('location: /');
    }
}
