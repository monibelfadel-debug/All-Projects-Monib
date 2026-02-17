<?php
require "db_connection.php";

$flash_message = "";

/*
|--------------------------------------------------------------------------
| DELETE LOGIC
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id']; // cast to int (basic safety)

    $delete_sql = "DELETE FROM students WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
}


/*
|--------------------------------------------------------------------------
| DELETE ALL LOGIC
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    // Deletes ALL records from students table
    $delete_all_sql = "DELETE FROM students";
    if (mysqli_query($conn, $delete_all_sql)) {
        $flash_message = "✅ All student records were deleted successfully.";
    } else {
        $flash_message = "❌ Failed to delete records: " . mysqli_error($conn);
    }
}

/*
|--------------------------------------------------------------------------
| FETCH STUDENTS
|--------------------------------------------------------------------------
*/
$students = [];
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>

<h2>Students List</h2>

<?php if (!empty($flash_message)): ?>
    <p style="color: #0a6; font-weight: bold;"><?= htmlspecialchars($flash_message) ?></p>
<?php endif; ?>

<form method="POST" style="margin: 10px 0;">
    <button type="submit" name="delete_all" onclick="return confirm('Delete ALL student records? This cannot be undone.')" style="background-color: #b00020; color: white; border: none; padding: 8px 14px; cursor: pointer; border-radius: 6px;">
        Delete All Records
    </button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Student Number</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

    <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['id']) ?></td>
                <td><?= htmlspecialchars($student['student_number']) ?></td>
                <td><?= htmlspecialchars($student['full_name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['department']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?= $student['id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this student?')" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No students found</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
