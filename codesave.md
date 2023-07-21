Code for Notice php

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