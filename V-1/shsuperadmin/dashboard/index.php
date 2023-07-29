<!-- PHP -->

<?php
    session_start();
    include_once '../../connection.php';

    if(!isset($_SESSION['admin'])){
        header("Location: ../../index.php");
    }

    // --------------------------------------------------------- Getting cr count
    $sql_cr = "SELECT COUNT(*) AS row_count FROM cr";

    // Execute the query
    $result_cr = $conn->query($sql_cr);
  
    // Check if the query was successful
    if ($result_cr) {
        // Fetch the row count from the result
        $row_cr = $result_cr->fetch_assoc();
        $rowCount_cr = $row_cr['row_count'];
    } else {
        // Handle the error if the query fails
        echo "Error: " . $conn->error;
        $rowCount_cr = 0;
    }


    // --------------------------------------------------------- Getting total notice count

    // Function to get row count for a table
    function getRowCount($conn, $tableName) {
        $query_not = "SELECT COUNT(*) as count FROM $tableName";
        $result_not = $conn->query($query_not);
        $row_not = $result_not->fetch_assoc();
        return $row_not['count'];
    }
    
    // Tables in the database
    $tables = array("academic", "club", "files", "classroom");
    
    // Calculate the total row count for all tables and store individual counts in separate variables
    $totalRowCount_not = 0;
    foreach ($tables as $table) {
        ${$table . '_ct'} = getRowCount($conn, $table);
        $totalRowCount_not += ${$table . '_ct'};
    }




    // --------------------------------------------------------- Getting individual count
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET["uci"])) {
            $uci = $_GET["uci"];

            // SQL query to get the row count of the table
            function getRowCountWithUCI($conn, $tableName_uci, $uci) {
                $uci = $conn->real_escape_string($uci); // To prevent SQL injection
            
                // Use WHERE clause to filter rows based on the 'uci' column
                $query = "SELECT COUNT(*) as count FROM $tableName_uci WHERE uic = '$uci'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                return $row['count'];
            }
            
            // Assuming you already have a $conn object for database connection.
            
            // Tables in the database
            $tables_uci = array("academic", "club", "files", "classroom");
            
            // Calculate the total row count for all tables with the given uci value and store individual counts in separate variables
            $totalRowCountWithUCI = 0;
            foreach ($tables_uci as $table_uci) {
                ${$table_uci . '_ctu'} = getRowCountWithUCI($conn, $table_uci, $uci);
                $totalRowCountWithUCI += ${$table_uci . '_ctu'};
            }
            

        }
    }

?>






<?php
    // Close the database connection
    $conn->close();

    // Include the header
    include '../header.php';
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
        <link rel="icon" type="image/png" sizes="16x16" href="../../rsx/1@4x.png">
        <!-- For high-resolution displays -->
        <link rel="icon" type="image/png" sizes="32x32" href="../../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="64x64" href="../../rsx/1@4x.png">
        <link rel="icon" type="image/png" sizes="128x128" href="../../rsx/1@4x.png">
        <!-- For Internet Explorer -->
        <link rel="icon" type="image/x-icon" href="../../rsx/1@4x.png">
        
        <!-- css -->
        <link rel="stylesheet" href="style.css">
    
        
        <!-- icons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>

    <!-- Navbar -->
    <!-- Navbar end -->

    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>

    <!-- First Insight -->

    <div class="container">
        <div class="row sh-tot">
          <div class="col-lg-4 col-12 d-flex justify-content-start align-items-center flex-column offset-lg-2">
            <p class="bignum"><?php echo $rowCount_cr; ?></p>
            <!-- <p class="bignum">15</p> -->
            <p class="smalltxt">CRs registered with us</p>
          </div>
          <div class="col-lg-4 col-12 d-flex justify-content-start align-items-center flex-column">
            <p class="bignum"><?php echo $totalRowCount_not; ?></p>
            <!-- <p class="bignum">2245</p> -->
            <p class="smalltxt">Notices Managed</p>
          </div>
        </div>
    </div>

    <div class="spacer"></div>
    <div class="spacer"></div>

    <!-- Individual topic insight -->
    <div class="container">
        <div class="row sh-tot">
          <div class="col-lg-3 col-12 d-flex justify-content-start align-items-center flex-column">
            <p class="bignum-2"><?php echo $academic_ct; ?></p>
            <!-- <p class="bignum-2">45</p> -->
            <p class="smalltxt">Academic news</p>
          </div>
          <div class="col-lg-3 col-12 d-flex justify-content-start align-items-center flex-column">
            <p class="bignum-2"><?php echo $files_ct; ?></p>
            <!-- <p class="bignum-2">21</p> -->
            <p class="smalltxt">Files shared</p>
          </div>
          <div class="col-lg-3 col-12 d-flex justify-content-start align-items-center flex-column">
            <p class="bignum-2"><?php echo $club_ct; ?></p>
            <!-- <p class="bignum-2">34</p> -->
            <p class="smalltxt">Club news</p>
          </div>
          <div class="col-lg-3 col-12 d-flex justify-content-start align-items-center flex-column">
            <p class="bignum-2"><?php echo $classroom_ct; ?></p>
            <!-- <p class="bignum-2">30</p> -->
            <p class="smalltxt">Classroom code</p>
          </div>
        </div>
    </div>

    <div class="spacer"></div>
    <div class="spacer"></div>

    <!-- notice chart -->
    <div class="container">
        <div class="row sh-tot">
            <div class="col-lg-5 col-12 chart-container">
                <p class="sh-hd">Overall</p>
                <div class="pi-container">
                    <canvas id="newspi"></canvas>
                </div>
            </div>
            <div class="d-lg-none d-block">
            <div class="spacer"></div>
            <div class="spacer"></div>
            </div>
            <div class="col-lg-7 col-12 chart-container">
                <form action="../dashboard/" method="GET" class="form-inline" style="width: 60%;">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="UCI" name = "uci" aria-label="uci" aria-describedby="button-addon2">
                        <button class="btn btn-danger" type="submit" id="button-addon2"><i class="uil uil-search"></i></button>
                    </div>
                </form>                
                <div class="pi-container">
                    <canvas id="newspi-2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>


    <?php
        include "../footer.php"
    ?>



    <!-- Java Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const newspi = document.getElementById('newspi');

        const newspiData = {
            labels: [
                'Academic',
                'Club',
                'Classroom',
                'Filse shared'
            ],
            // data: [45, 34, 30, 21],
            <?php echo 'data: ['. $academic_ct .', '. $club_ct .', '. $classroom_ct .', '. $files_ct .']' ?>
        }

        new Chart(newspi, {
            type: 'doughnut',
            data: {
                labels: newspiData.labels,
                datasets: [{
                    
                    data: newspiData.data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ],
                    hoverOffset: 4
                }]
            },
        })
    </script>

    <!-- newspi - 2 -->
    <script>
        const newspi2 = document.getElementById('newspi-2');

        const newspiData2 = {
            labels: [
                'Academic',
                'Club',
                'Classroom',
                'Filse shared'
            ],
            <?php echo 'data: ['. $academic_ctu .', '. $club_ctu .', '. $classroom_ctu .', '. $files_ctu .']' ?>
        }

        new Chart(newspi2, {
            type: 'doughnut',
            data: {
                labels: newspiData2.labels,
                datasets: [{
                    label: '<?php echo $uci ?>',
                    data: newspiData2.data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ],
                    hoverOffset: 4
                }]
            },
        })
    </script>

    
</body>
</html>