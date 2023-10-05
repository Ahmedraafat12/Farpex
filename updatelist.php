<?php
// require_once("assets/pg/admins/inc/conn.inc.php");
require_once("./assets/pg/admins/inc/conn.inc.php");
session_start();
if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}
$array = $_POST['arrayorder']; // Add a semicolon here

if ($_POST['update'] == "update") {
    $count = 1;
    foreach ($array as $idval) { // Change &idval to $idval
        $sql3 = "UPDATE category SET list_num='$count' WHERE id='$idval'";

        if ($conn->query($sql3) === TRUE) { // Change $sql to $sql3
            // echo "لقد تم التحديث بنجاح";
        } else {
            echo "هناك خطأ " . $conn->error;
        }
        $count++; // Increment the count
    }
    //echo "<div>لقد تم التحديث بنجاح</div>";
    echo "<div style='margin: 10px; font-size: 18px; padding: 10px 15px; background-color: #e6fff5;'>لقد تم تحديث  بنجاح</div>";

}
?>
