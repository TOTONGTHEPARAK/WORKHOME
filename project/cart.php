<?php include "connect.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <?php
        // ตรวจสอบว่า menu_No มีค่าใน URL
        if(isset($_GET["menu_No"])) {
            $menu_No = $_GET["menu_No"];
            
            // แปลงค่าที่รับมาเป็นอาร์เรย์
            $menu_NoArray = explode(',', $menu_No);

            // ใช้ foreach เพื่อเรียกข้อมูลสำหรับแต่ละ menu_No
            foreach ($menu_NoArray as $menuNo) {
                $stmt = $pdo->prepare("SELECT * FROM menu WHERE menu_No = ?");
                $stmt->bindParam(1, $menuNo);
                $stmt->execute();
                $row = $stmt->fetch();

                // แสดงข้อมูล
                echo "menu_No: " . $row["menu_No"] . "<br>";
                echo "menu_Name: " . $row["menu_Name"] . "<br>";
                echo "price: " . $row["price"] . "<br>";
            }
        } else {
            // กรณีที่ไม่มี menu_No ใน URL
            echo "ไม่มีข้อมูลในรายการ";
        }
    ?>

</body>
</html>
