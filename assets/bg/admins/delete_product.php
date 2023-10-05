<?php
require_once("inc/conn.inc.php"); 
session_start();
$delete_product = isset($_GET["del_id"]) ? $_GET["del_id"] : null;
$del_stm = isset($_GET["del_stm"]) ? $_GET["del_stm"] : null;

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
    exit; // Ensure execution stops after the redirect
}

if ($delete_product && $del_stm === "true") {
    // Code for deleting the product and associated files
    $dir = "products_img/" . $delete_product;
    
    // Replace backslashes with forward slashes for Windows
    $dir = str_replace("\\", "/", $dir);

    $sql = "DELETE FROM products WHERE id='$delete_product'";
    $result = $conn->query($sql);

    function removeDirectory($path) {
        $iterator = new DirectoryIterator($path);

        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile()) {
                unlink($fileInfo->getRealPath());
            } else if (!$fileInfo->isDot() && $fileInfo->isDir()) {
                rmdir($fileInfo->getRealPath());
            }
        }

        rmdir($path);
    }

    removeDirectory($dir);
    header("Location: products");
    exit; // Ensure execution stops after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoneyMaroc | لوحة التحكم</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($delete_product) : ?>
        <h1 style="text-align: center; margin-top:100px;">هل أنت متأكد أنك تريد حذف هذا (رقم <?php echo $delete_product ?>)؟</h1>
        <h2 style="text-align: center; margin-top:50px;">
            <a   style="margin:0 10px; color:white; background-color: #f74c3c; padding:10px 15px; text-decorotion:none; border-radius:10px;" href="del_product.php?del_id=<?php echo $delete_product ?>&del_stm=true">نعم</a>
            <a   style="margin:0 10px; color:white; background-color: #18bc9c; padding:10px 15px; text-decorotion:none; border-radius:10px" href="products" >لا</a>
        </h2>
    <?php else : ?>
        <p>خطأ: لم يتم توفير معرف للمنتج لحذفه.</p>
    <?php endif; ?>

</body>
</html>