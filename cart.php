<?php
session_start();
include 'products.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giỏ hàng</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>🛒 Giỏ Hàng</h1>
  <a href="index.php">← Quay lại mua hàng</a>

  <div class="cart-items">
    <?php if (empty($cart)): ?>
      <p>Giỏ hàng trống.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($cart as $id => $qty): ?>
          <?php
          $product = $products[$id];
          $subtotal = $product['price'] * $qty;
          $total += $subtotal;
          ?>
          <li>
            <?= $product['name'] ?> x <?= $qty ?> = <?= number_format($subtotal) ?>₫
          </li>
        <?php endforeach; ?>
      </ul>
      <p><strong>Tổng cộng: <?= number_format($total) ?>₫</strong></p>
    <?php endif; ?>
  </div>
</body>
</html>