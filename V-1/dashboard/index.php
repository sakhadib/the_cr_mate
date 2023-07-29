<!-- PHP -->
<?php
    include "../log_header.php";
?>

<?php
    // Start the session
    session_start();
    $success = false;

    require_once "../connection.php";

    // Check if the session is active and the 'uci' session variable is set
    if (isset($_SESSION['uci'])) {
        $uciValue = $_SESSION['uci'];

        
        
    }
    else{
        header("Location: ../login/");
    }
?>

<?php
    include "../close.php";
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
    <div class="tr-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-12">
                    <div class="tr-dash1">
                        <img src="../images/7605883.png" class="dash-img">
                    </div>
                </div>
                <div class="col-lg-5 col-12">
                    <div class="tr-dash1">
                        <div class="tr-wrt">
                            <h1>Good Morning <span>CR</span></h1>
                        <p>
                            Hope you're having a great day. Wanna share some exciting news with your class?
                            Hurry up and post your message.
                        </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tr-noticehead">
                        <h1>So <span>CR</span>, What do you want to share?</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="tr-typebox">
                        <img src="../images/Academic.png" class="tr-boximg">
                        <h3 class="title">Academic Announcement</h3>
                        <p class="details">
                            Want to make an <span>Academic Annoucement</span>? Hurry up and post the announcement for your classmates.
                        </p>
                        <div class="tr-btn">
                            <a href="../academic/">Go &nbsp;&nbsp; <i class="uil uil-message"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="tr-typebox">
                        <img src="../rsx/club.png" class="tr-boximg" style="width: 330px;">
                        <h3 class="title">Club Announcement</h3>
                        <p class="details">
                            Want to make an <span>Club Annoucement</span>? Hurry up and post the announcement for your classmates.
                        </p>
                        <div class="tr-btn">
                            <a href="../club/">Go &nbsp;&nbsp; <i class="uil uil-message"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="tr-typebox">
                        <img src="../images/classroom.png" class="tr-boximg">
                        <h3 class="title">Classroom Code</h3>
                        <p class="details">
                            Want to share a <span>Classroom Code</span>? Hurry up and share the code with your classmates.
                        </p>
                        <div class="tr-btn">
                            <a href="../classroom/">Go &nbsp;&nbsp; <i class="uil uil-message"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="tr-typebox">
                        <img src="../images/files.png" class="tr-boximg" style="width: 290px;">
                        <h3 class="title">File Upload</h3>
                        <p class="details">
                            Want to share <span>Notes</span>? Hurry up and share the file with your classmates.
                        </p>
                        <div class="tr-btn">
                            <a href="../filesform/">Go &nbsp;&nbsp; <i class="uil uil-message"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../footer.php"; ?>
</body>
</html>