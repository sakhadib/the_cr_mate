<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Accessing the selected option
        if (isset($_POST['option'])) {
            $selectedOption = $_POST['option'];

            // Accessing the UCI value
            if (isset($_POST['inputField'])) {
                $uci = $_POST['inputField'];
                
                // Cookie
                $expiration_time = time() + (60 * 60 * 24 * 60); // 2 months = 60 days * 24 hours * 60 minutes * 60 seconds
                
                // Set the cookie with the desired name, value, and expiration time
                setcookie('uci_cookie', $uci, $expiration_time, '/');

                // Now you can use $selectedOption and $uci for further processing or storing in a database, etc.
                // For example:
                if ($selectedOption == 'academic') {
                    header("Location: academic.php?uci=" . urlencode($uci));
                    exit(); 
                } elseif ($selectedOption == 'club') {
                    header("Location: club.php?uci=" . urlencode($uci));
                    exit();
                } elseif ($selectedOption == 'files') {
                    header("Location: files.php?uci=" . urlencode($uci));
                    exit();
                } elseif ($selectedOption == 'classroom') {
                    header("Location: classroom.php?uci=" . urlencode($uci));
                    exit();
                }
                else{
                    echo "assign somossa " . $selectedOption;
                    // header("Location: ../");
                    // exit();
                }
            }
            else{
                echo "uci somossa";
            }
        }
        else{
            echo "ooption somossa";
        }
    }
    else{
        header("Location: ../");
        exit();
    }
?>

