<?php
// Connect to database
require_once '../../connection.php';

$name = '';
$username = '';
$email = '';
$university = '';
$dept = '';
$batch = '';
$program = '';
$link = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Personal information
    $name = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];

    // Academic information
    $university = $_POST['university'];
    $department = $_POST['department'];
    $batch = $_POST['batch'];
    $program = $_POST['program'];

    // Social information
    $link = $_POST['link'];
    $upi = "xxx";

    // Check if the username exists in the database
    $query = "SELECT * FROM s_cr WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        // If the username does not exist, check if passwords match
        if ($pass === $re_pass) {
            // Hash the password before storing it in the database for security
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            // Create an entry in the database with the provided information
            $insertQuery = "INSERT INTO s_cr (name, username, email, password, university, dept, batch, program, link, UPI) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param('ssssssssss', $name, $username, $email, $hashedPassword, $university, $department, $batch, $program, $link, $upi);

            // Execute the insert statement
            if ($insertStmt->execute()) {
                header("Location: ../cr/?warning=success");
                exit(); // Important to terminate the script after the redirect
            } else {
                // Error occurred during registration
                header("Location: ../cr/?warning=conn_error");
                exit();
            }
        } else {
            // Passwords do not match
            header("Location: ../cr/?warning=password_mismatch");
            exit();
        }
    } else {
        // Username already exists
        header("Location: ../cr/?warning=username_exists");
        exit();;
    }
}
?>

<?php
    $uni_id = '';
    // populate university datalist from s_univ table
    $query = "SELECT * FROM s_univ";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        // Create an array to store university names and acronyms
        $datarows = '';
    
        // Loop through the result set and collect the data
        while ($row = mysqli_fetch_assoc($result)) {
            $uname = $row['name'];
            $acronym = $row['acronym'];
            $uname = str_replace(array("'", '"', '`'), '', $uname);
            $uname = $uname . " (" . $acronym . ")";
            $datarows = $datarows."<option value='$uname'></option>";
        }
    
        // Now $universities array contains all the university names and acronyms
        // You can use it as needed for populating the datalist or other purposes
    }


?>


<?php
    $conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Mate</title>

    <!-- Site Icon -->
    <link rel="icon" type="image/x-icon" href="../../rsx/logo.ico"> <!-- Link to the Path of icon -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- Style and Scripts -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../rsx/logo-big.png" alt="Logo" height="40" class="d-inline-block align-text-top">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../gen/noticeboard/">NoticeBoard</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="../../gen/about/">About us</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../login/">CR login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../">Register</a>
                </li>
            </ul>            
        </div>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Main Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 sh-up">
                <div class="sh-hd">
                    <p>Sign Up for your class</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container sh-form-container">
        <div class="row">
            <div class="col-12 sh-frhd mt-5">
                <h2>Read the instructions Carefully</2>
                <h5><span class="text-danger">*</span> Fields Are Required</h5>
            </div>
            <div class="col-6 offset-lg-3 sh-frhd mt-2">
                <!-- PHP code for Alart -->
                <?php
                    if (isset($_GET['warning'])) {
                        if ($_GET['warning'] == "success") {
                            echo '<div class="alert alert-success" role="alert">
                                    <strong>Success!</strong> You have successfully registered. Please login to continue.
                                </div>';
                        } elseif ($_GET['warning'] == "conn_error") {
                            echo '<div class="alert alert-warning" role="alert">
                                    <strong>Connection Error!</strong> Please try again later.
                                </div>';
                        } elseif ($_GET['warning'] == "username_exists") {
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Username Exists!</strong> Please try another username.
                                </div>';
                        } elseif ($_GET['warning'] == "password_mismatch") {
                            echo '<div class="alert alert-danger" role="alert">
                                    <strong>Password Mismatch!</strong> Please try again.
                                </div>';
                        }
                    }
                ?>
                <!-- <div class="alert alert-warning" role="alert">
                    A simple warning alert—check it out!
                </div> -->
            </div>
            <div class="">
                <form action="../cr/"></form>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-8 col-12 offset-lg-2">
                <form class = "requires-validation" action="../cr/index.php" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <h4>Personal Information</h4>
                                <p class="text-secondary" style="text-align: justify;">Please fillout required Information. Your username must be unique. You will be contacted through your
                                    email address. So, please provide a valid email address.
                                </p>
                            </div>
                            <div class="col-md-8 mt-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name" name="fullname" value="<?php echo $name ?>" required>
                                    <label for="floatingInput">your full name <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" value="<?php echo $username ?>" required>
                                    <label for="floatingInput">username <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="email" name="email" value="<?php echo $email ?>" required>
                                    <label for="floatingInput">email address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" placeholder="password" name="password" required>
                                    <label for="floatingInput">password <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-1">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" placeholder="re_password" name="re_password" required>
                                    <label for="floatingInput">retype password <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <h4>University Information</h4>
                                <p class="text-secondary" style="text-align: justify;">Your university information is required. 
                                    Please provide required information about your University and Class. If you are unsure about your program,
                                    leave it blank.
                                </p>
                            </div>
                            <div class="col-md-12 mt-1">
                                <input class="form-control" list="datalistOptions" id="exampleDataList" name = "university" placeholder='Type Your University name to search...*' value="<?php echo $university ?>" required>
                                <datalist id="datalistOptions">
                                    <!-- PHP options -->
                                    <?php echo $datarows ?>
                                </datalist>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="batch" name="batch" value="<?php echo $batch ?>" required>
                                    <label for="floatingInput">Batch (eg. 22)<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="department" name="department" value="<?php echo $dept ?>" required>
                                    <label for="floatingInput">Department <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="program" value="<?php echo $program ?>" name="program">
                                    <label for="floatingInput">program</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <h4>Proof of your CRship</h4>
                                <p class="text-secondary" style="text-align: justify;">You have to provide a proof of your studentship. 
                                    Please provide a valid proof of your CRship / studentship of that program / department. 
                                    <span class="text-danger fw-bold"> Both side of your university ID card</span>
                                    or anything that shows your name, department, program, university name and your ID number will be accepted.
                                </p>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="url" class="form-control" id="floatingInput" placeholder="proof_link" name="link" value="<?php echo $link ?>" required>
                                    <label for="floatingInput">Google Drive Link <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <p class="text-secondary" style="text-align: justify;">By clicking 
                                    <span class="text-success fw-bold">Register Button</span> You are agreeing to our 
                                    <a href="../../static/privacy/" class="text-decoration-none" target="_blank">Privacy Policy</a>.
                                    
                                </p>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="form-button mt-3">
                        <button id="submit" type="submit" class="btn btn-success sh-search" style="width: 100%;">Register</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>



</body>
</html>