<<?php

require_once 'dbConfig.php';
require_once 'models.php';

$response = [
    'message' => '',
    'statusCode' => 400,  // Default to error code
];

if (isset($_GET['clearSearch'])) {
    // Reset the search term and redirect to the index page (without the search query)
    header("Location: index.php");
    exit;
}

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$showEmployeeRecords = showEmployeeRecords($pdo, $searchTerm);

// Adding Employee Record
if (isset($_POST['addEmployeeBtn'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $position = $_POST['position'];
    $major_subject = $_POST['major_subject'];

    if (!empty($last_name) && !empty($first_name) && !empty($position) && !empty($major_subject)) {
        // Attempt to insert the employee record
        $inserted = insertEmployeeRecord($pdo, $last_name, $first_name, $position, $major_subject);
        if ($inserted) {
            $response['message'] = 'Record inserted successfully!';
            $response['statusCode'] = 200; // Success status code
        } else {
            $response['message'] = 'Failed to insert record!';
        }
    } else {
        $response['message'] = 'All fields are required!';
    }
    echo '<a href="../index.php">Go back to index</a>';
}

// Editing Employee Record
if (isset($_POST['editEmployeeBtn'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $position = $_POST['position'];
    $major_subject = $_POST['major_subject'];
    $employee_id = $_POST['employee_id'];

    if (!empty($last_name) && !empty($first_name) && !empty($position) && !empty($major_subject)) {
        // Attempt to update the employee record
        $updated = updateEmployeeRecord($pdo, $last_name, $first_name, $position, $major_subject, $employee_id);
        if ($updated) {
            $response['message'] = 'Record updated successfully!';
            $response['statusCode'] = 200; // Success status code
        } else {
            $response['message'] = 'Failed to update record!';
        }
    } else {
        $response['message'] = 'All fields are required!';
    }
    echo '<a href="../index.php">Go back to index</a>';
}

// Deleting Employee Record
if (isset($_POST['deleteEmployeeBtn'])) {
    $employee_id = $_POST['employee_id'];

    // Attempt to delete the employee record
    $deleted = deleteEmployeeRecord($pdo, $employee_id);
    if ($deleted) {
        $response['message'] = 'Record deleted successfully!';
        $response['statusCode'] = 200; // Success status code
    } else {
        $response['message'] = 'Failed to delete record!';
    }
    echo '<a href="../index.php">Go back to index</a>';
}

// Output the response (could be used in the front-end)
echo json_encode($response);
?>
