<?php

    include("config.php");

    if(isset($_POST["fetch"])){
        $sql = "SELECT * FROM `data` ORDER BY `data`.`id` DESC";
        $result = mysqli_query($conn, $sql);
        $output = "";
        if(mysqli_num_rows($result)> 0){
            while($row = mysqli_fetch_assoc($result))
            {
                $output .= "
                <tr>
                    <td>{$row['id']}</td>
                    <td><img src='assets/{$row['down']}' width='50px' height='50px' class='rounded'></td>
                    <td><a href='assets/{$row['down']}' class='btn btn-warning' download='Output.png'><i class='fa fa-download'></i></a></td>
                    <td><a href='assets/print.php?id={$row['id']}' class='btn btn-success'><i class='fa fa-print'></i></a></td>
                    <td><button class='btn btn-danger' data-delete='{$row['id']}'><i class='fa fa-trash'></i></a></td>
                </tr>
                ";
            }
            echo $output;
        }
        else{
            $output .= "<tr><td class='text-center' colspan='5'>No Record Found</td></tr>";
            echo $output;
        }
        mysqli_close( $conn );
    }else{
        header('location: ../index.php');
    }

?>