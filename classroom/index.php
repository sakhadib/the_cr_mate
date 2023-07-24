<!-- PHP -->
<?php
    include "../log_header.php";
?>

<?php
    // Start the session
    session_start();
    $success = false;

    require_once "../connection.php";

    // Check if the session is active and the 'uci' session variable is set
    if (isset($_SESSION['uci'])) {
        $uciValue = $_SESSION['uci'];
        
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            
            
            $course = $_POST["course"];
            $teacher = $_POST["teacher"];
            $comment = $_POST["comment"];
            $date = date("Y-m-d");
            $classroom_code = $_POST["classroom_code"];

            // Function to sanitize user input to prevent SQL injection and other attacks
            function sanitizeInput($input) {
                // Use your preferred method for sanitization, such as mysqli_real_escape_string or htmlspecialchars
                // Here, I'll use mysqli_real_escape_string as an example:
                global $conn;
                return mysqli_real_escape_string($conn, $input);
            }

            // Check if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Retrieve form data and sanitize it
                $course = sanitizeInput($_POST["course"]);
                $teacher = sanitizeInput($_POST["teacher"]);
                $comment = sanitizeInput($_POST["comment"]);
                $classroom_code = sanitizeInput($_POST["classroom_code"]);

                // Prepare the SQL statement with placeholders
                $sql = "INSERT INTO classroom (date, course, teacher, code, comment, uic) VALUES (?, ?, ?, ?, ?, ?)";

                // Create a prepared statement
                $stmt = mysqli_prepare($conn, $sql);

                // Bind the parameters to the prepared statement
                mysqli_stmt_bind_param($stmt, "ssssss", $date, $course, $teacher, $classroom_code, $comment, $uciValue);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Insertion successful
                    $success = true;
                    // Perform any other actions after successful insertion
                } else {
                    // Insertion failed
                    echo "Error: " . mysqli_error($conn);
                    // Handle the error as appropriate for your application
                }

                // Close the prepared statement and the database connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
    }


        }
        

    } else {
        // Redirect the user to index.php
        header("Location: ../");
        exit();
    }
?>






<!-- Html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- css -->

    <link rel="stylesheet" href="style.css">

    
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
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
</head>
<body>
    <div class="tr-classroom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tr-classroomsection">
                        <img src="../images/classroom.png" class="classroom-image">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="tr-classroomsection">
                        <div class="tr-formseg">
                            <?php
                                if ($success) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Wonderful!</strong> Class-code Posted Successfully.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }
                            ?>
                            <div class="tr-greeting">
                                <h1>Welcome <span>CR</span></h1>
                                <p>Looks like you have an important <span>Classroom Code</span> to share for your fellow 
                                    classmates. So hurry up and fill up this form sothat your classmates can connect themselves with the teachers as soon as possible.
                                </p>
                            </div>
                            <form action="../classroom/" method="post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="course" placeholder="Course" required>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="teacher" placeholder="Teacher" required>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control message-box" name="classroom_code" placeholder="Classroom Code" required>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="comment" placeholder="Comment">
                                        </div>
                                        <style>
                                            .sh-btn{
                                                width: 100%;
                                            }
                                        </style>
                                        
                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit" class="btn btn-success sh-btn ">Send Classroom Code</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../footer.php"; ?>
</body>
</html>