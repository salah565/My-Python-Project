<?php
include 'db_connect.php';
session_start();

// حماية: التأكد من أن المدير هو اللي كينفذ هاد العمليات
if (!isset($_SESSION['admin_id'])) {
    die("دخول غير مسموح!");
}

// --- 1. إضافة قسم جديد وتخصيص أستاذ ---
if (isset($_POST['add_class'])) {
    $class_name = mysqli_real_escape_string($conn, $_POST['class_name']);
    $teacher_id = $_POST['teacher_id'];
    
    // إذا لم يتم اختيار أستاذ، نضع NULL
    $t_val = ($teacher_id == "") ? "NULL" : "'$teacher_id'";
    
    $sql = "INSERT INTO classes (class_name, teacher_id) VALUES ('$class_name', $t_val)";
    mysqli_query($conn, $sql);
    header("Location: admin_dashboard.php?success=1");
}

// --- 2. إضافة أستاذ جديد ---
if (isset($_POST['add_teacher'])) {
    $user = mysqli_real_escape_string($conn, $_POST['teacher_user']);
    $pass = mysqli_real_escape_string($conn, $_POST['teacher_password']);
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $admin_id = $_SESSION['admin_id'];

    $sql = "INSERT INTO teachers (teacher_user, teacher_password, full_name, created_by_admin) 
            VALUES ('$user', '$pass', '$name', '$admin_id')";
    mysqli_query($conn, $sql);
    header("Location: admin_dashboard.php?success=1");
}

// --- 3. إضافة تلميذ جديد ---
if (isset($_POST['add_student'])) {
    $user = mysqli_real_escape_string($conn, $_POST['student_user']);
    $pass = mysqli_real_escape_string($conn, $_POST['student_password']);
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $class_id = $_POST['class_id'];

    $sql = "INSERT INTO students (student_user, student_password, full_name, class_id) 
            VALUES ('$user', '$pass', '$name', '$class_id')";
    mysqli_query($conn, $sql);
    header("Location: admin_dashboard.php?success=1");
}

// --- 4. عمليات المسح (DELETE) ---

// مسح قسم
if (isset($_GET['del_class'])) {
    $id = $_GET['del_class'];
    mysqli_query($conn, "DELETE FROM classes WHERE id = $id");
    header("Location: admin_dashboard.php?msg=deleted");
}

// مسح أستاذ
if (isset($_GET['del_teacher'])) {
    $id = $_GET['del_teacher'];
    mysqli_query($conn, "DELETE FROM teachers WHERE id = $id");
    header("Location: admin_dashboard.php?msg=deleted");
}

// مسح تلميذ
if (isset($_GET['del_student'])) {
    $id = $_GET['del_student'];
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    header("Location: admin_dashboard.php?msg=deleted");
}
?>