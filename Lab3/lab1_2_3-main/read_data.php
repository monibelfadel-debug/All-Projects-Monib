<?php
require "db_connection.php";

// Select all students
$sql = "SELECT * FROM students";
$result = mysqli_query($connection, $sql);



// Get selected department (if any)
$selected_department = "";
if (isset($_GET['department'])) {
    $selected_department = $_GET['department'];
}


if ($selected_department != "") {
    $sql = "SELECT * FROM students WHERE department = '$selected_department'";
} else {
    $sql = "SELECT * FROM students";
}

$result = mysqli_query($connection, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            text-decoration: none;
            border-radius: 3px;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>All Students</h2>


<form method="GET" action="">
    <label>Filter by Department:</label>
    <select name="department">
        <option value="">-- All Departments --</option>
        <option value="Computer Science" <?php if($selected_department=="Computer Science") echo "selected"; ?>>Computer Science</option>
        <option value="Information Technology" <?php if($selected_department=="Information Technology") echo "selected"; ?>>Information Technology</option>
        <option value="Software Engineering" <?php if($selected_department=="Software Engineering") echo "selected"; ?>>Software Engineering</option>
        <option value="Information Systems" <?php if($selected_department=="Information Systems") echo "selected"; ?>>Information Systems</option>
        <option value="Computer Engineering" <?php if($selected_department=="Computer Engineering") echo "selected"; ?>>Computer Engineering</option>
        <option value="Data Science" <?php if($selected_department=="Data Science") echo "selected"; ?>>Data Science</option>
        <option value="Cyber Security" <?php if($selected_department=="Cyber Security") echo "selected"; ?>>Cyber Security</option>
        <option value="Business Administration" <?php if($selected_department=="Business Administration") echo "selected"; ?>>Business Administration</option>
        <option value="Artificial Intelligence" <?php if($selected_department=="Artificial Intelligence") echo "selected"; ?>>Artificial Intelligence</option>
        <option value="Business Information Systems" <?php if($selected_department=="Business Information Systems") echo "selected"; ?>>Business Information Systems</option>
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
    echo "<td>" . $row["student_number"] . "</td>";
    echo "<td>" . $row["full_name"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["department"] . "</td>";
    echo "<td>" . $row["date_of_birth"] . "</td>";
    echo "<td>" . $row["phone_number"] . "</td>";
    echo "<td>
            <a class='edit-btn' href='update_data.php?student_number=" . $row["student_number"] . "'>
                Update
            </a>
          </td>";
    echo "</tr>";
}

    ?>
    
</table>

<?php
mysqli_close($connection);
?>

</body>
</html>