<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
        @media print{
            .noPrint{
                display: none;
            }
        }
    </style>
</head>
<body onload="">
    <h1 class='noPrint'>Press (Ctrl + Shift + P) to Print or <button onclick="window.print();">Click Here to Print</button></h1>

    <?php
        include 'config.php';
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        $sql = "SELECT `id`, `up`, `down` FROM `data` WHERE id = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        echo "&nbsp; <img src='{$row['down']}' width='113px' height='139px' border='1px'> &nbsp;";
        echo "<img src='{$row['down']}' width='113px' height='139px' border='1px'> &nbsp;";
        echo "<img src='{$row['down']}' width='113px' height='139px' border='1px'> &nbsp;";
        echo "<img src='{$row['down']}' width='113px' height='139px' border='1px'> &nbsp;";
        echo "<img src='{$row['down']}' width='113px' height='139px' border='1px'> &nbsp;";
        echo "<img src='{$row['down']}' width='113px' height='139px' border='1px'>";
        mysqli_close($conn);
        }
        else
        {
            header('location: ../index.php');
        }
    ?>
</body>
</html>