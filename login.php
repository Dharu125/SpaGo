<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaGo - Login</title>
    <link rel="stylesheet" href="styles.css" />

</head>
<body>
    <div class="booking__intro">
        <div style="border: 2px solid #ccc; padding: 20px; max-width: 400px; margin: 150px auto;" class="login">
            <h2>Login</h2>
            <form  action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><a  style="text-decoration: underline; font-size: 0.7rem;" href="buatakun.php">Buat akun baru</a><br><br>
                <input class="btn btn--primary" type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>