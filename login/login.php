<?php
// Include the connection file
require_once "../connection.php";

// Start the session (if not started already)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate inputs (you can add more validation if required)
    if (empty($username) || empty($password)) {
        // Redirect back to the login page with an error message
        header("Location: login.php?error=empty_fields");
        exit();
    } else {
        // Prepare and execute a secure SELECT query
        $sql = "SELECT uic, password FROM cr WHERE uic = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with the given UCI exists
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, create a session and log in the user
                $_SESSION["username"] = $username;
                header("Location: ../"); // Redirect to the dashboard or home page after successful login
                exit();
            } else {
                // Password is incorrect
                header("Location: login.php?error=invalid_password");
                exit();
            }
        } else {
            // User with the given UCI not found
            header("Location: login.php?error=user_not_found");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="abc" name="username">
            <label for="floatingInput">UCI</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="spacer"></div>
        <button type="submit" class="btn btn-danger align-right hind login-btn">Login</button>
    </form>

    <!-- Display error messages (if any) -->
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "empty_fields":
                echo "<p>Please fill in all fields.</p>";
                break;
            case "invalid_password":
                echo "<p>Invalid password.</p>";
                break;
            case "user_not_found":
                echo "<p>User not found.</p>";
                break;
            default:
                echo "<p>Unknown error.</p>";
                break;
        }
    }
    ?>
</body>
</html>
