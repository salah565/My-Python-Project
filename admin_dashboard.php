<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['admin_id'])) { header("Location: index.html"); exit(); }
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم مسار - احترافية</title>
    <style>
        :root {
            --primary: #1e3799;
            --secondary: #079992;
            --danger: #eb2f06;
            --warning: #f1c40f;
            --bg: #f1f2f6;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: var(--bg); margin: 0; padding: 20px; }
        .header { text-align: center; background: var(--primary); color: white; padding: 20px; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        
        .container { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; }
        
        /* شكل الكارت */
        .card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); border-top: 5px solid var(--primary); }
        .card.teachers { border-top-color: var(--secondary); }
        .card.students { border-top-color: #6a89cc; }

        h3 { margin-top: 0; color: #2f3542; display: flex; align-items: center; gap: 10px; }
        
        /* تنسيق الجداول */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.9em; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; color: #57606f; }
        tr:hover { background: #f9f9f9; }

        /* الأزرار */
        .btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 13px; border: none; cursor: pointer; display: inline-block; }
        .btn-add { background: var(--secondary); color: white; width: 100%; margin-top: 10px; }
        .btn-edit { background: var(--warning); color: #2f3542; margin-left: 5px; }
        .btn-del { background: var(--danger); color: white; }

        input, select { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        
        .logout { float: left; color: white; background: rgba(255,255,255,0.2); padding: 5px 15px; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>

    <div class="header">
        <a href="logout.php" class="logout">تسجيل الخروج</a>
        <h1>نظام إدارة المؤسسة - لوحة التحكم</h1>
    </div>

    <div class="container">
        
        <div class="card">
            <h3>🏫 إدارة الأقسام</h3>
            <form action="manage_data.php" method="POST">
                <input type="text" name="class_name" placeholder="اسم القسم الجديد" required>
                <select name="teacher_id">
                    <option value="">-- اختر أستاذ للقسم --</option>
                    <?php
                    $t_list = mysqli_query($conn, "SELECT * FROM teachers");
                    while($t = mysqli_fetch_assoc($t_list)) { echo "<option value='".$t['id']."'>".$t['full_name']."</option>"; }
                    ?>
                </select>
                <button type="submit" name="add_class" class="btn btn-add">إضافة القسم وتخصيص الأستاذ</button>
            </form>

            <table>
                <tr>
                    <th>القسم</th>
                    <th>الأستاذ</th>
                    <th>إجراء</th>
                </tr>
                <?php
                $classes = mysqli_query($conn, "SELECT classes.*, teachers.full_name FROM classes LEFT JOIN teachers ON classes.teacher_id = teachers.id");
                while($c = mysqli_fetch_assoc($classes)) {
                    echo "<tr>
                            <td><b>".$c['class_name']."</b></td>
                            <td>".($c['full_name'] ? $c['full_name'] : '---')."</td>
                            <td>
                                <a href='manage_data.php?del_class=".$c['id']."' class='btn btn-del' onclick='return confirm(\"مسح القسم؟\")'>🗑️</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="card teachers">
            <h3>👨‍🏫 إدارة الأساتذة</h3>
            <form action="manage_data.php" method="POST">
                <input type="text" name="teacher_user" placeholder="اسم المستخدم (User)" required>
                <input type="password" name="teacher_password" placeholder="كلمة السر" required>
                <input type="text" name="full_name" placeholder="الاسم الكامل">
                <button type="submit" name="add_teacher" class="btn btn-add" style="background:var(--secondary)">إضافة أستاذ جديد</button>
            </form>

            <table>
                <tr>
                    <th>الاسم</th>
                    <th>المستخدم</th>
                    <th>إجراء</th>
                </tr>
                <?php
                $ts = mysqli_query($conn, "SELECT * FROM teachers");
                while($row = mysqli_fetch_assoc($ts)) {
                    echo "<tr>
                            <td>".$row['full_name']."</td>
                            <td>".$row['teacher_user']."</td>
                            <td><a href='manage_data.php?del_teacher=".$row['id']."' class='btn btn-del'>🗑️</a></td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <div class="card students">
            <h3>🎓 إدارة التلاميذ</h3>
            <form action="manage_data.php" method="POST">
                <input type="text" name="student_user" placeholder="كود مسار" required>
                <input type="password" name="student_password" placeholder="كلمة السر" required>
                <input type="text" name="full_name" placeholder="الاسم الكامل">
                <select name="class_id" required>
                    <option value="">-- اختر القسم --</option>
                    <?php
                    $cl_list = mysqli_query($conn, "SELECT * FROM classes");
                    while($cl = mysqli_fetch_assoc($cl_list)) { echo "<option value='".$cl['id']."'>".$cl['class_name']."</option>"; }
                    ?>
                </select>
                <button type="submit" name="add_student" class="btn btn-add" style="background:#6a89cc">إضافة تلميذ جديد</button>
            </form>

            <table>
                <tr>
                    <th>التلميذ</th>
                    <th>القسم</th>
                    <th>إجراء</th>
                </tr>
                <?php
                $stds = mysqli_query($conn, "SELECT students.*, classes.class_name FROM students LEFT JOIN classes ON students.class_id = classes.id");
                while($s = mysqli_fetch_assoc($stds)) {
                    echo "<tr>
                            <td>".$s['full_name']."</td>
                            <td>".$s['class_name']."</td>
                            <td><a href='manage_data.php?del_student=".$s['id']."' class='btn btn-del'>🗑️</a></td>
                          </tr>";
                }
                ?>
            </table>
        </div>

    </div>

</body>
</html>