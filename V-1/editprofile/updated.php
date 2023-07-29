<?php
    
    // Start the session
    session_start();

    //bool value
    $isUpdated = false;
    
    // server request post
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['uci'])) {
        $uciValue = $_SESSION['uci'];
        
        // Retrieve the form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $university = $_POST["university"];
        $department = $_POST["department"];
        $univ_id = $_POST["univ_id"];
        $batch = $_POST["batch"];
        
        
        // Add your database connection details
    
        require_once "../connection.php";
    
        // Prepare and execute the SQL query to insert data into the "cr" table
        $sql = "UPDATE cr SET name='$name', univ_id='$univ_id', batch='$batch', department='$department', university='$university', email='$email' WHERE uic='$uciValue'";
        

        if (mysqli_query($conn, $sql)) {
            $isUpdated = true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    else{
        header("Location: ../login/");
        exit();
    }
?>



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
<?php include "../log_header.php" ?>

    <style>
        .sh-boss{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 71vh;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 sh-boss">
                <?php 
                    if($isUpdated){
                        echo '<div class="alert alert-success" role="alert">
                                Your Profile Update is <strong> Successful </strong> <a href="../" class="alert-link">Back to home</a>.
                            </div>';
                    }
                    else{
                        echo "<h1>Profile Update Failed</h1>";
                    }
                ?>
            </div>
        </div>
    </div>


<?php include "../footer.php" ?>
</body>
</html>