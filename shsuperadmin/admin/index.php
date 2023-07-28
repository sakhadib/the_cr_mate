<!-- PHP -->
<?php
    function isWeakPassword($password){
        // Implement your own logic to check for weak or common passwords.
        // For example, you can check against a list of common passwords or use regex patterns.
        $commonPasswords = array("password", "123456", "qwerty", "123456789");
        return in_array($password, $commonPasswords);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the variables from the form submission
        $user = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["c_password"];


        // Password validation
        if (strlen($password) < 8) {
            header("Location: ../admin/?warning=Password must be at least 8 characters long");
            exit;
        }

        if ($password !== $confirm_password) {
            header("Location: ../admin/?warning=Passwords do not match");
            exit;
        }

        if (isWeakPassword($password)) {
            header("Location: ../admin/?warning=Weak password, please choose a stronger one");
            exit;
        }

        // Database connection
        include_once '../../connection.php';

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the username already exists
        $check_username_query = $conn->prepare("SELECT username FROM shadmin WHERE username = ?");
        $check_username_query->bind_param("s", $user);
        $check_username_query->execute();
        $existing_username = $check_username_query->get_result()->fetch_assoc();

        if ($existing_username) {
            header("Location: ../admin/?warning=Username already exists. Please choose a different username.");
            exit;
        }

        // Prepare the INSERT statement with placeholders
        $stmt = $conn->prepare("INSERT INTO shadmin (username, email, password) VALUES (?, ?, ?)");

        // Hash the password for security before storing in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind the parameters and execute the statement
        $stmt->bind_param("sss", $user, $email, $hashed_password);

        if ($stmt->execute()) {
            header("Location: ../admin/?warning=Successful!");
            exit;
        } else {
            // If there's an error during insertion, redirect the user back to the form with an error message.
            header("Location: ../admin/?warning=Failed to insert data into the database");
            exit;
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
    }
?>


<?php
    $tableRows = "";
    // Database connection
    include_once '../../connection.php';

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve data from the "shadmin" table
    $query = "SELECT id, username, email FROM shadmin";

    // Execute the query
    $result = $conn->query($query);

    // Check if there are any records in the table
    if($result){
        while ($row = mysqli_fetch_assoc($result)) {
            // delete
            $delete = "<a class = 'link-danger text-decoration-none' href='delete.php?id=" . $row['id'] . "'><i class='uil uil-trash-alt'></i> Delete</a>";


            $tableRows .= "<tr>";
            $tableRows .= "<td>" . $row['id'] . "</td>";
            $tableRows .= "<td>" . $row['username'] . "</td>";
            $tableRows .= "<td>" . $row['email'] . "</td>";
            $tableRows .= "<td>" . $delete . "</td>";
            $tableRows .= "</tr>";
        } 
    }

    // Close the database connection
    $conn->close();
?>






<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cr Mate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../rsx/1@4x.png">
    <!-- For high-resolution displays -->
    <link rel="icon" type="image/png" sizes="32x32" href="../../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="48x48" href="../../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="64x64" href="../../rsx/1@4x.png">
    <link rel="icon" type="image/png" sizes="128x128" href="../../rsx/1@4x.png">
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
            <?php
                if (isset($_GET["warning"])) {
                    echo '<div class="alert alert-primary text-center">' . $_GET["warning"] . '</div>';
                }
            ?>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <section class="main-table" id = "standing">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                <p class = 'text-center'><span class="badge bg-secondary" style = "font-size: 25px; font-weight: 500;">Current Admins</span></p>
                    <table id="stable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class = "hind">id</th>
                                <th class = "hind">username</th>
                                <th class = "hind">email</th>
                                <th class = "hind">action</th>
                            </tr>
                        </thead>
                        <tbody>
                    <!-- Automatic Code injected by PHP -->
                        <?php echo $tableRows; ?>
                        </tbody>
                    </table>
                            
                            
                </div>
                <div class="col-lg-4 col-12 offset-lg-1">
                <p class = 'text-center'><span class="badge bg-secondary" style = "font-size: 25px; font-weight: 500;">Add New Admin</span></p>
                    
                    <form action="../admin/" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="abc" name="username" required>
                            <label for="floatingInput">username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="abc" name="email" required>
                            <label for="floatingInput">email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password" required>
                            <label for="floatingPassword">password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="confirm_password" name="c_password" required>
                            <label for="floatingPassword">confirm password</label>
                        </div>
                        <div class="spacer-sm"></div>
                        <button type="submit" class="btn btn-success align-right hind login-btn" style="width: 100%;">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="spacer"></div>

    <section class="sh-form">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12 offset-lg-4">
                    
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