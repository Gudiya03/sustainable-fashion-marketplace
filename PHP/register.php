<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Registration System</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <div class="container">
    <form method="post" action="register.php">
      <h1>Register</h1>

      <?php include('errors.php'); ?>

      <!-- Username -->
      <div>
        <label for="username">Username:</label>
        <div>
          <input type="text" name="username" id="username" placeholder="Enter your username" value="<?php echo $username; ?>" required>
          <i class="fa-solid fa-user"></i>
        </div>
      </div>

      <!-- Email -->
      <div>
        <label for="email">Email:</label>
        <div>
          <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php echo $email; ?>" required>
          <i class="fa-solid fa-envelope"></i>
        </div>
      </div>

      <!-- Password -->
      <div>
        <label for="password_1">Password:</label>
        <div>
          <input type="password" name="password_1" id="password_1" placeholder="Create a password" required>
          <i class="fa-solid fa-lock"></i>
        </div>
      </div>

      <!-- Confirm Password -->
      <div>
        <label for="password_2">Confirm Password:</label>
        <div>
          <input type="password" name="password_2" id="password_2" placeholder="Confirm your password" required>
          <i class="fa-solid fa-lock"></i>
        </div>
      </div>

      <!-- Register Button -->
      <button type="submit" name="reg_user">Register</button>

      <!-- Already a member? -->
      <p class="text-center mt-4">Already a member? 
        <a href="login.php" class="text-orange-400 hover:underline">Sign in</a>
      </p>
    </form>
  </div>

  <script src="assets/js/login.js"></script>
</body>
</html>
