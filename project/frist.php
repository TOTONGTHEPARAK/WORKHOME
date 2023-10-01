<?php
include "connect.php";
$stmt = $pdo->prepare("SELECT * FROM menu");
$stmt->execute();
?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style1.css">
    <script>
    function addToCart(menuNo) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "cart.php?menu_No=" + menuNo, true);
        xhr.send();
    }
</script>

</head>
<body>
    <div class="wrapper">
        <div class="topnav">
            <a href="#">Link</a>
            <a href="#">Link</a>
            <a href="cart.php">Cart</a>
        </div>

        <div class="content">
            <?php while ($row = $stmt->fetch()): ?>
                <div class="menu">
                    <?= "Menu No:" . $row["menu_No"] ?><br>
                    <?= "Menu Name:" . $row["menu_Name"] ?><br>
                    <?= "Price:" . $row["price"] ?><br>
                    <img src='image/<?= $row["menu_Name"] ?>.jpg' width='100'><hr>
                    <div class="container">
                    <button class="center-button addToCartButton" onclick="addToCart(<?php echo $row["menu_No"]; ?>)">Add to cart</button>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="footer">
            <div>Footer</div>       
        </div>
    </div>
</body>
</html>
