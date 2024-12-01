<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Employee</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <?php $getEmployeeId = getEmployeeId($pdo, $_GET['employee_id']); ?>
  <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
    <h1 class="text-2xl font-semibold text-blue-600 text-center mb-6">Update Employee</h1>
    <form action="core/handleForms.php" method="POST" class="space-y-4">
      <input type="hidden" name="employee_id" value="<?php echo $getEmployeeId['employee_id']; ?>">

      <div>
        <label for="last_name" class="block text-gray-700 font-medium mb-2">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $getEmployeeId['last_name']; ?>"
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
      </div>

      <div>
        <label for="first_name" class="block text-gray-700 font-medium mb-2">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $getEmployeeId['first_name']; ?>"
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
      </div>

      <div>
        <label for="position" class="block text-gray-700 font-medium mb-2">Position:</label>
        <input type="text" name="position" value="<?php echo $getEmployeeId['position']; ?>"
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
      </div>

      <div>
        <label for="major_subject" class="block text-gray-700 font-medium mb-2">Major in:</label>
        <input type="text" name="major_subject" value="<?php echo $getEmployeeId['major_subject']; ?>"
          class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200" required>
      </div>

      <div class="flex justify-between items-center">
        <button type="submit" name="editEmployeeBtn"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Edit</button>
        <a href="index.php" class="text-blue-500 hover:underline">Back to Home</a>
      </div>
    </form>
  </div>
</body>

</html>
