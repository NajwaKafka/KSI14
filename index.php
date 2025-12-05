<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial (contoh sederhana)
    if ($username === 'Najwakafka' && $password === '123') {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Peminjaman Bus</title>
</head>
<body>
    <div class="container">
        <h2>Login Peminjaman Bus</h2>
        <?php if (isset($error)) : ?>
            <p class="error">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button> 
            <button type="button" onclick="window.location.href='index.php'" style="margin-top: 10px;">Batal</button> <!-- Tombol Batal -->
        </form>
    </div>
</body>
</html>