<?php

    include("config.php");

    if(isset($_POST['delete'])) {
        $id = $_POST['id'];
    
        // Fetch photo file name from the database
        $sql = "SELECT id, up, down FROM data WHERE id = '$id'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Delete the photo record from the database
            $sql_delete = "DELETE FROM data WHERE id = '$id'";
            if ($conn->query($sql_delete) === TRUE) {
                // File deletion
                $row = $result->fetch_assoc();
                $up_file_path = $row['up'];
                $down_file_path = $row['down'];
                if(file_exists($up_file_path) and file_exists($down_file_path)) {
                    unlink($up_file_path);
                    unlink($down_file_path);
                }
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo "Photo not found.";
        }
    
        $conn->close();
    } else {
        header('location: ../index.php');
    }

?>