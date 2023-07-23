<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $university = $_POST["university"];
    $department = $_POST["department"];
    $univ_id = $_POST["univ_id"];
    $batch = $_POST["batch"];
    $password = $_POST["password"];
    $re_password = $_POST["re_password"];

    if ($password === $re_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Add your database connection details

        require_once "../connection.php";

        // Prepare and execute the SQL query to insert data into the "cr" table
        $sql = "INSERT INTO cr (name, univ_id, batch, department, university, password, email)
                VALUES ('$name', '$univ_id', '$batch', '$department', '$university', '$hashed_password', '$email')";

        if (mysqli_query($conn, $sql)) {
            header("Location: success.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Passwords do not match. Please try again.";
    }
}
?>