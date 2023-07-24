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
        $date = $_POST["date"];
        $message = $_POST["message"];

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
            $date = sanitizeInput($_POST["date"]);
            $message = sanitizeInput($_POST["message"]);

            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO academic (date, course, teacher, details, comment, uic) VALUES (?, ?, ?, ?, ?, ?)";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssssss", $date, $course, $teacher, $message, $comment, $uciValue);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Insertion successful
                $success = true;
                // Perform any other actions after successful insertion
            } else {
                // Insertion failed
                echo "Error: " . mysqli_error($connection);
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Table</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- css -->

    <link rel="stylesheet" href="style.css">

    
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="tr-academicform">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tr-academicsection">
                        <img src="../images/Academic.png" class="academic-image">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="tr-academicsection">
                        <div class="tr-formseg">
                            <?php
                                if ($success) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Wonderful!</strong> Message Posted Successfully.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                                }
                            ?>
                            <div class="tr-greeting">
                                <h1>Hey <span>CR</span></h1>
                                <p>Looks like you have an interesting news about <span>Academics</span> for your fellow 
                                    classmates. So hurry up and fill up this form sothat your classmates can get the exciting news.
                                </p>
                            </div>

                            
    
                            <form action="../academic/" method = "POST">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="course" placeholder="Course" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="teacher" placeholder="Teacher" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="comment" placeholder="Comment">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="date" class="form-control" name="date" placeholder="Date" required pattern="\d{4}-\d{2}-\d{2}" min="1900-01-01" max="9999-12-31">
                                        </div>

                                        <div class="col-12">
                                            <textarea class="form-control message-box" name="message" placeholder="Message" required cols="40" rows="6"></textarea>
                                        </div>

                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit" class="btn btn-primary">Post Message</button>
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

    <?php
        include "../footer.php";
    ?>
</body>
</html>