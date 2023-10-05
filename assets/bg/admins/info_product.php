<?php
require_once("inc/conn.inc.php");

session_start();
if (!isset($_SESSION["admin_user"])) {
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
            <div style="color: #E74C3C;" class="menu-item" onclick="window.open('logout', '_self');">تسجيل الخروج</div>
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
                <div class="url-path">الطلب </div>
            </div>
            <?php
                $request_id=$_GET["req_id"];
                $sql="SELECT * FROM orders WHERE id='$request_id'";
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();
            
           
                if(isset($_POST['status'])){
                    $req_status = $_POST["status"];
                    if (empty($req_status)) 
                    {
                        echo "<h2  style='margin:20px ;color:#cc0000;'>اختر خيار اخر</h2>";
                    }
                        else
                    {
                        $sql2="UPDATE orders SET status='$req_status' WHERE id='$request_id'";
    
                        if ($conn->query($sql2)=== TRUE) {
                            header("location:../../../requests");
                        }
                        else {
                            echo $conn->error;
                        }
                    }
                }  
            ?>
            
            
            





            <div style="margin: 20px;">
                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">الاسم الكامل</span>

                <span style="color:#333; font-size:20px;font-weight:bold;"><?php echo $row["name"];?></span>
                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;" >رقم الهاتف:</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;"><?php echo $row["phone"];?></span>

                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">العنوان</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;"><?php echo $row["address"];?></span>

                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">المدينه</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;"><?php echo $row["city"];?></span>

                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">الكوبون</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;"><?php echo $row["coupon"];?></span>

                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">السعر الاجمالي</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;"><?php echo $row["price"];?>SAR</span>

                <p></p>
                <span style="color:#cc0000; font-size:20px;font-weight:bold;">حاله الطلب</span>
                <span style="color:#blue; font-size:22px;font-weight:bold;">
                <?php
                if ($row["status"]  === '1') {
                    echo 'بانتظار التاكيد';
                        
                }
                if ($row["status"]  === '2') {
                    echo 'بانتظار الشحن';
                        
                }
                if ($row["status"]  === '3') {
                    echo ' تم الارسال';
                        
                }
                if ($row["status"]  === '4') {
                    echo ' تم الغاء الطلب';
                        
                }
                if ($row["status"]  === '5') {
                    echo ' تم الاستلام';
                        
                }

                ?></span>
                <h2>تعديل</h2>
            </div>

            <form action="" method="post" accept-charset="utf-8">
                <div class="container-form">
                    <select name="status">
                        <option value="" >اختر الحاله</option>
                        <option value="1" >بانتظار التاكيد</option>
                        <option value="2"> بانتظار الشحن </option>
                        <option value="3">تم الارسال</option>
                        <option value="4"> تم الغاء الطلب</option>
                        <option value="5"> تم الاستلام</option>
                    </select>
                    <br><br>
                    <button type="submit" class="btn-style" name="req_sub">تعديل</button>
                </div>

            </form>


        </div>
    </div>
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
