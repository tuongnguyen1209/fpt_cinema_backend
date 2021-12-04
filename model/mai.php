<?php
// class mail
// {
//     private $conn;



//     public function __construct($db)
//     {
//         $this->conn = $db;
//     }
function goimail($mailc, $content)
{
    require "./PHPMailer-master/PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
    require "./PHPMailer-master/PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
    require './PHPMailer-master/PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
    $mail = new PHPMailer\PHPMailer\PHPMailer(true); //true: enables exceptions
    try {
        $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        // $nguoigui = 'phat718920@gmail.com';
        // $matkhau = '09749746790979526006';
        $nguoigui = 'testguiemail2020@gmail.com';
        $matkhau = 'guimail123';
        $tennguoigui = 'POLY CINEMA';
        $mail->Username = $nguoigui; // SMTP username
        $mail->Password = $matkhau;   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom($nguoigui, $tennguoigui);
        // $to = "nautogame2@gmail.com";
        $to = $mailc;
        $to_name = "Tên người nhận";

        $mail->addAddress($to, $to_name); //mail và tên người nhận  
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Gửi thư từ POLY CINEMA';
        $noidungthu = ' <h1 style="text-align: center; color: red; ">POLY CINEMA</h1>  <hr>';
        $noidungthu .= "<p style='padding: 20px 30px;'>$content</p>";
        $noidungthu .= "<hr/><p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</p>";
        $mail->Body = $noidungthu;
        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        echo 'Đã gửi mail xong';
    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}
// }
