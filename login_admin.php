<?php
include 'db_connect.php'; // كنجيبو كود الربط باش نخدمو به
session_start(); // باش السيستيم يعقل بلي المدير مسجل الدخول

if (isset($_POST['btn_admin'])) {
    // كنجيبو داكشي اللي كتب المدير في HTML
    $user = $_POST['admin_user'];
    $pass = $_POST['admin_password'];

    // كنسولو القاعدة: واش هاد المدير كاين؟
    $query = "SELECT * FROM admins WHERE admin_user = '$user' AND admin_password = '$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // إذا لقاه، كنحفظو معلوماتو في Session وندوزوه
        $admin_data = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin_data['id'];
        
        echo "تم تسجيل الدخول بنجاح! جاري التحويل...";
        header("Refresh: 2; url=admin_dashboard.php"); 
    } else {
        echo "خطأ: اسم المستخدم أو كلمة السر غير صحيحة.";
    }
}
?>