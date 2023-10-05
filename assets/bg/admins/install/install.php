
<?php include("../inc/conn.inc.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="main_style">
    <style type="text/css">
        body{
            background-color #F5F5F5;;
        }
        .container2{
            margin:50px auto;
            width:500px;
            height:auto;
            text-align:center;
            border:1px solid #d9d9d9;
            background-color:#FFFFFF;
            padding: 20px;
        }

        .container2 .secs_class{ 
            margin:5px;
            width: 100%;
            color:#638761;
            text-align:right;
            font-weight:bold;
            border:1px solid #d9d9d9;
            background-color: #dff0d8;
            border-radius:6px;
            padding:15px 20px;

        }
        .container2 .err_class{
            margin:5px;
            width: 100%;
            color:#dd7373;
            font-weight:bold;
            text-align:right;
            border:1px solid #d9d9d9;
            background-color: #f2dede;
            border-radius:6px;
            padding:12px 20px;

        }  
        .container2 .btn_style2{
            margin:10px 0 !important;
            font-family: 'Tajawal', sans-serif !important;
            font-size:15px !important;
            font-weight:bold !important;
            color:white !important;
            border:1px solid #d9d9d9 !important;
            border-radius:6px !important;  
            background-color:#5cb85c !important;
            border-color:#4cae4c !important;
            padding:10px 15px !important;
            cursor: pointer !important;
        }
    </style>
</head>
<body>
    <div class="container2  container-form">
        <?php
		if (isset($_POST["server_sub"])) {

			$server = $_POST["server_host"];
			$user_serv = $_POST["server_user"];
			$pass_serv = $_POST["server_pass"];
			$dbname = $_POST["server_db"];

			if (empty($server) ||
				empty($user_serv) ||
				empty($dbname)) {
				echo "<div style='margin: 20px 0; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
			}
			else {
				$server_data = $server . "," . $user_serv . "," . $pass_serv . "," . $dbname;


				if (file_exists("../inc/server.inc.ecomweb")) {
					$server_post_data = file_put_contents("../inc/server.inc.ecomweb", $server_data);
					header("Location: tables_create");
				}
				else {
					echo "ملف server.inc.ecomweb غير موجود, أنشأه يدويا في المسار التاي:<br>assets/pg/admins/inc/";
				}
			}
		}
        if (isset($_POST["account_sub"])) {

			$account_user =htmlspecialchars($_POST["account_user"]);
			$account_email= htmlspecialchars($_POST["account_email"]);
			$account_pass = htmlspecialchars($_POST["account_pass"]);

			if (empty($account_user) ||
				empty($account_email) ||
				empty($account_pass)) {
				echo "<div style='margin: 20px 0; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
			}
			else {

                $sql2="INSERT admin_login SET admin_user='$account_user',admin_email='$account_email',admin_pass='$account_pass'";

				if ($conn->query($sql2)) {
                    header("Location: install?check=4");
				}
				else {
                    echo "يوجد خطا في دخول المدير للموقع ". $conn->error;
				}
			}
		}
        if (isset($_POST["web_sub"])) {

			$web_name =htmlspecialchars($_POST["web_name"]);
			if (empty($web_name)) {
				echo "<div style='margin: 20px 0; font-size: 18px; padding: 10px 15px; background-color: #ffe6e6;'>إملأ الفراغات</div>";
			}
			else {

				$sql2 = "INSERT web_settings SET web_name='$web_name', whatsapp_num='', header_text='', web_disc='', fb_pixel='', gl_analytics='' ";

				if ($conn->query($sql2)) {
                    header("Location: install?check=5");
				}
				else {
                    echo "يوجد خطا في دخول  في اسم الشركه ". $conn->error;
				}
			}
		}
        if ($_GET["check"]==="2") {
            ?>

			<h2>معلومات قاعدة الباينات</h2>

			<form action="" method="post">
				<input type="text" name="server_host" placeholder="هوست القاعدة">
				<input type="text" name="server_user" placeholder="إسم المستخدم">
				<input type="text" name="server_pass" placeholder="كلمة السر">
				<input type="text" name="server_db" placeholder="إسم القاعدة">
				<input type="submit" class="btn_style2" value="إنشاء الجداول" name="server_sub">
			</form>

			<div style="color: #1a1a1a; text-align: center; margin: 15px; font-weight: bold;">هده المرحلة تأخد بعض الوقت الرجاء الإنتظار.</div>

			<?php
        }

        else if ($_GET["check"]==="3") {
            ?>

			<h2>معلومات قاعدة الباينات</h2>

			<form action="" method="post">
				<input type="text" name="account_user" placeholder="اسم المدير">
				<input type="text" name="account_email" placeholder="ايميل المدير">
				<input type="password" name="account_pass" placeholder="كلمه سر">
				<input type="submit" class="btn_style2" value="إنشاء حساب" name="account_sub">
			</form>

			<?php
        }
        else if ($_GET["check"]==="4") {
            ?>

			<h2>اعدادات الموثع</h2>

			<form action="" method="post">
				<input type="text" name="web_name" placeholder="اسم الموثع ">
				<input type="submit" class="btn_style2" value="ادخال اعدادات الموثع " name="web_sub">
			</form>

			<?php
        }
        else if ($_GET["check"]==="5") {
            ?>
			<div style="color: #1a1a1a; text-align: center; margin: 15px; font-weight: bold;">تم تثبيت الموقع بنجاح  اتمني انك تحذف ملف تنزيل الموقع هو install</div>       
			<?php
        }
        else{
            ?>
            <?php
            $conn_inc="../inc/conn.inc.php";
            $serv_inc="../inc/server.inc.ecomweb";
            $tabl_inc="../inc/tables.inc.php";
            if (is_writeable($conn_inc)) {
                echo "<p>
                    <div class='secs_class'>الملف conn.inc.php الفابل للكتابه</div>
                
                        </p>";
            }
            else{
                echo "<p>
                <div class='err_class'>الملف conn.inc.php الفابل للكتابه</div>
            
                    </p>";
            }
            if (is_writeable($serv_inc)) {
                echo "<p>
                    <div class='secs_class'>الملف server.inc.ecomweb الفابل  للكتابه</div>
                
                        </p>";
            }
            else{
                echo "<p>
                <div class='err_class'>  الملف server.inc.ecomweb الفابل للكتابه</div>
            
                    </p>";
            }
            if (is_writeable($tabl_inc)) {
                echo "<p>
                    <div class='secs_class'>الملف tables.inc.phpالفابل  للكتابه</div>
                
                        </p>";
            }
            else{
                echo "<p>
                <div class='err_class'>  الملف tables.inc.phpالفابل للكتابه</div>
            
                    </p>";
            }

            ?>

            <button class="btn_style2" onclick="window.open('?check=2', '_self');">بدأ التنصيب</button>


            <?php



        }
        
        
        ?>


		<div style="color: #1a1a1a; text-align: center; margin: 15px; font-weight: bold;">by <span style="color: #0088ff;">Ahmed Raafat</span></div>



    </div>
</body>
</html>
