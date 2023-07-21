<?php
include "../header.php";
?>

<?php
// Include the connection.php file to establish a database connection
require_once "connection.php";
$tableRows = "";

// Check if the 'uic' variable exists in the GET request
if (isset($_GET['uci'])) {
    // Sanitize the input to prevent SQL injection
    $uic = mysqli_real_escape_string($conn, $_GET['uci']);

    // Query to fetch the rows matching the provided 'uic'
    $query = "SELECT course, teacher, code, comment FROM classroom WHERE uic = '$uic'";

    // Execute the query
    $result = mysqli_query($conn, $query);
    // Initialize the $tableRows variable
    
    // Check if the query was successful
    if ($result) {
        

        // Loop through the result set and create table rows
        while ($row = mysqli_fetch_assoc($result)) {
            // Create a new row in the table
            $tableRows .= "<tr>";
            $tableRows .= "<td>" . $row['course'] . "</td>";
            $tableRows .= "<td>" . $row['teacher'] . "</td>";
            $tableRows .= "<td>" . $row['code'] . "</td>";
            $tableRows .= "<td>" . $row['comment'] . "</td>";
            $tableRows .= "</tr>";
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Query failed
        echo "Error executing the query: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cr Mate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../rsx/1@4x.png">
    <!-- For high-resolution displays -->
    <link rel="icon" type="image/png" sizes="32x32" href="../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="48x48" href="../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="64x64" href="../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="128x128" href="../rsx/1@4x.png">
    <!-- For Internet Explorer -->
    <link rel="icon" type="image/x-icon" href="../rsx/1@4x.png">

    <!-- Custom CSS files -->
    <link rel="stylesheet" href="style.css">
    <!-- BootStrap CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Online Icons CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="icon" type="image/x-icon" href="../rsx/logo.ico">
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
</head>
<body>
    <section class="main-table" id = "standing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table id="stable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class = "hind">course</th>
                                <th class = "hind">teacher</th>
                                <th class = "hind">classroom code</th>
                                <th class = "hind">comment</th>
                            </tr>
                        </thead>
                        <tbody>
                    <!-- Automatic Code injected by PHP -->
                        <?php echo $tableRows; ?>
                    </tbody>
                </table>
                            
                            
                </div>
            </div>
        </div>
    </section>



    <!-- script for table -->
    <script>
        new DataTable('#stable');
    </script>
</body>
</html>