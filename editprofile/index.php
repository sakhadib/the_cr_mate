<!-- PHP -->
<?php
    // include header
    include "../log_header.php";
    
    //start the session
    session_start();
    require_once "../connection.php";

    // Check if the session is active and the 'uci' session variable is set
    if (isset($_SESSION['uci'])) {
        $uciValue = $_SESSION['uci'];
    }
    else{
        header("Location: ../login/");
        exit();
    }

    // Fetching the user data
    // Assuming you have already connected to the database

    // Sanitize the user input to prevent SQL injection (assuming you're using MySQLi)
    $uciValue = mysqli_real_escape_string($conn, $uciValue);

    // SQL query to fetch the data
    $sql = "SELECT id, name, univ_id, batch, department, university, email 
            FROM cr
            WHERE uic = '$uciValue'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Initialize variables to store the data
    $id = $name = $univ_id = $batch = $department = $university = $email = "";

    // Check if the query was successful
    if ($result) {
        // Fetch the data into an associative array
        $data = mysqli_fetch_assoc($result);

        // Check if any rows were returned
        if ($data) {
            // Store the data in variables
            $id = $data['id'];
            $name = $data['name'];
            $univ_id = $data['univ_id'];
            $batch = $data['batch'];
            $department = $data['department'];
            $university = $data['university'];
            $email = $data['email'];
        } else {
            echo "No results found for the given uic value.";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

    // Don't forget to close the database connection after you're done
    mysqli_close($conn);

?>
















<!-- HTML -->
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
    <div class="tr-formbody">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tr-formholder">
                        <img src="../images/editprofiel.png" class="editprofile-image">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="tr-formholder">
                        <div class="tr-formitems">
                            <div class="tr-greeting">
                                <h3>Edit Profile</h3>
                                <p>Fill in the data below to update your profile.</p>
                            </div>

                            <style>
                                .form-control{
                                    margin-top: 5px;
                                    margin-bottom: 5px;
                                    min-height: 40px;
                                    /* border: 2px solid #333; */
                                    font-size: 18px;
                                    color: #333;
                                    
                                }
                            </style>
                            <form action="updated.php" method = "post">
                                <div class="container">
                                    <div class="row">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" id = "floatingInput" class="form-control" name="name" placeholder="Full Name" required value = "<?php echo $name ?>" style = "padding: 10px;">
                                            <label for="floatingInput">Name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" id = "floatingInput" class="form-control" name="email" placeholder="E-mail Address" required value = "<?php echo $email ?>">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" id = "floatingInput" class="form-control" name="university" placeholder="university" required value = "<?php echo $university ?>" readonly>
                                            <label for="floatingInput">University</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" id = "floatingInput" class="form-control" name="department" placeholder="Department/Program" required value = "<?php echo $department ?>" readonly>
                                            <label for="floatingInput">Department</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" id = "floatingInput" class="form-control" name="univ_id" placeholder="Your Student ID" required value = "<?php echo $univ_id ?>">
                                            <label for="floatingInput">University ID</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" id = "floatingInput" class="form-control" name="batch" placeholder="Batch" required value = "<?php echo $batch ?>">
                                            <label for="floatingInput">Batch</label>
                                        </div>
                                        <style>
                                            @media screen and (max-width: 767px) {
                                                /* Apply styles only on devices with a maximum width of 767px */
                                                .sh-search {
                                                    width: 100%; /* Set the button to full width on mobile devices */
                                                }
                                            }
                                        </style>
                                        <div class="form-button mt-3">
                                            <button id="submit" type="submit" class="btn btn-primary sh-search">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php

    // include footer
    include "../footer.php";

?>