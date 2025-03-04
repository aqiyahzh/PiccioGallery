<?php
$conn = new mysqli("localhost", "root", "", "premium_store");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika ada ID produk di URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $product_id = $_POST['product'];
    $customers_notes = $_POST['customers_notes'];
    $payment = $_POST['payment'];

    $sql = "INSERT INTO orders (name, email, phone, product_id, customers_notes, payment_method) 
            VALUES ('$name', '$email', '$phone', '$product_id', '$customers_notes', '$payment')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "🎉 Pesanan berhasil dibuat! Kami akan segera menghubungi Anda.";
    } else {
        $error_message = "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan <?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Form Pemesanan</h2>

    <?php if (isset($success_message)) { ?>
        <div class="success-box">
            <p><?php echo $success_message; ?></p>
            <a href="index.php" class="back-btn">🏠 Kembali ke Beranda</a>
        </div>
    <?php } else { ?>
        <h2><?php echo $product['name']; ?></h2>
        <p><?php echo $product['description']; ?></p>
        <p class="price">💰 Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></p>

        <form action="order_process.php" method="POST">
            <input type="hidden" name="product" value="<?php echo $product['id']; ?>">
            
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Nomor HP</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="name">Catatan</label>
            <input type="text" id="customers_notes" name="customers_notes" required>
            
            <label for="payment">Metode Pembayaran</label>
            <select id="payment" name="payment">
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">Dana</option>
                <option value="qris">QRIS</option>
            </select>
            
            <button type="submit">Pesan Sekarang</button>
        </form>
    <?php } ?>
</body>
</html>