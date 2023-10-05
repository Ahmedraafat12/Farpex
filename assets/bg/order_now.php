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
    <style>
        .quantity-box{
            margin-top:20px;

        }
        .quantity-sys{
            margin-top:10px;
            width: 110px;
            height:auto;
            position: relative;
        }
        .quantity-sys button{
            font-size: 17px;
            border:none;
            background-color:#eeeeee;
            padding:3px 10px;
            -moz-appearance:none;
            -webkit-appearance:none;
            position: absolute;
            cursor:pointer;
        }
        #plus-btn{
            top:0;
            left:0;
        }
        #minus-btn{
            top:0;
            right:0;
        }
        .quantity-sys input[type=text] {
            width: 110px;
            font-size: 17px;
            text-align:center !important;
            border:none;
            outline:none;
            padding:3px;
            -moz-appearance:none;
            -webkit-appearance:none;

        }
    </style>
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
    <div class="show_prd">
        <div>
            <?php
            $prd_id=$_GET["id"];
            $sql="SELECT * FROM products WHERE id='$prd_id'";
            $result = $conn->query($sql);
            $row= $result->fetch_assoc();
            $quantity_num=$_POST["quantity-num"];
            ?>
            <div class="order_now_box">
                <div class="order_now_img">
                    <?php
                    $dir_path = "./admins/products_img/" . $prd_id;
                    $extensions_array = array('jpg', 'png', 'jpeg');  

                    if (is_dir($dir_path)) 
                    {
                        $files = scandir($dir_path);
                        $count_files= count($files);

                        echo "<img style=' width:100%; border:1px solid #ccc;'   src='".$absolute_link. "admins/products_img/". $prd_id . "/" . $files[2] . "'/>";
                    }
                    
                    
                    ?>
                </div>
                <div class="order_now_title">
                    <div>
                        <?php echo $row["title"];?>
                    </div>
                </div>
                <div class="order_now_price">
                    <div>
                        <?php echo $row["price"];?>SAR
                    </div>
                </div>
            </div>

            <hr style=" margin: top 20px;px; border:none; border-top:1px solid #ccc;">

            <div style="margin-top:20px;">
                <div style="display: flex; position:relative; font-size:25px;">
                    الكمية :
                    <div class="ship_info">
                        <?php echo $quantity_num;?>
                    </div>
                </div> 
                <div style="display: flex; position:relative; font-size:25px;">
                    مصاريف الشحن :
                    <div class="ship_info">
                        <?php echo $row["shipping"];?>SAR
                    </div>
                </div> 
                <div style=" margin-top:10px; display: flex; position:relative; font-size:25px;"> 
                    اجمالي المبلغ :
                    <div class="ship_info">
                        <?php echo $row["price"] * $quantity_num + $row["shipping"];?>SAR 
                    </div>
                </div>
                <div style="height:50px;"></div>

            </div>

        </div> 
        <script type="text/javascript" src="../../jpuery.min.js" ></script> 
        <div style="padding: 0 10px 10px 10px;">
            <form style="width:100%;" action="" method="post">
                <div class="container-form">
                    <?php

                    if (isset($_POST["order_sub"])) {
                        $fullname   =htmlspecialchars($_POST["fullname"]);
                        $phone      =htmlspecialchars($_POST["phone"]);
                        $city       =htmlspecialchars($_POST["city"]);
                        $address    =htmlspecialchars($_POST["address"]);
                        $coupon     =htmlspecialchars($_POST["coupon"]);
                        if (empty($fullname) || empty($phone) || empty($city) || empty($address))
                        {
                            echo "<div style=' font-size :20px; font-weight:bold; color:red; display:block;'> املاء الفرغات </div>";
                        }
                        else{
                            $quantity_num2=$_POST["quantity-num"];
                            $price=$row["price"] * $_POST["quantity-num"];
                            $shipping= $row["shipping"];
                            $date=date("d/m/y h:m:s");
                            $status="1";
                            $sql="INSERT INTO orders (product_id ,name,phone,address,city,coupon,price,shipping,date,status ) VALUES  ($prd_id ,'$fullname','$phone','$address', '$city', '$coupon', '$price' ,'$shipping' , '$date' , '$status')";

                            // $sql= "INSERT INTO orders SET  product_id=$prd_id ,name='$fullname' , phone='$phone', city='$city', address='$address',coupon='$coupon',price='$price' , shipping='$shipping' ,  date='$date' ,status='$status'"; 
                            if ($conn->query($sql)=== TRUE) {
                                header("location:thanks");

                            }
                            else{
                                echo "<div style=' font-size :20px; font-weight:bold; color:red;display:block;'>هناك خطا ما </div>";

                            }
                            $sql2 = "SELECT * FROM products ORDER BY id DESC";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
    
                            if ($result2->num_rows === '0') {
                                $product_id = "1";
                            } 
                            else {
                                $product_id = $row2["id"];//intval($row2["id"]) + 1;
                            }
        
                            mkdir('products_img/' . $product_id, 0777, true);
                            chmod('products_img/' . $product_id, 0777);
                            $file_count = count($_FILES["product_images"]["name"]);
                            for ($i = 0; $i < $file_count; $i++) {
                                $product_images_tmp = $_FILES["product_images"]["tmp_name"][$i];
                                $file_name = $_FILES["product_images"]["name"][$i];
                                move_uploaded_file($product_images_tmp, 'products_img/' . $product_id . '/' . $file_name);
                            }
                        }
                    }
                    ?>
                    <span style='font-size:20px; font-weight:bold;'>املأ الاستمارة لأتمام الطلب</span>
                    <input type="hidden" name="quantity-num" value=<?php echo  $_POST["quantity-num"];?> >
                    <input type="text" name="fullname" placeholder="الاسم بالكامل">
                    <input type="tel" name="phone" placeholder="رقم الهاتف">
                    <input type="text" name="city"placeholder="المحافظة">
                    <input type="text" name="address" placeholder="العنوان بالتفصيل (المنطقة واسم الشارع ورقم العقار ورقم الشقة)">
                    <input type="text" name="coupon" placeholder="كود التخفيض" id="coupon">
                    <input type="submit" name="order_sub" value="تأكيد الطلب">
                </div>
            </form>
        </div>
    </div> 
    <footer>
        <div class="title-footer">جميع الحقوق المحفوظه &copy;   <?php echo  date("Y") ." ". $row10["web_name"]; ?></div>
    </footer>
</body>
</html>  
 