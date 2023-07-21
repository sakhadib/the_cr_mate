<?php
include "../header.php";
?>

<?php
    // Check if the cookie is already set
    $uci = '';
    if (isset($_COOKIE['uci_cookie'])) {
        // If the cookie exists, get its current value
        $uci = $_COOKIE['uci_cookie'];
        $last = "your last searched UCI : " . $uci;
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
    <!-- nav -->
    <!-- nav -->

    <div class="container sh-top">
        <div class="row">
            <div class="col-12">
                <img src="../rsx/ntc@4x.png" alt="" style="width: 350px;">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="sh-ntc-hd text-center">Hi, What Are You Looking For Today ?</p>
            </div>
        </div>
        <div class="row">
            <form action="noticetable.php" method="POST">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">UCI</span>
                    <input type="text" class="form-control" name="inputField" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo isset($uci) ? htmlspecialchars($uci) : ''; ?>">
                </div>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <input type="radio" class="btn-check" name="option" id="academic" value="academic" autocomplete="off" required>
                    <label class="btn btn-sm btn-outline-secondary" for="academic">Academic Updates</label>

                    <input type="radio" class="btn-check" name="option" id="club" value="club" autocomplete="off" required>
                    <label class="btn btn-sm btn-outline-secondary" for="club">Club Updates</label>

                    <input type="radio" class="btn-check" name="option" id="files" value="files" autocomplete="off" required>
                    <label class="btn btn-sm btn-outline-secondary" for="files">Files and Books</label>

                    <input type="radio" class="btn-check" name="option" id="classroom" value="classroom" autocomplete="off" required>
                    <label class="btn btn-sm btn-outline-secondary" for="classroom">Classroom Code</label>
                </div>
                <div class="d-lg-none d-block" style = "height : 20px">

                </div>

                <style>
                    @media screen and (max-width: 767px) {
                        /* Apply styles only on devices with a maximum width of 767px */
                        .sh-search {
                            width: 100%; /* Set the button to full width on mobile devices */
                        }
                    }
                </style>
                <button type="submit" class="btn btn-danger sh-search">Search</button>
            </form>
        </div>
    </div>
</body>
</html>