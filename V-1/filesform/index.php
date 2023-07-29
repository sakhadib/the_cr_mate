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
            $title = sanitizeInput($_POST["title"]);
            $course = sanitizeInput($_POST["course"]);
            $semester = sanitizeInput($_POST["semester"]);
            $date = sanitizeInput($_POST["date"]);
            $file_url = sanitizeInput($_POST["file_url"]);

            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO files (date, title, course, semester, url, uic) VALUES (?, ?, ?, ?, ?, ?)";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssssss", $date, $title, $course, $semester, $file_url, $uciValue);

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
        }
        
    }
    else{
        header("Location: ../login/");
    }





?>

<?php
    include "../close.php";
?> 

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>

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

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- css -->

    <link rel="stylesheet" href="style.css">

    
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    
</head>
<body>
    <div class="tr-fileform">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tr-filesection">
                        <img src="../images/files.png" class="file-image">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="tr-filesection">
                        <div class="tr-formseg">
                            <?php
                                if ($success) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Wonderful!</strong> ' . $title . ' File Posted Successfully.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }
                            ?>
                            <div class="tr-greeting">
                                <h1>Hi <span>CR</span></h1>
                                <p>Looks like you have an important <span>Notes</span> to share for your fellow 
                                    classmates. So hurry up and fill up this form sothat your classmates can get the important notes and do great in the upcoming Quiz.
                                </p>
                            </div>
    
                            <form action="../filesform/" method="POST">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="course" placeholder="Course" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="number" class="form-control" name="semester" placeholder="Semester / year" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="date" class="form-control" name="date" placeholder="Date" required>
                                        </div>
                                        <div class="col-12">
                                            <input type="url" class="form-control message-box" name="file_url" placeholder="File URL" required>
                                        </div>
                                        <style>
                                            .sh-btn{
                                                width: 100%;
                                            }
                                        </style>
                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit" class="btn btn-success sh-btn">Load this File !</button>
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