<?php

    include "config.php";

   
    if(isset($_POST['sub']))
    {
        $api = "SELECT `id`, `api` FROM `api` WHERE 1";
        $api_key = mysqli_query($conn,$api);
        $result = mysqli_fetch_assoc($api_key);
        $apkey =  $result['api'];

        $rand = rand(111111111,999999999);

        $color = $_POST['color'];

        $new_name = $rand;

        $path = "upload/".$new_name;

        if(move_uploaded_file($_FILES['photo']['tmp_name'],$path))
        {
            $file = "https://yoursitename/photo".$path;
            // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            $post = array(
                'image_url' => $file,
                'size' => 'auto',
                'bg_color' => $color
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $headers = array();
            $headers[] = "X-Api-Key: $apkey";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            curl_close($ch);
            $fp = fopen('download/'.$rand.'.png','wb');
            fwrite($fp, $result);
            fclose($fp);
            
            $download = 'download/'.$rand.'.png';

            $sql = "INSERT INTO `data`(`up`, `down`) VALUES ('$path','$download')";
            
            mysqli_query($conn,$sql);

            mysqli_close($conn);
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    else if(isset($_POST['update']))
    {
        $api = $_POST['api'];
        $pin = $_POST['pin'];
        $sql = "SELECT `id`, `api`, `pin` FROM `api` WHERE 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if($row['pin'] == $pin)
        {
            $update = "UPDATE `api` SET `api`='$api' WHERE 1";
            mysqli_query($conn,$update);
            echo 1;
        }   
        else
        {
            echo 0;
        }
        mysqli_close($conn);
    }
    else
    {
        header('location: ../index.php');
    }

    

?>