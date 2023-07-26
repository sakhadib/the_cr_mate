<!-- PHP -->
<?php
    //start the session
    session_start();
    if(isset($_SESSION['uci'])){
        include "../log_header.php";
    }
    else{
        include "../header.php";
    } 
?>

<?php
    include "../close.php";
?>

<?php
    // Include the connection.php file to establish a database connection
    require_once "connection.php";
    if (isset($_GET['uic']) && isset($_GET['id'])) {
        // Retrieve the values of 'uic' and 'id' from the URL
        $uic = $_GET['uic'];
        $id = $_GET['id'];

        // Query to fetch the rows matching the provided 'uic' and 'id'
        $query = "SELECT date, club, Details, comment FROM club WHERE uic = '$uic' AND id = '$id'";
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
                $club = $row['club'];
                $details = $row['Details'];
                $comment = $row['comment'];
                $date = $row['date'];
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
    <div class="container shuv">
        <div class="row">
            <div class="col-12">
                <div class="spacer-50"></div>
                <!-- php file title -->
                <h2><span>Date : </span><?php echo $date ?></h2>
                <h6><?php echo $meta ?></h6>
                <div class="spacer-50"></div>
                <button id="copyButton" class="btn btn-warning" onclick="copyPageLink()">Copy notice link to share</button>
                <div id="copyMessage" class="mt-2" style="display: none;">Link copied to clipboard!</div>
                <div class="spacer-50"></div>
                <h4><?php echo $details ?></h4>
                <div class="spacer-50"></div>
                <p><span>Society / Club : </span> <?php echo $club ?></p>
                <hr>
                <p><span>Comment : </span> <?php echo $comment ?></p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        
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
        min-height: 71vh;
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