<?php
include "../header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CR Table</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- css -->

    <link rel="stylesheet" href="style.css">

    
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <div class="tr-formbody">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="tr-formholder">
                        <img src="../images/CRM_Signup.png" class="signup-image">
                    </div>
                </div>
                
                <div class="col-lg-6 col-12">
                    <div class="tr-formholder">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="tr-formcontent">
                                    <div class="tr-formitems">
                                        <h3>Register Today</h3>
                                        <p>Fill in the data below.</p>
                                        <form class="requires-validation" action="sign.php" method="post">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                                                <div class="valid-feedback">Username field is valid!</div>
                                                <div class="invalid-feedback">Username field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="email" class="form-control" name="email" placeholder="E-mail Address" required>
                                                <div class="valid-feedback">E-mail field is valid!</div>
                                                <div class="invalid-feedback">E-mail field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="university" placeholder="university" required>
                                                <div class="valid-feedback">university field is valid!</div>
                                                <div class="invalid-feedback">university field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="department" placeholder="Department/Program" required>
                                                <div class="valid-feedback">Department field is valid!</div>
                                                <div class="invalid-feedback">Department field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="univ_id" placeholder="Your Student ID" required>
                                                <div class="valid-feedback">Department field is valid!</div>
                                                <div class="invalid-feedback">Department field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="batch" placeholder="Batch" required>
                                                <div class="valid-feedback">Batch field is valid!</div>
                                                <div class="invalid-feedback">Batch field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                <div class="valid-feedback">Password field is valid!</div>
                                                <div class="invalid-feedback">Password field cannot be blank!</div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" name="re_password" placeholder="Confirm Password" required>
                                                <div class="valid-feedback">Password field is valid!</div>
                                                <div class="invalid-feedback">Password field cannot be blank!</div>
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
                                                <button id="submit" type="submit" class="btn btn-primary sh-search">Register</button>
                                            </div>       
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "../footer.php";
?>
</body>
</html>