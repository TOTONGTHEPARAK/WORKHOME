<?php include "connect.php" ?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style1.css">
    </head>
<body>
    <div class="wrapper">
        <div class="topnav">
            <a href="add_to_sql.php">Link</a>
            <a href="frist.php">Link</a>
            <a href="cart.php">Cart</a>
        </div>
    </div>
    จงแสดง 3 อันดับสินค้าที่ขายดีที่สุด
    <?php
    $stmt = $pdo->prepare("SELECT menu.menu_Name,COUNT(menu.menu_Name) FROM menu,makings WHERE makings.menu_No = menu.menu_No GROUP BY menu_Name ORDER BY COUNT(menu.menu_Name) DESC LIMIT 3;");
    $stmt->execute();
    $stmt2 = $pdo->prepare("SELECT menu.menu_Name,bill.bill_Id,bill.bill_result,bill.bill_Date FROM bill,makings,menu WHERE bill.bill_Date BETWEEN '2023-00-00 16:00:00' AND '2024-00-00 22:00:00' AND bill.bill_Id = makings.bill_Id AND makings.menu_No = menu.menu_No");
    $stmt2->execute();
    $stmt3 = $pdo->prepare("SELECT Month(bill_Date),SUM(bill.bill_result) FROM bill WHERE bill.bill_Date LIKE '2023-10%'");
    $stmt3->execute();
    $i = 0;
    ?>
    <?php while ($row = $stmt->fetch()): ?>
        <?php 
            $name[$i] = $row["menu_Name"];
            $result[$i] = $row["COUNT(menu.menu_Name)"];
            $i++;
        ?>
    <?php endwhile; ?>
    <?php
    echo "
    <table border='1' width='auto'>
        <tr>
            <th>ชื่อเมนู</th>
            <th>จำนวน</th>
        </tr>";
    for ($j = 0; $j < $i; $j++) {
        echo "<tr><td>" . $name[$j] . "</td><td>" . $result[$j];
    }
    echo "
        </table>
    ";
    ?>
    จงแสดงรายการที่ขายในช่วงเวลา 16.00-22.00 น.
    <?php $l = 0; ?>
    <?php while ($row = $stmt2->fetch()): ?>
        <?php 
            $name2[$l] = $row["menu_Name"];
            $billid[$l] = $row["bill_Id"];
            $billresult[$l] = $row["bill_result"];
            $billtime[$l] = $row["bill_Date"];
            $l++;
        ?>
    <?php endwhile; ?>
    <?php
    echo "
    <table border='1' width='auto'>
        <tr>
            <th>ชื่อเมนู</th>
            <th>ID</th>
            <th>รวม</th>
            <th>เวลา</th>
        </tr>";
    for ($m = 0; $m < $l; $m++) {
        echo "<tr><td>" . $name2[$m] . "</td><td>" . $billid[$m] . "</td><td>" . $billresult[$m] . "</td><td>" . $billtime[$m];
    }
    echo "
        </table>
    ";
    ?>
    จงแสดงจำนวนยอดขายทั้งหมดของเดือน 10
    <?php $k = 0; ?>
    <?php while ($row = $stmt3->fetch()): ?>
        <?php 
            $month[$k] = $row["Month(bill_Date)"];
            $summonth[$k] = $row["SUM(bill.bill_result)"];
            $k++;
        ?>
    <?php endwhile; ?>
    <?php
    echo "
    <table border='1' width='auto'>
        <tr>
            <th>เดือน</th>
            <th>ยอดขายรวม</th>
        </tr>";
    for ($n = 0; $n < $k; $n++) {
        echo "<tr><td>" . $month[$n] . "</td><td>" . $summonth[$n];
    }
    echo "
        </table>
    ";
    ?>
</body>
</html>

