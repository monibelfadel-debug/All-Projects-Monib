<?php
declare(strict_types=1);
require_once __DIR__ . "/auth.php";

require_login();

if (empty($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION["csrf"];

$student_number_get = trim((string)($_GET["student_number"] ?? ""));
if ($student_number_get === "") {
    redirect("admin.php");
}

$error = "";

// Update on POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!hash_equals($_SESSION["csrf"], (string)($_POST["csrf"] ?? ""))) {
        $error = "Invalid CSRF token.";
    } else {
        $student_number = trim((string)($_POST["student_number"] ?? ""));
        $full_name      = trim((string)($_POST["full_name"] ?? ""));
        $email          = trim((string)($_POST["email"] ?? ""));
        $department     = trim((string)($_POST["department"] ?? ""));
        $date_of_birth  = (string)($_POST["date_of_birth"] ?? "");
        $phone_number   = trim((string)($_POST["phone_number"] ?? ""));

        $stmt = $connection->prepare(
            "UPDATE students SET full_name=?, email=?, department=?, date_of_birth=NULLIF(?, ''), phone_number=NULLIF(?, '')
             WHERE student_number=?"
        );
        $stmt->bind_param("ssssss", $full_name, $email, $department, $date_of_birth, $phone_number, $student_number_get);

        if ($stmt->execute()) {
            redirect("admin.php");
        } else {
            $error = "Update failed: " . $connection->error;
        }
    }
}

// Fetch current student
$stmt = $connection->prepare("SELECT * FROM students WHERE student_number = ? LIMIT 1");
$stmt->bind_param("s", $student_number_get);
$stmt->execute();
$res = $stmt->get_result();
$student = $res ? $res->fetch_assoc() : null;

if (!$student) {
    redirect("admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
</head>
<body>
<h2>Edit Student</h2>
<p><a href="admin.php">Back</a></p>

<?php if ($error): ?>
  <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
  <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf) ?>">
  <label>Student Number</label><br>
  <input type="text" name="student_number" value="<?= htmlspecialchars($student["student_number"]) ?>" disabled><br><br>

  <label>Full Name</label><br>
  <input type="text" name="full_name" value="<?= htmlspecialchars($student["full_name"]) ?>" required><br><br>

  <label>Email</label><br>
  <input type="email" name="email" value="<?= htmlspecialchars($student["email"]) ?>" required><br><br>

  <label>Department</label><br>
  <input type="text" name="department" value="<?= htmlspecialchars($student["department"]) ?>" required><br><br>

  <label>Date of Birth</label><br>
  <input type="date" name="date_of_birth" value="<?= htmlspecialchars($student["date_of_birth"] ?? "") ?>"><br><br>

  <label>Phone Number</label><br>
  <input type="text" name="phone_number" value="<?= htmlspecialchars($student["phone_number"] ?? "") ?>"><br><br>

  <button type="submit">Save</button>
</form>
</body>
</html>
