<?php
session_start();

// ตรวจสอบว่ามีตัวแปรเซสชัน "cart" หรือไม่
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array(); // ถ้ายังไม่มี ให้สร้างอาร์เรย์ว่าง
}

// เชื่อมต่อกับฐานข้อมูล (อาจต้องปรับแต่งตามเครื่องหมายคำถามสำหรับการเชื่อมต่อ)
include "connect.php";

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลเมนูจากฐานข้อมูล
if (empty($_SESSION["cart"])) {
    $sql = "SELECT * FROM menu WHERE 1=0"; // กำหนด SQL เป็นเงื่อนไขเท็จ
} else {
    $sql = "SELECT * FROM menu WHERE menu_No IN (" . implode(",", $_SESSION["cart"]) . ")";
}

$stmt = $pdo->prepare($sql);
$stmt->execute();

$stmt2 = $pdo->prepare("SELECT MAX(bill_Id) FROM bill");
$stmt2->execute();
$row = $stmt2->fetch();


// แสดงค่า session "cart"
$cart = $_SESSION["cart"];
$maxIndex = max(array_keys($cart));

// สร้างตัวแปรใหม่เพื่อจัดเรียงค่าใน session "cart"
$newCart = array();
$count = 0;

for ($x = 0; $x <= $maxIndex; $x++) {
    if (isset($_SESSION["cart"][$x])) {
        if ($_SESSION["cart"][$x] != 0) {
            // เพิ่มสินค้าในตำแหน่งใหม่ใน $newCart
            $newCart[$count] = $_SESSION["cart"][$x];
            $count++;
        }
    }
}

// กำหนด session "cart" ใหม่
$_SESSION["cart"] = $newCart;

// แสดงค่า session "cart" ใหม่
echo "รายการสินค้าในตะกร้า: ";
print_r($row["MAX(bill_Id)"]);
print_r($_SESSION["cart"]);

?>

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="wrapper">
        <div class="topnav">
            <a href="add_to_sql.php">Link</a>
            <a href="frist.php">Link</a>
            <a href="cart.php">Cart</a>
        </div>
        <div class="content">
            <h1>Shopping Cart</h1>
        </div>
        <div class="footer">
            <div>Footer</div>    
        </div>
    </div>
</body>
</html>
