<?php
    // Start the session
    session_start();
    include_once '../../connection.php';

    // if(!isset($_SESSION['admin'])){
    //     header("Location: ../../index.php");
    // }
    $uic = 'xxx';
    $tableRows = "";

    // Query to fetch the rows matching the provided 'uic'
    $query = "SELECT id, name, univ_id, batch, university, department, email FROM cr WHERE uic = '$uic'";

    // Execute the query
    $result = mysqli_query($conn, $query);
    // Initialize the $tableRows variable
    
    // Check if the query was successful
    if ($result) {
        // Loop through the result set and create table rows
        while ($row = mysqli_fetch_assoc($result)) {
            // Create a new row in the table
            $tableRows .= "<tr>";
            $tableRows .= "<td>" . $row['id'] . "</td>";
            $tableRows .= "<td>" . $row['name'] . "</td>";
            $tableRows .= "<td>" . $row['university'] . "</td>";
            $tableRows .= "<td>" . $row['department'] . "</td>";
            $tableRows .= "<td>" . $row['batch'] . "</td>";
            $tableRows .= "<td>" . $row['email'] . "</td>";
            $tableRows .= "</tr>";

            
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Query failed
        echo "Error executing the query: " . mysqli_error($conn);
    }

    // Code for uci insertion 
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // Check if the necessary values are provided in the URL parameters
        if (isset($_GET["uic"]) && isset($_GET["id"])) {
            // Sanitize the input values to prevent SQL injection
            $uci_val = mysqli_real_escape_string($conn, $_GET["uic"]);
            $ins_id = mysqli_real_escape_string($conn, $_GET["id"]);
    
            // Construct the query using prepared statements to prevent SQL injection
            $query = "UPDATE cr SET uic = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
    
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "si", $uci_val, $ins_id);
    
            // Execute the prepared statement
            $result = mysqli_stmt_execute($stmt);
    
            // Check if the update was successful
            if ($result) {
                echo "Update successful!";
            } else {
                echo "Update failed: " . mysqli_error($conn);
            }
    }
}

?>


<?php
    // Close the database connection
    $conn->close();
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
    <?php include '../header.php'; ?>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class = 'text-center'><span class="badge bg-primary" style = "font-size: 25px; font-weight: 500;">CRs who didn't got their UCI yet</span></p>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <section class="main-table" id = "standing">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table id="stable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class = "hind">id</th>
                                <th class = "hind">CR</th>
                                <th class = "hind">univ</th>
                                <th class = "hind">dept</th>
                                <th class = "hind">batch</th>
                                <th class = "hind">email</th>
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

    <div class="spacer"></div>

    <section class="sh-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-center" style="font-size: 25px;">Assign UCI</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    <form action="../uci/" method="GET">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="abc" name="id" required>
                            <label for="floatingInput">id</label>
                          </div>
                          <div class="form-floating">
                            <input type="text" class="form-control" id="floatingPassword" placeholder="uci" name="uic" required>
                            <label for="floatingPassword">UCI</label>
                          </div>
                          <div class="spacer-sm"></div>
                          <button type="submit" class="btn btn-success align-right hind login-btn" style="width: 100%;">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- script for table -->
    <script>
        new DataTable('#stable');
    </script>
    <script>
    function copyToClipboard(link) {
        const el = document.createElement('textarea');
        el.value = link;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }
</script>

</body>
</html>

<!-- <?php
include "../footer.php";
?> -->