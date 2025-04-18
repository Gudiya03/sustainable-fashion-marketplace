<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form id="loginForm" action="assets/php/login.php" method="POST">
        <h1>Login</h1>
        
        <div>
            <label for="name">Username:</label>
            <div>
                <input type="text" name="username" id="name" placeholder="username" required>
                <i class="fa-solid fa-user"></i>
            </div>
        </div>

        <div>
            <label for="email">Email:</label>
            <div>
                <input type="email" name="email" id="email" placeholder="email" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>

        <div>
            <label for="pass">Password:</label>
            <div>
                <input type="password" name="password" id="pass" placeholder="password" required>
                <i class="fa-solid fa-key"></i>
            </div>
        </div>

        <button type="submit">Login</button>
    </form>

    <script src="assets/js/login.js"></script>
</body>
</html>