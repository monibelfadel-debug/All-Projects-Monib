<?php
require "db_connection.php";

// SECURITY CHECK
if (!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}

$current_user = $_COOKIE['username'];


// FILTER by Department
$selected_department = "";
if (isset($_GET['department'])) {
    $selected_department = $_GET['department'];
}

// Get All  STUDENTS 
if ($selected_department != "") {
    $stmt = mysqli_prepare(
        $connection,
        "SELECT * FROM students WHERE department = ?"
    );
    mysqli_stmt_bind_param($stmt, "s", $selected_department);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($connection, "SELECT * FROM students");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        table {
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 3px;
        }
        .insert-btn {
    background-color: #2196F3;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
}

.insert-btn:hover {
    background-color: #1976D2;
}
        .delete-btn {
            background-color: #f44336;
            color: white;
            padding: 5px 12px;
            text-decoration: none;
            border-radius: 3px;
            margin-left: 5px;
        }
    </style>
</head>

<body>

<h2>Welcome, <?= htmlspecialchars($current_user) ?></h2>
<a href="logout.php">Logout</a>

<br><br>

<a href="insert.html" class="insert-btn">Insert New Student</a>

<br><br>

<h2>All Students</h2>

<form method="GET">
    <label>Filter by Department:</label>
    <select name="department">
        <option value="">-- All Departments --</option>
        <?php
        $departments = [
            "Computer Science",
            "Information Technology",
            "Software Engineering",
            "Information Systems",
            "Computer Engineering",
            "Data Science",
            "Cyber Security",
            "Business Administration",
            "Artificial Intelligence",
            "Business Information Systems"
        ];

        foreach ($departments as $dept) {
            $selected = ($selected_department == $dept) ? "selected" : "";
            echo "<option value='$dept' $selected>$dept</option>";
        }
        ?>
    </select>
    <button type="submit">Filter</button>
</form>

<br>

<table>
    <tr>
        <th>Student Number</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Date of Birth</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['student_number']}</td>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>{$row['department']}</td>";
    echo "<td>{$row['date_of_birth']}</td>";
    echo "<td>{$row['phone_number']}</td>";
    echo "<td>
            <a class='edit-btn' href='update_data.php?student_number={$row['student_number']}'>Update</a>
            <a class='delete-btn'
               href='delete_student.php?student_number={$row['student_number']}'
               onclick=\"return confirm('Do you want to delete this student?');\">
               Delete
            </a>
          </td>";
    echo "</tr>";
}
?>

</table>

<?php mysqli_close($connection); ?>

</body>

</html>

