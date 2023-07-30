<?php

    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        header("location: ../");
        exit();
    }
    
    
    //connecting to database
    require_once '../../connection.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        // Prepare the SQL statement with placeholders
        $sql = "SELECT * FROM `S_cr` WHERE `username` = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the username parameter to the placeholder
        mysqli_stmt_bind_param($stmt, 's', $user);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result from the prepared statement
        $result = mysqli_stmt_get_result($stmt);

        // Check if the query returned any rows
        if (mysqli_num_rows($result) == 1) {
            // Fetch the hashed password from the result set
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            $upi = $row['UPI'];
            if($upi == "xxx") {
                header("location: ../login/?warning=upinf");
                exit();
            }
            // Verify the password using password_verify
            if (password_verify($pass, $hashedPassword)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user;
                $_SESSION['upi'] = $upi;
                header("location: ../");
                exit(); // Always exit after redirection
            } else {
                // Invalid password
                header("location: ../login/?warning=pm");
            }
        } else {
            // User not found
            header("location: ../login/?warning=unf");
        }
        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
?>

<?php
    include_once '../../close.php';

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Mate</title>

    <!-- Site Icon -->
    <link rel="icon" type="image/x-icon" href="../../rsx/logo.ico"> <!-- Link to the Path of icon -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Style and Scripts -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar Start -->
            <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../rsx/logo-big.png" alt="Logo" height="40" class="d-inline-block align-text-top">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../gen/noticeboard/">NoticeBoard</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="../../gen/about/">About us</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../login/">CR login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../reg/">Register</a>
                </li>
            </ul>            
        </div>
        </div>
    </nav>
    <!-- Navbar end -->
    <!-- Navbar end -->

    <!-- Main Start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 offset-lg-4 sh-form-container">
                <div class="wrap">
                    <form action="../login/" method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="text-center text-danger fw-bold">CR login</h1>
                                    <p class="text-center">login with username, password and UPI. 
                                    </p>
                                    <hr>
                                    <?php
                                        if(isset($_GET['warning'])){
                                            $warning = $_GET['warning'];
                                            if($warning == 'unf'){
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>User Not Found!</strong> <a href="../reg/" class="link-danger">Register !</a>.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            }
                                            else if($warning == 'pm'){
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>Invalid Password !</strong> Try Again.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            }
                                            else if($warning == 'upinf'){
                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        Please Try to login <strong>After you get UPI on mail</strong>.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            }
                                            else{
                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Something Went Wrong</strong> Try Again!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                            }

                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="username" name="user" required>
                            <label for="floatingInput">username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3" style="width: 100%;">login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>