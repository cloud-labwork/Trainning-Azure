<?php

    namespace MicrosoftAzure\Storage\Samples;

    require_once ("vendor/autoload.php");
    require_once ("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO APPS</title>
    <style>
        h1 {
            font-size: 24px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>VISION APPS</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="imageFile">
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
    </form>
    <br>
    <?php
        if(isset($_POST['submit'])) {
            $fileName = "image_" . date("YmdHis") . $_FILES['imageFile']['name'];
            $fileData = $_FILES['imageFile']['tmp_name'];

            createContainerSample($blobClient);
            uploadBlobSample($blobClient, $fileName, $fileData);
            // cleanUp($blobClient);
            $url = listBlobsSample($blobClient, $fileName);
            $req = array(
                "getParams" => $base_url . "?visualFeatures=Categories,Description,Color&language=en",
                "getUrl" => array("url" => $url)
            );

            getAnalyze($req);
        }
    ?>
</body>
</html>