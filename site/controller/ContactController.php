<?php


class ContactController
{
    function form()
    {
        require 'view/contact/form.php';
    }

    function sendEmail()
    {
        $emailService = new EmailService();
        $to = SHOP_OWNER;
        $subject = "Godashop - Liên hệ";
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $message = $_POST['content'];
        $web = get_domain();
        $content = "
            Xin chào chủ cửa hàng, <br>
            Dưới đây là thông tin khách hàng liên hệ, <br>
            Tên: $fullname, <br>
            Email: $email, <br>
            Số điện thoại: $mobile, <br>
            Nội dung: $message, <br>
            Gởi từ trang web: $web
        ";
        $emailService->send($to, $subject, $content);
        echo 'Đã gởi mail thành công';
    }
}