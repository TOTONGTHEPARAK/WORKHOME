<?php include "connect.php" ?>

<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <script>
            var idnum = {}; // ต้องใช้ var หรือ let ในการประกาศตัวแปร

            function addtocart(menu_No) {
                idnum[menu_No] = (idnum[menu_No] || 0) + 1;    
                console.log(idnum);
            }

            function pushtocart() {
                var idnumStr = idnum.join(',');
                window.location.href = "cart.php?menu_No=" + idnum;
            }
        </script>
    </head>
<body>
    <div class="wrapper">
        <div class="topnav">
            <a href="#">Link</a>
            <a href="#">Link</a>
            <a href="cart.php">cart</a>
            <button onclick="pushtocart()">PUSH</button>
        </div>

        <div class="content">
            
            <?php
                $stmt = $pdo->prepare("SELECT * FROM menu");
                $stmt->execute(); // เริ่มค้นหา
            ?>
            <?php while ($row = $stmt->fetch()): ?>
                <div class="menu">
                    <?= "menu_No:" . $row["menu_No"] ?><br>
                    <?= "menu_Name:" . $row["manu_Name"] ?><br>
                    <?= "price:" . $row["price"] ?><br>
                    <img src='image/<?= $row["manu_Name"] ?>.jpg' width='100'><hr>
                    <div class="container">
                    <button class="center-button" name="bt-cart" onclick="addtocart(<?= $row["menu_No"] ?>)">Add to cart</button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <div class="footer">
            <p>Footer</p>
        </div>
    </div>
</body>
</html>
