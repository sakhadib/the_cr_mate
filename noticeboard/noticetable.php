<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Accessing the selected option
        if (isset($_POST['option'])) {
            $selectedOption = $_POST['option'];

            // Accessing the UCI value
            if (isset($_POST['inputField'])) {
                $uci = $_POST['inputField'];

                // Now you can use $selectedOption and $uci for further processing or storing in a database, etc.
                // For example:
                if ($selectedOption === 'academic') {
                    // Redirect to academic.php with the parameters in the GET method
                    header("Location: academic.php?uci=" . urlencode($uci));
                    exit(); // Ensure the script stops executing after the header redirection
                } elseif ($selectedOption === 'club') {
                    // Redirect to club.php with the parameters in the GET method
                    header("Location: club.php?uci=" . urlencode($uci));
                    exit();
                } elseif ($selectedOption === 'files') {
                    // Redirect to files.php with the parameters in the GET method
                    header("Location: files.php?uci=" . urlencode($uci));
                    exit();
                } elseif ($selectedOption === 'classroom') {
                    // Redirect to classroom.php with the parameters in the GET method
                    header("Location: classroom.php?uci=" . urlencode($uci));
                    exit();
                }
            }
        }
    }
    else{
        header("Location: ../");
        exit();
    }
?>

