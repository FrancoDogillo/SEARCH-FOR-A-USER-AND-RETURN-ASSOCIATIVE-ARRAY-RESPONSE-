<?php
session_start();
require_once 'core/dbConfig.php';

if (isset($_POST['loginBtn'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query to validate user
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->execute([$username, md5($password)]);
  $user = $stmt->fetch();

  if ($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    header('Location: index.php');
    exit();
  } else {
    $error = "Invalid username or password.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Login</h1>
    <?php if (isset($error)): ?>
      <p class="text-red-500 text-sm mb-4 text-center"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="" class="space-y-5">
      <div>
        <label for="username" class="block text-sm text-gray-600 font-medium mb-1">Username</label>
        <input type="text" name="username" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
      </div>
      <div>
        <label for="password" class="block text-sm text-gray-600 font-medium mb-1">Password</label>
        <input type="password" name="password" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
      </div>
      <button type="submit" name="loginBtn"
        class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-2 px-4 rounded-lg font-semibold shadow-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-400">
        Login
      </button>
    </form>
    <p class="text-sm text-gray-600 mt-6 text-center">
      Don't have an account?
      <a href="register.php" class="text-purple-600 hover:underline font-medium">Register</a>
    </p>
  </div>
</body>

</html>