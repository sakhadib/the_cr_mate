<!-- PHP -->
<?php
  // start the session
  session_start();

  // check if the session is active and the 'uci' session variable is set
  if (isset($_SESSION['uci'])) {
    // redirect to dashboard
    header("Location: dashboard/");
  }
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
        <link rel="icon" type="image/png" sizes="16x16" href="rsx/1@4x.png">
        <!-- For high-resolution displays -->
        <link rel="icon" type="image/png" sizes="32x32" href="rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="48x48" href="rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="64x64" href="rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="128x128" href="rsx/1@4x.png">
        <!-- For Internet Explorer -->
        <link rel="icon" type="image/x-icon" href="rsx/1@4x.png">
        
        <!-- css -->
        <link rel="stylesheet" href="style.css">
        
    
        
        <!-- icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
    <!-- Navbar Started -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="rsx/2@4x.png" alt="Logo" height="40" class="d-inline-block align-text-top">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="noticeboard/">NoticeBoard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Standing</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="login/">CR login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="signup/">Register</a>
                </li>
            </ul>            
          </div>
        </div>
      </nav>
    <!-- Navbar End -->
    <?php
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>For your personalization</strong> of this website we use 1 cookie of your uci after your first search.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
          </div>'
    ?>

    <div class="container ">
        <div class="row sh-cnter">
            <div class="col-lg-6 col-12">
                <img src="rsx/home-1.svg" alt="">
            </div>
            <div class="col-lg-5 col-12 offset-lg-1">
                <div class="sh-h1">
                    <p>Hey there !</p>
                    <p id="sh-m1">Are you looking for your notice ?</p>
                </div>
                <div class="sh-btn">
                    <ul>
                        <li><a href="signup/">Register Your Program</a></li>
                        <li><a href="noticeboard/">your NoticeBoard</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Step Guide -->

    <div class="container">
        
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Its only 3 steps to get started</h1>
            </div>
        </div>
        <div class="row sh-steps">
            <div class="col-12">
                <div class="sh-stp">
                    <p id="stp-hd">Step 1: Inform your CR about this website</p>
                    <p>Let your CR (Class Representative) know about this website.</p>
                  </div>
                
                  <div class="sh-stp">
                    <p id="stp-hd">Step 2: CR has to register your program for Notice alignment</p>
                    <p>Ask your CR to register your program for notice alignment on the website.</p>
                  </div>
                
                  <div class="sh-stp">
                    <p id="stp-hd">Step 3: CR will be given a unique ID of your program of 3 characters</p>
                    <p>Once registered, the CR will receive a unique ID consisting of 3 characters.</p>
                  </div>             
                  <div class="sh-stp" style="background-color: #fff;">
                    <p id="stp-hd" class="text-center" style="background-color: #fff; color: #dd6969">And You are Good to Go</p>
                  </div>             
            </div>
        </div>
        
    </div>

    <!-- foooter -->
    <style>
      .sh-ftr{
          background-color: rgb(236, 236, 236);
          min-height: 15vh;
          z-index: 0;
          padding: 40px;
          padding-bottom: 0px;
  
          /* position: fixed; */
          bottom: 0;
          left: 0;
          width: 100%;
          z-index: 9999;
  
          display: flex;
          justify-content: center;
          align-items: center;
  
      }
  </style>
  <div class="sh-ftr">
      <div class="container">
          <div class="row">
              <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                  <img src="rsx/2@4x.png" alt="" style="width : 250px">
                  <p>A NOVOCHARI production</p>
              </div>
          </div>
      </div>
  </div>
</body>
</html>