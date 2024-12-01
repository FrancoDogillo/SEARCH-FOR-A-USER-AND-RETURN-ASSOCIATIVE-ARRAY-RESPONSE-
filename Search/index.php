<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Education Management System</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-6">
    <!-- Header with Flexbox -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-600">Education Management System</h1>
      <!-- Logout Button -->
      <form method="POST" action="">
        <button type="submit" name="logoutBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"><a
            href="logout.php">Logout</a></button>
      </form>
    </div>

    <!-- Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Form Section -->
      <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Add Employee</h2>
        <form action="core/handleForms.php" method="POST">
          <div class="mb-4">
            <label for="last_name" class="block text-gray-600">Last Name</label>
            <input type="text" name="last_name" class="w-full p-2 border border-gray-300 rounded" required>
          </div>
          <div class="mb-4">
            <label for="first_name" class="block text-gray-600">First Name</label>
            <input type="text" name="first_name" class="w-full p-2 border border-gray-300 rounded" required>
          </div>
          <div class="mb-4">
            <label for="position" class="block text-gray-600">Position</label>
            <input type="text" name="position" class="w-full p-2 border border-gray-300 rounded" required>
          </div>
          <div class="mb-4">
            <label for="major_subject" class="block text-gray-600">Major in</label>
            <input type="text" name="major_subject" class="w-full p-2 border border-gray-300 rounded" required>
          </div>
          <button type="submit" name="addEmployeeBtn"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
        </form>
      </div>

      <!-- Search Section -->
      <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Search Employee</h2>
        <form method="GET" action="" class="flex gap-2 mb-4">
          <input type="text" name="search" placeholder="Search by name or position"
            class="flex-1 p-2 border border-gray-300 rounded"
            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
          <button type="submit" name="searchEmployeeBtn"
            class="bg-green-500 text-white px-4 rounded hover:bg-green-600">Search</button>
        </form>
        <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
          <form method="GET" action="">
            <button type="submit" name="clearSearch"
              class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Clear Queue</button>
          </form>
        <?php endif; ?>
      </div>
    </div>

    <!-- Employee Table -->
    <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
      <?php
      $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
      $showEmployeeRecords = showEmployeeRecords($pdo, $searchTerm);
      ?>
      <?php if ($showEmployeeRecords): ?>
        <div class="overflow-x-auto">
          <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
              <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Last Name</th>
                <th class="border border-gray-300 px-4 py-2">First Name</th>
                <th class="border border-gray-300 px-4 py-2">Position</th>
                <th class="border border-gray-300 px-4 py-2">Major Subject</th>
                <th class="border border-gray-300 px-4 py-2">Date Added</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($showEmployeeRecords as $employee): ?>
                <tr class="hover:bg-gray-100">
                  <td class="border border-gray-300 px-4 py-2 text-center"><?php echo $employee['employee_id']; ?></td>
                  <td class="border border-gray-300 px-4 py-2"><?php echo $employee['last_name']; ?></td>
                  <td class="border border-gray-300 px-4 py-2"><?php echo $employee['first_name']; ?></td>
                  <td class="border border-gray-300 px-4 py-2"><?php echo $employee['position']; ?></td>
                  <td class="border border-gray-300 px-4 py-2"><?php echo $employee['major_subject']; ?></td>
                  <td class="border border-gray-300 px-4 py-2"><?php echo $employee['date_added']; ?></td>
                  <td class="border border-gray-300 px-4 py-2 text-center">
                    <a href="update.php?employee_id=<?php echo $employee['employee_id']; ?>"
                      class="text-blue-500 hover:underline">Edit</a> |
                    <a href="delete.php?employee_id=<?php echo $employee['employee_id']; ?>"
                      class="text-red-500 hover:underline">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-center text-gray-500">No records found!</p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>