<?php

require_once("inc/conn.inc.php");

session_start();
if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header">
        <div class="header-title">لوحة التحكم</div>
        <div class="side-menu">
            <div class="menu-item" onclick="window.open('../../../setting', '_self');">إعدادات الموقع</div>
            <div style="color: #E74C3C;" class="menu-item" onclick="window.open('../../../logout', '_self');">تسجيل الخروج</div>
        </div>
    </div>

    <div class="content">
        <div class="side-bar">
            <div class="item-bar" onclick="window.open('../../../home','_self');">الصفحة الرئيسية</div>
            <div class="item-bar" onclick="window.open('../../../products' ,'_self');">المنتوجات</div>
            <div id="req1" class="item-bar" onclick="sub_menu_open();">الطلبات</div>
            <div id="req2" class="item-bar" onclick="sub_menu_close();">الطلبات</div> 
            <div id="sub-menu"  class="sub-menu">
                <div onclick="window.open('../../../requests','_self')">الكل</div>
                <div onclick="window.open('../../../req1','_self')">بانتظار التاكيد</div>
                <div onclick="window.open('../../../req2','_self')">بانتظار الشحن</div>
                <div onclick="window.open('../../../req3','_self')">تم الارسال</div>
                <div onclick="window.open('../../../req4','_self')">تم الغاء الطلب</div>
                <div onclick="window.open('../../../req5','_self')">تم الاستلام</div>
            </div>
            <div class="item-bar" onclick="window.open('../../../discounts','_self');">الخصومات</div>
            <div class="item-bar" onclick="window.open('../../../cat','_self');">الاقسام</div>
            <div class="item-bar" onclick="window.open('../../../director','_self');">المدراء</div>
            <div class="item-bar" onclick="window.open('../../../setting','_self');">إعدادات الموقع</div>
        </div>
        <div class="content-bar">
            <div class="path-bar">
                <div class="url-path active-path">الرئيسية</div>
                <div class="url-path slash">/</div>
                <div class="url-path">اقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">اضافه قسم جديد </div>
            </div>
            <?php
            if (isset($_POST["cat_sub"])) {
                $cat_name = $_POST["cat_name"];

                if (empty($cat_name)) {
                    echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
                }
                    else {

                        $sql2 = "SELECT * FROM category ORDER BY id DESC LIMIT 1";
                        $result2 = $conn->query($sql2);

                        $row2 = $result2->fetch_assoc();

                        $num_rows = $result2->num_rows;

                        if ($num_rows < 0) {
                            $num_count = "1";
                        }
                        else {
                            $num_count = $row2["list_num"] + 1;
                        }

                        $sql = "INSERT category SET cat_name='$cat_name', list_num='$num_count'";
                        
                        if ($conn->query($sql) === TRUE) {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #e6fff5;'>لقد تم إضافة القسم بنجاح</div>";
                        }
                        else {
                            echo "<div style='margin: 20px; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>هناك خطأ: " . $conn->error . "</div>";
                        }

                    }
            }


            ?>
            <div class="container-form">
                <form action="" method="post">
                    <input type="text" name="cat name" id="" placeholder="اسم القسم  ">

                    <p>
                        <input type="submit" name="cat_sub" value="حفظ">
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.editorConfig = function (config) {
            config.language = 'ar';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;
        }
    </script>
    <script>
            function sub_menu_open() {
                document.getElementById("req1").style.display="none";
                document.getElementById("req2").style.display="block";
                document.getElementById("sub-menu").style.height="260px" ; 
            }
            function sub_menu_close() {
                document.getElementById("req1").style.display="block";
                document.getElementById("req2").style.display="none";
                document.getElementById("sub-menu").style.height="0px";  
            }
    </script>
        
</body>
</html>
