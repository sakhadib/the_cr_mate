## Code for Notice php

```php
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Accessing the selected option
        if (isset($_POST['option'])) {
            $selectedOption = $_POST['option'];
            
            // Now you can use $selectedOption to perform different actions based on the selected option
            // For example:
            if ($selectedOption === 'academic') {
                // Handle Academic Updates
            } elseif ($selectedOption === 'club') {
                // Handle Club Updates
            } elseif ($selectedOption === 'files') {
                // Handle Files and Books Updates
            } elseif ($selectedOption === 'classroom') {
                // Handle Classroom Code Updates
            }
        }

        // Accessing the UCI value
        if (isset($_POST['inputField'])) {
            $uci = $_POST['inputField'];
            // Now you can use $uci for further processing or storing in a database, etc.
        }
    }
?>

```


## Code to get uci form url
```php
<?php
    if (isset($_GET['uci'])) {
        $uci = $_GET['uci'];

        // Now you have the "UCI" value from the URL and can use it as needed
        // For example, you can display it on the page or use it in database queries, etc.
        echo "UCI: " . htmlspecialchars($uci); // Use htmlspecialchars to prevent XSS attacks
    }
?>
```


## For checking if it is logged in or not
```php
<?php
    // Start the session
    session_start();

    // Check if the session is active and the 'uci' session variable is set
    if (isset($_SESSION['uci'])) {
        $uciValue = $_SESSION['uci'];
        
        

    } else {
        // Session is not active or 'uci' session variable is not set
        // Redirect the user to index.php
        header("Location: index.php");
        exit();
    }
?>
```