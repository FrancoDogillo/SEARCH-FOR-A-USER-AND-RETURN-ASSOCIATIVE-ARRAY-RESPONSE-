<?php
require_once 'core/dbConfig.php';

if (isset($_POST['registerBtn'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $first_name = $_POST['first_name'];  // New field for first name
  $last_name = $_POST['last_name'];    // New field for last name

  // Check if the username is already taken
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);

  if ($stmt->rowCount() > 0) {
    $error = "Username already exists.";
  } else {
    // Insert new user with first and last name
    $stmt = $pdo->prepare("INSERT INTO users (username, password, first_name, last_name) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $first_name, $last_name])) {
      header('Location: login.php');
      exit();
    } else {
      $error = "Error inserting user into database.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-green-500 via-teal-500 to-blue-500 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Register</h1>
    <?php if (isset($error)): ?>
      <p class="text-red-500 text-sm mb-4 text-center"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="" class="space-y-5">
      <div>
        <label for="first_name" class="block text-sm text-gray-600 font-medium mb-1">First Name</label>
        <input type="text" name="first_name" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
      </div>
      <div>
        <label for="last_name" class="block text-sm text-gray-600 font-medium mb-1">Last Name</label>
        <input type="text" name="last_name" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
      </div>
      <div>
        <label for="username" class="block text-sm text-gray-600 font-medium mb-1">Username</label>
        <input type="text" name="username" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
      </div>
      <div>
        <label for="password" class="block text-sm text-gray-600 font-medium mb-1">Password</label>
        <input type="password" name="password" required
          class="block w-full px-4 py-2 text-gray-700 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
      </div>
      <button type="submit" name="registerBtn"
        class="w-full bg-gradient-to-r from-teal-500 to-blue-500 text-white py-2 px-4 rounded-lg font-semibold shadow-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
        Register
      </button>
    </form>
    <p class="text-sm text-gray-600 mt-6 text-center">
      Already have an account?
      <a href="login.php" class="text-teal-600 hover:underline font-medium">Login</a>
    </p>
  </div>
</body>

</html>