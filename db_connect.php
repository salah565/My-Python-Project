<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db   = "massar_system";

// إنشاء الاتصال
$conn = mysqli_connect($host, $user, $pass, $db);

// التأكد من أن الاتصال خدام
if (!$conn) {
    die("خطأ في الاتصال: " . mysqli_connect_error());
}
?>