<?php
    // Include the connection file
    require_once "../connection.php";

    // Start the session (if not started already)
    session_start();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the submitted username and password
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validate inputs (you can add more validation if required)
        if (empty($username) || empty($password)) {
            // Redirect back to the login page with an error message
            header("Location: ../shsuperadmin/index.php?error=empty_fields");
            exit();
        } else {
            // Prepare and execute a secure SELECT query
            $sql = "SELECT username, password FROM shadmin WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Close the prepared statement to release resources
            $stmt->close();

            // Check if a user with the given UCI exists
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row["password"];

                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    // Password is correct, create a session and log in the user
                    $_SESSION["uci"] = $username;
                    header("Location: dashboard/"); // Redirect to the dashboard or home page after successful login
                    exit();
                } else {
                    // Password is incorrect
                    header("Location: ../shsuperadmin/index.php?error=invalid_password");
                    exit();
                }
            } else {
                // User with the given UCI not found
                header("Location: ../shsuperadmin/index.php?error=user_not_found");
                exit();
            }
        }
    }
?>

<?php
    include "../close.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Mate</title>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
        <!-- Site Icon -->
         <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../rsx/1@4x.png">
        <!-- For high-resolution displays -->
        <link rel="icon" type="image/png" sizes="32x32" href="../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="64x64" href="../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="128x128" href="../rsx/1@4x.png">
        <!-- For Internet Explorer -->
        <link rel="icon" type="image/x-icon" href="../rsx/1@4x.png">
        
        <!-- css -->
        <link rel="stylesheet" href="style.css">
    
        
        <!-- icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-12 sh-center">
                <div class="sh-boss" style="width: 100%;">
                    <div class="wrap">
                    <?php
                        if (isset($_GET["error"])) {
                            switch ($_GET["error"]) {
                                case "empty_fields":
                                    echo '<div class="alert alert-danger" role="alert">
                                            Input Something
                                        </div>';
                                    break;
                                case "invalid_password":
                                    echo '<div class="alert alert-danger" role="alert">
                                            Invalid Password
                                        </div>';
                                    break;
                                case "user_not_found":
                                    echo '<div class="alert alert-danger" role="alert">
                                            You Need to register your program first | 
                                            <a href = "../signup/" class="alert-link">Register</a>
                                        </div>';
                                    break;
                                default:
                                    echo '<div class="alert alert-danger" role="alert">
                                            Some error occured
                                        </div>';
                                    break;
                            }
                        }
                    ?>
                    </div>
                    <div class="wrap">
                        <p class="sh-hd hind text-success text-center">admin login</p>
                        <hr>
                        <form action="../shsuperadmin/" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="abc" name="username" required>
                                <label for="floatingInput">username</label>
                              </div>
                              <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>
                              </div>
                              <div class="spacer"></div>
                              <button type="submit" class="btn btn-success align-right hind login-btn" >Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 foot-list">
                <ul>
                    <li><a href="../">CR mate</a></li>
                    <li><a href="../about/">About</a></li>
                    <li><a href="mailto:novochari.technology@gmail.com">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>