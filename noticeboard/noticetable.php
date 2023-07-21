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

