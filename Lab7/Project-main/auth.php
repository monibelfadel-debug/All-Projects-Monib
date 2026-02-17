<?php
// auth.php - Session + Cookie based auth helpers
declare(strict_types=1);

require_once __DIR__ . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
    // secure defaults for local lab
    ini_set("session.use_strict_mode", "1");
    session_start();
}

function redirect(string $to): void {
    header("Location: " . $to);
    exit;
}

function current_user(): ?array {
    return $_SESSION["user"] ?? null;
}

function require_login(): void {
    // If session already exists, allow.
    if (isset($_SESSION["user"])) return;

    // Fallback: cookie "auth_token" (remember-me)
    if (!empty($_COOKIE["auth_token"])) {
        global $connection;
        $token = $_COOKIE["auth_token"];

        // tokens are stored hashed in DB
        $token_hash = hash("sha256", $token);

        $stmt = $connection->prepare("SELECT id, username FROM users WHERE remember_token_hash = ? LIMIT 1");
        $stmt->bind_param("s", $token_hash);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows === 1) {
            $u = $res->fetch_assoc();
            $_SESSION["user"] = ["id" => (int)$u["id"], "username" => $u["username"]];
            // rotate session id
            session_regenerate_id(true);
            return;
        }
    }

    redirect("login.php");
}

function login_user(int $id, string $username): void {
    $_SESSION["user"] = ["id" => $id, "username" => $username];
    session_regenerate_id(true);

    // set remember-me cookie token
    $token = bin2hex(random_bytes(32));
    $token_hash = hash("sha256", $token);

    global $connection;
    $stmt = $connection->prepare("UPDATE users SET remember_token_hash = ? WHERE id = ?");
    $stmt->bind_param("si", $token_hash, $id);
    $stmt->execute();

    // cookie for 7 days
    setcookie("auth_token", $token, [
        "expires" => time() + 60 * 60 * 24 * 7,
        "path" => "/",
        "httponly" => true,
        "samesite" => "Lax",
        "secure" => false
    ]);
}

function logout_user(): void {
    global $connection;
    if (isset($_SESSION["user"]["id"])) {
        $uid = (int)$_SESSION["user"]["id"];
        $empty = NULL;
        // clear token in DB
        $stmt = $connection->prepare("UPDATE users SET remember_token_hash = NULL WHERE id = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
    }

    // clear session + cookie
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), "", time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();

    setcookie("auth_token", "", time() - 3600, "/");
    redirect("login.php");
}
?>