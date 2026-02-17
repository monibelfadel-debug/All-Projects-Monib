<?php
declare(strict_types=1);
require_once __DIR__ . "/auth.php";

require_login();
$user = current_user();
$current_username = $user["username"] ?? "";

// CSRF token (simple)
if (empty($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION["csrf"];

// Filter by department (safe)
$selected_department = trim((string)($_GET["department"] ?? ""));

// Update ALL students department (protected + prepared)
$flash = "";
if (isset($_POST["update_all"])) {
    if (!hash_equals($_SESSION["csrf"], (string)($_POST["csrf"] ?? ""))) {
        $flash = "<p style='color:red;'>Invalid CSRF token.</p>";
    } else {
        $new_department = trim((string)($_POST["new_department"] ?? ""));
        if ($new_department === "") {
            $flash = "<p style='color:red;'>Department cannot be empty.</p>";
        } else {
            $stmt = $connection->prepare("UPDATE students SET department = ?");
            $stmt->bind_param("s", $new_department);
            $stmt->execute();
            $flash = "<p style='color:green;'>All students updated successfully!</p>";
        }
    }
}

// Read students
if ($selected_department !== "") {
    $stmt = $connection->prepare("SELECT * FROM students WHERE department = ? ORDER BY student_number");
    $stmt->bind_param("s", $selected_department);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $connection->query("SELECT * FROM students ORDER BY student_number");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin - Students</title>
  <style>
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
  </style>
</head>
<body>

<h2>Student Management (Admin)</h2>
<p>Logged in as: <b><?= htmlspecialchars($current_username) ?></b> | <a href="logout.php">Logout</a></p>

<?= $flash ?>

<h3>Filter</h3>
<form method="GET">
  <input type="text" name="department" placeholder="Department" value="<?= htmlspecialchars($selected_department) ?>">
  <button type="submit">Filter</button>
  <a href="admin.php">Reset</a>
</form>

<hr>

<h3>Add Student</h3>
<!-- Simple form (POST -> insert.php) -->
<form method="POST" action="insert.php">
  <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf) ?>">
  <input type="text" name="student_number" placeholder="Student Number" required><br><br>
  <input type="text" name="full_name" placeholder="Full Name" required><br><br>
  <input type="email" name="email" placeholder="Email" required><br><br>
  <input type="text" name="department" placeholder="Department" required><br><br>
  <input type="date" name="date_of_birth" placeholder="Date of Birth"><br><br>
  <input type="text" name="phone_number" placeholder="Phone Number"><br><br>
  <button type="submit">Add</button>
</form>

<hr>

<h3>Update ALL Students Department</h3>
<form method="POST">
  <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf) ?>">
  <input type="text" name="new_department" placeholder="New Department" required>
  <button type="submit" name="update_all">Update All</button>
</form>

<hr>

<h3>Students List</h3>
<table>
  <thead>
    <tr>
      <th>Student No</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Department</th>
      <th>DOB</th>
      <th>Phone</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row["student_number"]) ?></td>
          <td><?= htmlspecialchars($row["full_name"]) ?></td>
          <td><?= htmlspecialchars($row["email"]) ?></td>
          <td><?= htmlspecialchars($row["department"]) ?></td>
          <td><?= htmlspecialchars($row["date_of_birth"] ?? "") ?></td>
          <td><?= htmlspecialchars($row["phone_number"] ?? "") ?></td>
          <td>
            <a href="update_data.php?student_number=<?= urlencode($row["student_number"]) ?>">Edit</a>
            |
            <a href="delete_student.php?student_number=<?= urlencode($row["student_number"]) ?>&csrf=<?= urlencode($csrf) ?>"
               onclick="return confirm('Delete this student?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7">No students found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
