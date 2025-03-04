<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "premium_store");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil daftar produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jualan Aplikasi Premium</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, white, pink);
            text-align: center;
            margin: 0;
            padding: 0;
        }
        header {
            background: rgba(255, 182, 193, 0.8);
            padding: 20px;
            border-bottom: 2px solid pink;
        }
        .header-title {
            font-weight: bold;
            font-style: italic;
            font-size: 24px;
        }
        .store-description {
            background: white;
            padding: 10px;
            margin: 10px auto;
            width: 80%;
            border-radius: 8px;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .product {
            background: white;
            padding: 15px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
        }
        .buy-btn {
            display: inline-block;
            background: pink;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        footer {
            margin-top: 20px;
            padding: 10px;
            background: pink;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="header-title">Piccio Gallery ✧˚.🎀</h1>
    </header>
    <div class="store-description">
        <p>🪺 aloo kakaak welcome to piccio gallery! 🍓🥢</p>
        <p>🔔 cermati snk di setiap aplikasi yang akan dibeli ‼</p>
        <p>⛔ ( aplikasi yang dijual tidak selalu terjaga 100% stabilitasnya karena ini adalah black market ya kak )</p>
    </div>
    <main>
        <section class="product-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="product">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="product-image">
                    <h2><?php echo $row['name']; ?></h2>
                    <p class="description"><?php echo $row['description']; ?></p>
                    <p class="price">💰 Rp<?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                    <a href="order_process.php?id=<?php echo $row['id']; ?>" class="buy-btn">🛒 Pesan Sekarang</a>
                </div>

            <?php } ?>
        </section>
    </main>
    <footer>
        <p>📞 <a href="https://wa.me/6281256905858" target="_blank">Nomor Whatsapp: +62 812-5690-5858</a></p>
        <p>📧 <a href="mailto:aqiyahzulqiya@gmail.com">Email: aqiyahzulqiya@gmail.com</a></p>
        <p>📸 <a href="https://instagram.com/aqiyahzh" target="_blank">Instagram: @aqiyahzh</a></p>
    </footer>
</body>
</html>
