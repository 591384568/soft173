<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPmailer\Exception;

function mailto($to, $title, $content) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.qq.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '591384568@qq.com';                     // SMTP username
        $mail->Password   = 'vududqjjtwwvbceg';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       =  465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('591384568@qq.com', 'Xride');
        $mail->addAddress($to);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

        return $mail->send();
    } catch (Exception $e) {
        Exception($mail->ErrorInfo, 1001);
    }
}

// 把span字符串替换成a
function replace($data) {
    return str_replace('span', 'a', $data);
}

// 判断客户端所用的浏览器
function userBrowser() {
    $user_OSagent = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
        $visitor_browser = "Maxthon(Microsoft IE)";
    } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
        $visitor_browser = "Maxthon 2.0";
    } elseif (strpos($user_OSagent, "Maxthon")) {
        $visitor_browser = "Maxthon";
    } elseif (strpos($user_OSagent, "MSIE 9.0")) {
        $visitor_browser = "MSIE 9.0";
    } elseif (strpos($user_OSagent, "MSIE 8.0")) {
        $visitor_browser = "MSIE 8.0";
    } elseif (strpos($user_OSagent, "MSIE 7.0")) {
        $visitor_browser = "MSIE 7.0";
    } elseif (strpos($user_OSagent, "MSIE 6.0")) {
        $visitor_browser = "MSIE 6.0";
    } elseif (strpos($user_OSagent, "MSIE 5.5")) {
        $visitor_browser = "MSIE 5.5";
    } elseif (strpos($user_OSagent, "MSIE 5.0")) {
        $visitor_browser = "MSIE 5.0";
    } elseif (strpos($user_OSagent, "MSIE 4.01")) {
        $visitor_browser = "MSIE 4.01";
    } elseif (strpos($user_OSagent, "MSIE")) {
        $visitor_browser = "MSIE 较高版本";
    } elseif (strpos($user_OSagent, "NetCaptor")) {
        $visitor_browser = "NetCaptor";
    } elseif (strpos($user_OSagent, "Netscape")) {
        $visitor_browser = "Netscape";
    } elseif (strpos($user_OSagent, "Chrome")) {
        $visitor_browser = "Chrome";
    } elseif (strpos($user_OSagent, "Lynx")) {
        $visitor_browser = "Lynx";
    } elseif (strpos($user_OSagent, "Opera")) {
        $visitor_browser = "Opera";
    } elseif (strpos($user_OSagent, "Konqueror")) {
        $visitor_browser = "Konqueror";
    } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
        $visitor_browser = "Mozilla";
    } elseif (strpos($user_OSagent, "Firefox")) {
        $visitor_browser = "Firefox";
    } elseif (strpos($user_OSagent, "U")) {
        $visitor_browser = "Firefox";
    } else {
        $visitor_browser = "其它";
    }
    return $visitor_browser;
}