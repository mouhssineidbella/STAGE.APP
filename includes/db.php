<?php
$servername = "localhost";  // اسم الخادم
$username = "root";         // اسم المستخدم الافتراضي في XAMPP
$password = "";             // كلمة المرور (فارغة في XAMPP)
$dbname = "notification_system"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// فحص الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// تعيين ترميز UTF-8 لدعم اللغة العربية
$conn->set_charset("utf8");

?>
