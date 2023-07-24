<!-- PHP -->
<?php
    include "../header.php";
?>

<?php
    // Include the connection.php file to establish a database connection
    require_once "connection.php";
    if (isset($_GET['uic']) && isset($_GET['id'])) {
        // Retrieve the values of 'uic' and 'id' from the URL
        $uic = $_GET['uic'];
        $id = $_GET['id'];

        // Query to fetch the rows matching the provided 'uic' and 'id'
        $query = "SELECT date, title, course, semester, url FROM files WHERE uic = '$uic' AND id = '$id'";
        // Execute the query
        $result = mysqli_query($conn, $query);
        // Initialize the $tableRows variable

        // Query to fetch the rows matching the provided 'uic' and 'id'
        $query2 = "SELECT name, department, university, batch FROM cr WHERE uic = '$uic'";
        // Execute the query
        $result2 = mysqli_query($conn, $query2);
        // Initialize the $tableRows variable
        
        // Check if the query was successful
        if ($result) {
            // Loop through the result set and create table rows
            while ($row = mysqli_fetch_assoc($result)) {
                // Create a new row in the table
                $title = $row['title'];
                $course = $row['course'];
                $semester = $row['semester'];
                $url = $row['url'];
                $date = $row['date'];

                if (strpos($url, "view?usp=drive_link") !== false) {
                    // If the substring exists, replace it with "preview"
                    $url2 = str_replace("view?usp=drive_link", "preview", $url);
                }
                else{
                    $url2 = $url;
                }
                $escapedUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
            }

            // Free the result set
            mysqli_free_result($result);
        } else {
            // Query failed
            echo "Error executing the query: " . mysqli_error($conn);
        }
        if ($result2) {
            // Loop through the result set and create table rows
            while ($row = mysqli_fetch_assoc($result2)) {
                // Create a new row in the table
                $name = $row['name'];
                $department = $row['department'];
                $university = $row['university'];
                $batch = $row['batch'];

                $meta = $name . " , " . $department . " , " . $university . " , " . $batch;
            }

            // Free the result set
            mysqli_free_result($result2);
        } else {
            // Query failed
            echo "Error executing the query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    else{
        header("Location: ../noticeboard/");
        exit();
    }

?>



<!-- html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Mate</title>

        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
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
        
        <!-- css -->
        <link rel="stylesheet" href="style.css">
    
        
        <!-- icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="sh-container">
        <div class="container shuv">
            <div class="row">
                <div class="col-12">
                    <div class="spacer-50"></div>
                    <!-- php file title -->
                    <h2><?php echo $title?></h2>
                    <h6><?php echo $meta?></h6>
                    <p><?php echo "course : " . $course ." <br> ". "Semester : " . $semester ?></p>
                    <button id="copyButton" class="btn btn-warning" onclick="copyPageLink()"><i class="uil uil-copy"></i> Copy notice link to share</button>
                    <a href="<?php echo $escapedUrl; ?>" target="_blank" class="btn btn-primary"><i class="uil uil-arrow-up-right"></i> Open in New Tab</a>
                    <div id="copyMessage" class="mt-2" style="display: none;">Link copied to clipboard!</div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Function to check if a URL exists
                    function urlExists($url2) {
                        $headers = @get_headers($url2);
                        return is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $headers[0]) : false;
                    }

                    if (urlExists($url2)) {
                        // If the URL exists, display the file in an iframe
                        echo "<iframe src='$url2' width='100%' height='800' frameborder='0' style = 'border-radius: 10px'></iframe>";
                    } else {
                        // If the URL does not exist, show a Bootstrap alert
                        echo "<div class='alert alert-warning' role='alert'>File not available or cannot be displayed in this page.</div>";
                    }
                    ?>
                    <div class="spacer-50"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include "../footer.php";
    ?>
</body>
</html>

<style>
    .spacer-50{
        height: 50px;
    }
    .shuv{
        /* min-height: 71vh; */
        display: flex;
        align-items: center;
    }
    
</style>

<script>
    function copyPageLink() {
        var dummyTextArea = document.createElement("textarea");
        dummyTextArea.value = window.location.href;
        document.body.appendChild(dummyTextArea);
        dummyTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(dummyTextArea);

        // Show the message for a short duration
        var copyMessage = document.getElementById("copyMessage");
        copyMessage.style.display = "block";
        setTimeout(function() {
            copyMessage.style.display = "none";
        }, 2000);
    }

</script>