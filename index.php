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

<!-- Fetching The cr count -->

<?php
  // Include the connection.php file to establish the database connection
  require_once 'connection.php';

  // Table name
  $tableName = 'cr';

  // SQL query to get the row count of the table
  $sql = "SELECT COUNT(*) AS row_count FROM $tableName";

  // Execute the query
  $result = $conn->query($sql);

  // Check if the query was successful
  if ($result) {
      // Fetch the row count from the result
      $row = $result->fetch_assoc();
      $rowCount = $row['row_count'];
  } else {
      // Handle the error if the query fails
      echo "Error: " . $conn->error;
      $rowCount = 0;
  }
?>


<!-- Fetching total notice count -->

<?php
    require_once "connection.php";

    // Function to get row count for a table
    function getRowCount($conn, $tableName) {
        $query = "SELECT COUNT(*) as count FROM $tableName";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    // Tables in the database
    $tables = array("academic", "club", "files", "classroom");

    // Calculate the total row count for all tables
    $totalRowCount = 0;
    foreach ($tables as $table) {
        $rowCount2 = getRowCount($conn, $table);
        $totalRowCount += $rowCount2;
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
            <?php
              if(!isset($_COOKIE['uci_cookie'])){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>For your personalization</strong> of this website we use 1 cookie of your uci after your first search.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                  </div>';
              }
            ?> 
        </div>
    </div>

    <style>
      .sh-tot{
        background-color: rgb(245, 245, 245);
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); */
        padding: 20px;
        padding-left: 0;
        padding-right: 0;
        border-radius: 10px;
        box-sizing: border-box;
      }
      .bignum{
        font-size: 60px;
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        color: #dd6969;
      }
      .spacer{
        height: 20px;
      }
    </style>

    <div class="container">
      <div class="row sh-tot">
        <div class="col-lg-4 col-12 d-flex justify-content-start align-items-center flex-column offset-lg-2">
          <p class="bignum"><?php echo $rowCount; ?></p>
          <p class="smalltxt">CRs registered with us</p>
        </div>
        <div class="col-lg-4 col-12 d-flex justify-content-start align-items-center flex-column">
          <p class="bignum"><?php echo $totalRowCount; ?></p>
          <p class="smalltxt">Notices Managed</p>
        </div>
      </div>
    </div>

    <!-- Step Guide -->

    <div class="container">
        <div class="spacer"></div>
        <div class="spacer"></div>
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