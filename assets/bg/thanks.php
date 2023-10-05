<?php 

    require_once("admins/inc/conn.inc.php");
    $sql10 = "SELECT * FROM web_settings";
    $result10 = $conn->query($sql10);

    $row10 = $result10->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row10["web_name"]; ?></title>
    <link rel="stylesheet" href="main_style">
</head>
<body>
    <!-- google Analytice -->
    <?php echo $row2['gl_analytics']; ?>
    <!--  End google Analytice -->

    <!-- facebook pixel -->
    <?php echo $row2['fb_pixel']; ?>
    <!-- End facebook pixel -->
    <div class="whts-num-box">
        <button class="whts-btn"></button>
        <span class="whts-text"><?php echo $row10["whatsapp_num"]; ?></span>
    </div>
    <div class="header-bar">
            <?php echo $row10["header_text"]; ?>
        </div>
            <!-- تحت الراس الموقع -->
        <header>
            <div class="center-bar">
                <div class="logo-wbs" onclick="window.open('main_page','_self')">
                <button>التخفيضات</button>
                </div>
            </div>
        </header>
        <div class="thanks_page">
            <div class="thanks_icon"></div>
            <div class="thanks_text">
                لقد تم تسجيل طلبكم<br>
                سنقوم بالاتصال بكم في اقل من 24ساعه لتاكيد الطلب شكرا !!! <br>
                <p>
                    <button class="btn-style" onclick="window.open('index.php','_self')">اكمل التسوق</button>
                </p>
            </div>
        </div>

        <footer>
            <div class="title-footer">جميع الحقوق المحفوظه &copy;   <?php echo  date("Y") ." ". $row10["web_name"]; ?></div>

        </footer>
</body>
</html>

