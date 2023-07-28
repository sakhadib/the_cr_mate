<?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        require_once "../../connection.php";

        $id = mysqli_real_escape_string($conn, $id);

        $query = "DELETE FROM `shadmin` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("Location: ../admin/?warning=Successfully Deleted!");
        } else {
            header("Location: ../admin/?warning=Something went wrong");
        }
    }

?>