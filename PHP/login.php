<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Registration System</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> <!-- Replace with your FontAwesome kit -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

  <div class="container">
    <form method="post" action="login.php">
      <h1>Login</h1>

      <?php include('errors.php'); ?>

      <!-- Username -->
      <div>
        <label for="username">Username:</label>
        <div>
          <input type="text" name="username" id="username" placeholder="username" required>
          <i class="fa-solid fa-user"></i>
        </div>
      </div>

      <!-- Email -->
      <div>
        <label for="email">Email:</label>
        <div>
          <input type="email" name="email" id="email" placeholder="email" required>
          <i class="fa-solid fa-envelope"></i>
        </div>
      </div>

      <!-- Password -->
      <div>
        <label for="password">Password:</label>
        <div>
          <input type="password" name="password" id="password" placeholder="password" required>
          <i class="fa-solid fa-key"></i>
        </div>
      </div>

      <!-- Submit Button -->
      <button type="submit" name="login_user">Login</button>

      <!-- Register Link -->
      <p class="text-center mt-4">Not a member? 
        <a href="register.php" class="text-orange-400 hover:underline">Sign up</a>
      </p>
    </form>
  </div>
  <script src="assets/js/login.js"></script>
</body>
</html>
