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
    function sanitizeInput($input)
    {
        // Use your preferred method for sanitization, such as mysqli_real_escape_string or htmlspecialchars
        // Here, I'll use mysqli_real_escape_string as an example:
        global $conn;
        return mysqli_real_escape_string($conn, $input);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Ensure the form data is present and not empty
        if (isset($_POST["club"], $_POST["comment"], $_POST["date"], $_POST["message"], $_POST["option"])) {
            // Retrieve form data and sanitize it
            $club = sanitizeInput($_POST["club"]);
            $comment = sanitizeInput($_POST["comment"]);
            $date = sanitizeInput($_POST["date"]);
            $message = sanitizeInput($_POST["message"]);
            $selectedOption = sanitizeInput($_POST['option']);

            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO club (date, club, type, Details, comment, uic) VALUES (?, ?, ?, ?, ?, ?)";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Check if the prepared statement was created successfully
            if ($stmt === false) {
                die("Prepared statement preparation failed: " . mysqli_error($conn));
            }

            // Bind the parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssssss", $date, $club, $selectedOption, $message, $comment, $uciValue);

            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Insertion successful
                $success = true;
            } else {
                // Insertion failed
                echo "Error: " . mysqli_error($conn);
                // Handle the error as appropriate for your application
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: All form fields are required.";
            // Handle the missing form data as appropriate for your application
        }
    }
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
    <title>Club Updates</title>

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
    <div class="tr-clubform">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tr-clubsection">
                        <img src="../rsx/club.png" class="club-image">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="tr-clubsection">
                        <div class="tr-formseg">
                            <?php
                                if ($success) {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Yoo hooo!</strong> ' . $club . ' update Posted Successfully.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }
                            ?>
                            <div class="tr-greeting">
                                <h1>Hello <span>CR</span></h1>
                                <p>Looks like you have an interesting news about <span>Club Activity</span> for your fellow 
                                    classmates. So hurry up and fill up this form sothat your classmates can get the exciting news.
                                </p>
                            </div>
    
                            <form action="../club/" method = "post">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <input type="text" class="form-control" name="club" placeholder="Club Name" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="date" class="form-control" name="date" placeholder="Date" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <input type="text" class="form-control" name="comment" placeholder="Comment">
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control message-box" name="message" placeholder="Message" required cols="40" rows="6"></textarea>
                                        </div>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <input type="radio" class="btn-check" name="option" id="academic" value="seminar" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="academic">Seminar</label>

                                            <input type="radio" class="btn-check" name="option" id="club" value="fest" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="club">Fest</label>

                                            <input type="radio" class="btn-check" name="option" id="files" value="competition" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="files">Competition</label>

                                            <input type="radio" class="btn-check" name="option" id="classroom" value="fund-rising" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="classroom">Fund Rising</label>

                                            <input type="radio" class="btn-check" name="option" id="classroom" value="recruitment" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="classroom">Recruitment</label>

                                            <input type="radio" class="btn-check" name="option" id="classroom" value="others" autocomplete="off" required>
                                            <label class="btn btn-sm btn-outline-secondary" for="classroom">other</label>
                                        </div>
                                        <style>
                                            .sh-btn{
                                                width: 100%;
                                            }
                                        </style>
                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit" class="btn btn-success sh-btn">Post Club Update</button>
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