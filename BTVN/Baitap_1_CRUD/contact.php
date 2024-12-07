<?php include('header.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="style.css">
</head>
<main>
    <section class="contact">
        <h1>Liên hệ với chúng tôi</h1>
        <form action="" method="POST">
            <label for="name">Tên của bạn:</label>
            <input type="text" id="name" name="name" required>

            <labael for="email">Email:</labael>
            <input type="email" id="email" name="email" required>

            <label for="message">Tin nhắn:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Gửi</button>
        </form>
    </section>
</main>

<?php include('footer.php'); ?>